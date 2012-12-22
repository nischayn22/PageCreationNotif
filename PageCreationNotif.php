<?php
if ( ! defined( 'MEDIAWIKI' ) )
    die();

/**
 * Extension to send email notifications to users on page creation
 *
 * @file
 * @author Nischay Nahata <nischayn22@gmail.com> for Wikiworks
 * @ingroup Extensions
 * @licence GNU GPL v3 or later
 */

define( 'PageCreationNotif_VERSION', '0.1 alpha' );

$wgExtensionCredits['semantic'][] = array(
	'path' => __FILE__,
	'name' => 'Page Creation Notification',
	'version' => PageCreationNotif_VERSION,
	'author' => array(
		'[http://www.mediawiki.org/wiki/User:Nischayn22 Nischay Nahata] for [http://www.wikiworks.com/ WikiWorks]',
	),
	'url' => 'https://www.mediawiki.org/wiki/Extension:',
	'descriptionmsg' => 'page-creation-notif-desc'
);


// Translation
$wgExtensionMessagesFiles['PageCreationNotif'] = dirname(__FILE__) . '/PageCreationNotif.i18n.php';

// Autoloading classes
$wgAutoloadClasses['PageCreationNotifHooks'] = dirname( __FILE__ ) . '/PageCreationNotif.hooks.php';
$wgAutoloadClasses['PageCreationNotifEmailer'] = dirname(__FILE__) . '/includes/PageCreationNotifEmailer.php';

// Hooks
$wgHooks['LoadExtensionSchemaUpdates'][] = 'PageCreationNotifHooks::onSchemaUpdate';
$wgHooks['GetPreferences'][] = 'PageCreationNotifHooks::onGetPreferences';
$wgHooks['UserSaveOptions'][] = 'PageCreationNotifHooks::onUserSaveOptions';
$wgHooks['ArticleInsertComplete'][] = 'PageCreationNotifHooks::onArticleInsertComplete';

/**
 * Email address to use as the sender
 */
$wgPCNSender = $wgPasswordSender;

/**
 * Name used as the sender
 */
$wgPCNSenderName = $wgPasswordSenderName;
