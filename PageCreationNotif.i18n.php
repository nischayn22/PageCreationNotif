<?php
/**
 * Internationalisation file for the extension PageCreationNotif
 *
 * @file
 * @ingroup Extensions
 * @author Nischay Nahata <nischayn22@gmail.com>
 */

$messages = array();

/** English
 * @author Nischayn22
 */
$messages['en'] = array(
	'page-creation-notif-desc'  => 'Sends e-mail notification when new pages are created',
	'page-creation-notification' => 'Email me on creation of new pages',
	'page-creation-email-subject' => 'New page - $1 created on $2',
	'page-creation-email-body'  => 'A new page $1 has been created by user $2 at $3, the page can be viewed at $4',
);

/** Message documentation (Message documentation)
 * @author Nischayn22
 */
$messages['qqq'] = array(
	'page-creation-notif-desc'  => '{{desc}}',
	'page-creation-notification' => 'This message is a label for preferences to get notified by email on creation of new pages',
	'page-creation-email-subject' => 'This message is used as the subject for emails on creation of a new page $1 in a wiki $2',
	'page-creation-email-body'  => 'This message is the body of the notification saying that a new page $1 has been created by user $2 at site $3 and the page can be viewed at link $4',
);