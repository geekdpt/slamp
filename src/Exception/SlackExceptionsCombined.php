<?php
/*
 * This file is part of the Slamp library.
 *
 * (c) Morgan Touverey-Quilling <mtouverey@methodinthemadness.eu>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Slamp\Exception;

/**
 * InvalidArgNameException is the sent back to your code when an API call fails and returns a invalid_arg_name error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class InvalidArgNameException extends SlackException
{
    public $message = 'The method was passed an argument whose name falls outside the bounds of common decency. This includes very long names and names with non-alphanumeric characters other than _. If you get this error, it is typically an indication that you have made a very malformed API call.';
}


/**
 * InvalidArrayArgException is the sent back to your code when an API call fails and returns a invalid_array_arg error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class InvalidArrayArgException extends SlackException
{
    public $message = 'The method was passed a PHP-style array argument (e.g. with a name like foo[7]). These are never valid with the Slack API.';
}


/**
 * InvalidCharsetException is the sent back to your code when an API call fails and returns a invalid_charset error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class InvalidCharsetException extends SlackException
{
    public $message = 'The method was called via a POST request, but the charset specified in the Content-Type header was invalid. Valid charset names are: utf-8 iso-8859-1.';
}


/**
 * InvalidFormDataException is the sent back to your code when an API call fails and returns a invalid_form_data error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class InvalidFormDataException extends SlackException
{
    public $message = 'The method was called via a POST request with Content-Type application/x-www-form-urlencoded or multipart/form-data, but the form data was either missing or syntactically invalid.';
}


/**
 * InvalidPostTypeException is the sent back to your code when an API call fails and returns a invalid_post_type error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class InvalidPostTypeException extends SlackException
{
    public $message = 'The method was called via a POST request, but the specified Content-Type was invalid. Valid types are: application/json application/x-www-form-urlencoded multipart/form-data text/plain.';
}


/**
 * MissingPostTypeException is the sent back to your code when an API call fails and returns a missing_post_type error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class MissingPostTypeException extends SlackException
{
    public $message = 'The method was called via a POST request and included a data payload, but the request did not include a Content-Type header.';
}


/**
 * RequestTimeoutException is the sent back to your code when an API call fails and returns a request_timeout error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class RequestTimeoutException extends SlackException
{
    public $message = 'The method was called via a POST request, but the POST data was either missing or truncated.';
}


/**
 * NotAuthedException is the sent back to your code when an API call fails and returns a not_authed error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class NotAuthedException extends SlackException
{
    public $message = 'No authentication token provided.';
}


/**
 * InvalidAuthException is the sent back to your code when an API call fails and returns a invalid_auth error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class InvalidAuthException extends SlackException
{
    public $message = 'Invalid authentication token.';
}


/**
 * AccountInactiveException is the sent back to your code when an API call fails and returns a account_inactive error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class AccountInactiveException extends SlackException
{
    public $message = 'Authentication token is for a deleted user or team.';
}


/**
 * BotNotFoundException is the sent back to your code when an API call fails and returns a bot_not_found error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class BotNotFoundException extends SlackException
{
    public $message = 'Value passed for bot was invalid.';
}


/**
 * UserIsBotException is the sent back to your code when an API call fails and returns a user_is_bot error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class UserIsBotException extends SlackException
{
    public $message = 'This method cannot be called by a bot user.';
}


/**
 * ChannelNotFoundException is the sent back to your code when an API call fails and returns a channel_not_found error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class ChannelNotFoundException extends SlackException
{
    public $message = 'Value passed for channel was invalid.';
}


/**
 * AlreadyArchivedException is the sent back to your code when an API call fails and returns a already_archived error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class AlreadyArchivedException extends SlackException
{
    public $message = 'Channel has already been archived.';
}


/**
 * CantArchiveGeneralException is the sent back to your code when an API call fails and returns a cant_archive_general error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class CantArchiveGeneralException extends SlackException
{
    public $message = 'You cannot archive the general channel';
}


/**
 * LastRaChannelException is the sent back to your code when an API call fails and returns a last_ra_channel error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class LastRaChannelException extends SlackException
{
    public $message = 'You cannot archive the last channel for a multi-channel guest';
}


/**
 * RestrictedActionException is the sent back to your code when an API call fails and returns a restricted_action error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class RestrictedActionException extends SlackException
{
    public $message = 'A team preference prevents the authenticated user from archiving.';
}


/**
 * UserIsRestrictedException is the sent back to your code when an API call fails and returns a user_is_restricted error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class UserIsRestrictedException extends SlackException
{
    public $message = 'This method cannot be called by a restricted user or single channel guest.';
}


/**
 * NameTakenException is the sent back to your code when an API call fails and returns a name_taken error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class NameTakenException extends SlackException
{
    public $message = 'A channel cannot be created with the given name.';
}


/**
 * NoChannelException is the sent back to your code when an API call fails and returns a no_channel error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class NoChannelException extends SlackException
{
    public $message = 'Value passed for name was empty.';
}


/**
 * InvalidTsLatestException is the sent back to your code when an API call fails and returns a invalid_ts_latest error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class InvalidTsLatestException extends SlackException
{
    public $message = 'Value passed for latest was invalid';
}


/**
 * InvalidTsOldestException is the sent back to your code when an API call fails and returns a invalid_ts_oldest error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class InvalidTsOldestException extends SlackException
{
    public $message = 'Value passed for oldest was invalid';
}


/**
 * UserNotFoundException is the sent back to your code when an API call fails and returns a user_not_found error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class UserNotFoundException extends SlackException
{
    public $message = 'Value passed for user was invalid.';
}


/**
 * CantInviteSelfException is the sent back to your code when an API call fails and returns a cant_invite_self error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class CantInviteSelfException extends SlackException
{
    public $message = 'Authenticated user cannot invite themselves to a channel.';
}


/**
 * NotInChannelException is the sent back to your code when an API call fails and returns a not_in_channel error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class NotInChannelException extends SlackException
{
    public $message = 'Authenticated user is not in the channel.';
}


/**
 * AlreadyInChannelException is the sent back to your code when an API call fails and returns a already_in_channel error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class AlreadyInChannelException extends SlackException
{
    public $message = 'Invited user is already in the channel.';
}


/**
 * IsArchivedException is the sent back to your code when an API call fails and returns a is_archived error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class IsArchivedException extends SlackException
{
    public $message = 'Channel has been archived.';
}


/**
 * CantInviteException is the sent back to your code when an API call fails and returns a cant_invite error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class CantInviteException extends SlackException
{
    public $message = 'User cannot be invited to this channel.';
}


/**
 * UserIsUltraRestrictedException is the sent back to your code when an API call fails and returns a user_is_ultra_restricted error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class UserIsUltraRestrictedException extends SlackException
{
    public $message = 'This method cannot be called by a single channel guest.';
}


/**
 * CantKickSelfException is the sent back to your code when an API call fails and returns a cant_kick_self error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class CantKickSelfException extends SlackException
{
    public $message = 'Authenticated user can\'t kick themselves from a channel.';
}


/**
 * CantKickFromGeneralException is the sent back to your code when an API call fails and returns a cant_kick_from_general error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class CantKickFromGeneralException extends SlackException
{
    public $message = 'User cannot be removed from #general.';
}


/**
 * CantKickFromLastChannelException is the sent back to your code when an API call fails and returns a cant_kick_from_last_channel error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class CantKickFromLastChannelException extends SlackException
{
    public $message = 'User cannot be removed from the last channel they\'re in.';
}


/**
 * CantLeaveGeneralException is the sent back to your code when an API call fails and returns a cant_leave_general error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class CantLeaveGeneralException extends SlackException
{
    public $message = 'Authenticated user cannot leave the general channel';
}


/**
 * InvalidTimestampException is the sent back to your code when an API call fails and returns a invalid_timestamp error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class InvalidTimestampException extends SlackException
{
    public $message = 'Value passed for timestamp was invalid.';
}


/**
 * NotAuthorizedException is the sent back to your code when an API call fails and returns a not_authorized error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class NotAuthorizedException extends SlackException
{
    public $message = 'Caller cannot rename this channel';
}


/**
 * InvalidNameException is the sent back to your code when an API call fails and returns a invalid_name error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class InvalidNameException extends SlackException
{
    public $message = 'New name is invalid';
}


/**
 * TooLongException is the sent back to your code when an API call fails and returns a too_long error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class TooLongException extends SlackException
{
    public $message = 'Purpose was longer than 250 characters.';
}


/**
 * NotArchivedException is the sent back to your code when an API call fails and returns a not_archived error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class NotArchivedException extends SlackException
{
    public $message = 'Channel is not archived.';
}


/**
 * MessageNotFoundException is the sent back to your code when an API call fails and returns a message_not_found error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class MessageNotFoundException extends SlackException
{
    public $message = 'No message exists with the requested timestamp.';
}


/**
 * CantDeleteMessageException is the sent back to your code when an API call fails and returns a cant_delete_message error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class CantDeleteMessageException extends SlackException
{
    public $message = 'Authenticated user does not have permission to delete this message.';
}


/**
 * ComplianceExportsPreventDeletionException is the sent back to your code when an API call fails and returns a compliance_exports_prevent_deletion error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class ComplianceExportsPreventDeletionException extends SlackException
{
    public $message = 'Compliance exports are on, messages can not be deleted';
}


/**
 * MsgTooLongException is the sent back to your code when an API call fails and returns a msg_too_long error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class MsgTooLongException extends SlackException
{
    public $message = 'Message text is too long';
}


/**
 * NoTextException is the sent back to your code when an API call fails and returns a no_text error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class NoTextException extends SlackException
{
    public $message = 'No message text provided';
}


/**
 * RateLimitedException is the sent back to your code when an API call fails and returns a rate_limited error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class RateLimitedException extends SlackException
{
    public $message = 'Application has posted too many messages, read the Rate Limit documentation for more information';
}


/**
 * TooManyAttachmentsException is the sent back to your code when an API call fails and returns a too_many_attachments error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class TooManyAttachmentsException extends SlackException
{
    public $message = 'Too many attachments were provided with this message. A maximum of 100 attachments are allowed on a message.';
}


/**
 * CantUpdateMessageException is the sent back to your code when an API call fails and returns a cant_update_message error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class CantUpdateMessageException extends SlackException
{
    public $message = 'Authenticated user does not have permission to update this message.';
}


/**
 * EditWindowClosedException is the sent back to your code when an API call fails and returns a edit_window_closed error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class EditWindowClosedException extends SlackException
{
    public $message = 'The message cannot be edited due to the team message edit settings';
}


/**
 * UnknownErrorException is the sent back to your code when an API call fails and returns a unknown_error error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class UnknownErrorException extends SlackException
{
    public $message = 'There was a mysterious problem ending the user\'s Do Not Disturb session';
}


/**
 * SnoozeNotActiveException is the sent back to your code when an API call fails and returns a snooze_not_active error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class SnoozeNotActiveException extends SlackException
{
    public $message = 'Snooze is not active for this user and cannot be ended';
}


/**
 * SnoozeEndFailedException is the sent back to your code when an API call fails and returns a snooze_end_failed error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class SnoozeEndFailedException extends SlackException
{
    public $message = 'There was a problem setting the user\'s Do Not Disturb status';
}


/**
 * MissingDurationException is the sent back to your code when an API call fails and returns a missing_duration error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class MissingDurationException extends SlackException
{
    public $message = 'No value provided for num_minutes';
}


/**
 * SnoozeFailedException is the sent back to your code when an API call fails and returns a snooze_failed error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class SnoozeFailedException extends SlackException
{
    public $message = 'There was a problem setting the user\'s Do Not Disturb status';
}


/**
 * FileNotFoundException is the sent back to your code when an API call fails and returns a file_not_found error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class FileNotFoundException extends SlackException
{
    public $message = 'The requested file could not be found.';
}


/**
 * FileDeletedException is the sent back to your code when an API call fails and returns a file_deleted error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class FileDeletedException extends SlackException
{
    public $message = 'The requested file was previously deleted.';
}


/**
 * NoCommentException is the sent back to your code when an API call fails and returns a no_comment error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class NoCommentException extends SlackException
{
    public $message = 'The comment field was empty.';
}


/**
 * CantDeleteException is the sent back to your code when an API call fails and returns a cant_delete error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class CantDeleteException extends SlackException
{
    public $message = 'The requested comment could not be deleted.';
}


/**
 * CantEditException is the sent back to your code when an API call fails and returns a cant_edit error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class CantEditException extends SlackException
{
    public $message = 'The requested file could not be found.';
}


/**
 * CantDeleteFileException is the sent back to your code when an API call fails and returns a cant_delete_file error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class CantDeleteFileException extends SlackException
{
    public $message = 'Authenticated user does not have permission to delete this file.';
}


/**
 * UnknownTypeException is the sent back to your code when an API call fails and returns a unknown_type error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class UnknownTypeException extends SlackException
{
    public $message = 'Value passed for types was invalid';
}


/**
 * NotAllowedException is the sent back to your code when an API call fails and returns a not_allowed error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class NotAllowedException extends SlackException
{
    public $message = 'Public sharing has been disabled for this team';
}


/**
 * PostingToGeneralChannelDeniedException is the sent back to your code when an API call fails and returns a posting_to_general_channel_denied error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class PostingToGeneralChannelDeniedException extends SlackException
{
    public $message = 'An admin has restricted posting to the #general channel.';
}


/**
 * InvalidChannelException is the sent back to your code when an API call fails and returns a invalid_channel error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class InvalidChannelException extends SlackException
{
    public $message = 'One or more channels supplied are invalid';
}


/**
 * GroupContainsOthersException is the sent back to your code when an API call fails and returns a group_contains_others error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class GroupContainsOthersException extends SlackException
{
    public $message = 'Multi-channel guests cannot archive groups containing others.';
}


/**
 * NotInGroupException is the sent back to your code when an API call fails and returns a not_in_group error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class NotInGroupException extends SlackException
{
    public $message = 'User or caller were are not in the group';
}


/**
 * CantLeaveLastChannelException is the sent back to your code when an API call fails and returns a cant_leave_last_channel error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class CantLeaveLastChannelException extends SlackException
{
    public $message = 'Authenticated user cannot leave the last channel they are in';
}


/**
 * LastMemberException is the sent back to your code when an API call fails and returns a last_member error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class LastMemberException extends SlackException
{
    public $message = 'Authenticated user is the last member of a group and cannot leave it';
}


/**
 * UserDoesNotOwnChannelException is the sent back to your code when an API call fails and returns a user_does_not_own_channel error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class UserDoesNotOwnChannelException extends SlackException
{
    public $message = 'Calling user does not own this DM channel.';
}


/**
 * UserNotVisibleException is the sent back to your code when an API call fails and returns a user_not_visible error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class UserNotVisibleException extends SlackException
{
    public $message = 'The calling user is restricted from seeing the requested user.';
}


/**
 * UserDisabledException is the sent back to your code when an API call fails and returns a user_disabled error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class UserDisabledException extends SlackException
{
    public $message = 'The user has been disabled.';
}


/**
 * UsersListNotSuppliedException is the sent back to your code when an API call fails and returns a users_list_not_supplied error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class UsersListNotSuppliedException extends SlackException
{
    public $message = 'Missing users in request';
}


/**
 * NotEnoughUsersException is the sent back to your code when an API call fails and returns a not_enough_users error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class NotEnoughUsersException extends SlackException
{
    public $message = 'Needs at least 2 users to open';
}


/**
 * TooManyUsersException is the sent back to your code when an API call fails and returns a too_many_users error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class TooManyUsersException extends SlackException
{
    public $message = 'Needs at most 8 users to open';
}


/**
 * InvalidClientIdException is the sent back to your code when an API call fails and returns a invalid_client_id error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class InvalidClientIdException extends SlackException
{
    public $message = 'Value passed for client_id was invalid.';
}


/**
 * BadClientSecretException is the sent back to your code when an API call fails and returns a bad_client_secret error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class BadClientSecretException extends SlackException
{
    public $message = 'Value passed for client_secret was invalid.';
}


/**
 * InvalidCodeException is the sent back to your code when an API call fails and returns a invalid_code error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class InvalidCodeException extends SlackException
{
    public $message = 'Value passed for code was invalid.';
}


/**
 * BadRedirectUriException is the sent back to your code when an API call fails and returns a bad_redirect_uri error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class BadRedirectUriException extends SlackException
{
    public $message = 'Value passed for redirect_uri did not match the redirect_uri in the original request.';
}


/**
 * BadTimestampException is the sent back to your code when an API call fails and returns a bad_timestamp error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class BadTimestampException extends SlackException
{
    public $message = 'Value passed for timestamp was invalid.';
}


/**
 * FileCommentNotFoundException is the sent back to your code when an API call fails and returns a file_comment_not_found error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class FileCommentNotFoundException extends SlackException
{
    public $message = 'File comment specified by file_comment does not exist.';
}


/**
 * NoItemSpecifiedException is the sent back to your code when an API call fails and returns a no_item_specified error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class NoItemSpecifiedException extends SlackException
{
    public $message = 'One of file, file_comment, or timestamp was not specified.';
}


/**
 * AlreadyPinnedException is the sent back to your code when an API call fails and returns a already_pinned error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class AlreadyPinnedException extends SlackException
{
    public $message = 'The specified item is already pinned to the channel.';
}


/**
 * PermissionDeniedException is the sent back to your code when an API call fails and returns a permission_denied error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class PermissionDeniedException extends SlackException
{
    public $message = 'The user does not have permission to add pins to the channel.';
}


/**
 * FileNotSharedException is the sent back to your code when an API call fails and returns a file_not_shared error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class FileNotSharedException extends SlackException
{
    public $message = 'File specified by file is not public nor shared to the channel.';
}


/**
 * NotPinnedException is the sent back to your code when an API call fails and returns a not_pinned error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class NotPinnedException extends SlackException
{
    public $message = 'The specified item is not pinned to the channel.';
}


/**
 * AlreadyReactedException is the sent back to your code when an API call fails and returns a already_reacted error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class AlreadyReactedException extends SlackException
{
    public $message = 'The specified item already has the user/reaction combination.';
}


/**
 * TooManyEmojiException is the sent back to your code when an API call fails and returns a too_many_emoji error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class TooManyEmojiException extends SlackException
{
    public $message = 'The limit for distinct reactions (i.e emoji) on the item has been reached.';
}


/**
 * TooManyReactionsException is the sent back to your code when an API call fails and returns a too_many_reactions error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class TooManyReactionsException extends SlackException
{
    public $message = 'The limit for reactions a person may add to the item has been reached.';
}


/**
 * NoReactionException is the sent back to your code when an API call fails and returns a no_reaction error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class NoReactionException extends SlackException
{
    public $message = 'The specified item does not have the user/reaction combination.';
}


/**
 * CannotParseException is the sent back to your code when an API call fails and returns a cannot_parse error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class CannotParseException extends SlackException
{
    public $message = 'The phrasing of the timing for this reminder is unclear. You must include a complete time description. Some examples that work: 1458678068, 20, in 5 minutes, tomorrow, at 3:30pm, on Tuesday, or next week.';
}


/**
 * CannotAddBotException is the sent back to your code when an API call fails and returns a cannot_add_bot error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class CannotAddBotException extends SlackException
{
    public $message = 'Reminders can\'t be sent to bots.';
}


/**
 * CannotAddSlackbotException is the sent back to your code when an API call fails and returns a cannot_add_slackbot error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class CannotAddSlackbotException extends SlackException
{
    public $message = 'Reminders can\'t be sent to Slackbot.';
}


/**
 * CannotAddOthersException is the sent back to your code when an API call fails and returns a cannot_add_others error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class CannotAddOthersException extends SlackException
{
    public $message = 'Guests can\'t set reminders for other team members.';
}


/**
 * CannotAddOthersRecurringException is the sent back to your code when an API call fails and returns a cannot_add_others_recurring error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class CannotAddOthersRecurringException extends SlackException
{
    public $message = 'Recurring reminders can\'t be set for other team members.';
}


/**
 * NotFoundException is the sent back to your code when an API call fails and returns a not_found error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class NotFoundException extends SlackException
{
    public $message = 'That reminder can\'t be found.';
}


/**
 * CannotCompleteRecurringException is the sent back to your code when an API call fails and returns a cannot_complete_recurring error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class CannotCompleteRecurringException extends SlackException
{
    public $message = 'Recurring reminders can\'t be marked complete.';
}


/**
 * CannotCompleteOthersException is the sent back to your code when an API call fails and returns a cannot_complete_others error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class CannotCompleteOthersException extends SlackException
{
    public $message = 'Reminders for other team members can\'t be marked complete.';
}


/**
 * MigrationInProgressException is the sent back to your code when an API call fails and returns a migration_in_progress error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class MigrationInProgressException extends SlackException
{
    public $message = 'Team is being migrated between servers. See the team_migration_started event documentation for details.';
}


/**
 * AlreadyStarredException is the sent back to your code when an API call fails and returns a already_starred error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class AlreadyStarredException extends SlackException
{
    public $message = 'The specified item has already been starred by the authenticated user.';
}


/**
 * NotStarredException is the sent back to your code when an API call fails and returns a not_starred error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class NotStarredException extends SlackException
{
    public $message = 'The specified item is not currently starred by the authenticated user.';
}


/**
 * PaidOnlyException is the sent back to your code when an API call fails and returns a paid_only error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class PaidOnlyException extends SlackException
{
    public $message = 'This is only available to paid teams.';
}


/**
 * OverPaginationLimitException is the sent back to your code when an API call fails and returns a over_pagination_limit error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class OverPaginationLimitException extends SlackException
{
    public $message = 'It is not possible to request more than 1000 items per page or more than 100 pages.';
}


/**
 * InvalidPresenceException is the sent back to your code when an API call fails and returns a invalid_presence error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class InvalidPresenceException extends SlackException
{
    public $message = 'Value passed for presence was invalid.';
}


/**
 * ReservedNameException is the sent back to your code when an API call fails and returns a reserved_name error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class ReservedNameException extends SlackException
{
    public $message = 'First or last name are reserved.';
}


/**
 * InvalidProfileException is the sent back to your code when an API call fails and returns a invalid_profile error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class InvalidProfileException extends SlackException
{
    public $message = 'Profile object passed in is not valid JSON (make sure it is URL encoded!).';
}


/**
 * ProfileSetFailedException is the sent back to your code when an API call fails and returns a profile_set_failed error.
 *
 * @author Automatic Exceptions Generation Script <bin/update-slack-exceptions.php>
 */
class ProfileSetFailedException extends SlackException
{
    public $message = 'Failed to set user profile.';
}


