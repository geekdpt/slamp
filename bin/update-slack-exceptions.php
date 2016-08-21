#!/usr/bin/env php
<?php
/*
 * This file is part of the Slamp library.
 *
 * (c) Morgan Touverey-Quilling <mtouverey@methodinthemadness.eu>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * USAGE: Remove exceptions in src/Exceptions/SlackExceptionsCombined.php then run:
 * $ php bin/update-slack-exceptions.php >> src/Exceptions/SlackExceptionsCombined.php
 * Progress will be logged to stderr.
 */

# This script reads Slack documentation and extracts documented errors to generate our SlackException classes.
# Now, eat some poor code =)

namespace Slamp;

const eol = PHP_EOL;
const BASE_URL = 'https://api.slack.com';

function tell(string $msg) {
    fwrite(STDERR, $msg);
}

tell('=> GET '.BASE_URL.'/methods'.eol);

$allMethodsPage = file_get_contents(BASE_URL.'/methods');

preg_match_all('/href="(?<hrefs>\/methods\/.*)"/U', $allMethodsPage, $hrefsMatches);
$hrefs = $hrefsMatches['hrefs'];

tell('   Found '.count($hrefs).' methods.'.eol.eol);

$knownErrorCodes = [];
$generatedCode = '';

foreach($hrefs as $methodPageUrl) {
    tell('=> GET '.BASE_URL.$methodPageUrl.eol);

    $methodPage = file_get_contents(BASE_URL.$methodPageUrl);

    preg_match('/<h2.*>Errors<\/h2>\X*<table .*>(?<content>\X*)<\/table>/U', $methodPage, $tableContentMatch);
    $tableContent = $tableContentMatch['content'];

    preg_match_all('/<td.*>(?<tds>\X*)<\/td>/U', $tableContent, $tdsMatches);
    $tdGroups = array_chunk($tdsMatches['tds'], 2);

    $added = [];

    foreach($tdGroups as $tdGroup) {
        $code = strip_tags($tdGroup[0]);
        $expl = trim(str_replace('\'', '\\\'', strip_tags($tdGroup[1])));
        # CamelCasify the code to have an Exception class name
        $className = implode('', array_map('ucfirst', explode('_', $code))).'Exception';

        if(in_array($code, $knownErrorCodes)) continue;

        $knownErrorCodes[] = $code;
        $added[] = $className;

        $generatedCode .= <<<EOC
/**
 * $className is the sent back to your code when an API call fails and returns a $code error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class $className extends SlackException
{
    public \$message = '$expl';
}



EOC;
    }

    $addedStr = implode(', ', $added) ?: 'nothing';
    tell('   Added '.$addedStr.eol.eol);
}

echo $generatedCode;
