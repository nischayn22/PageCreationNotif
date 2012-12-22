<?php

/**
 * Static class for hooks handled by the Page Creation Notification extension.
 *
 * @since 0.1
 *
 * @file PageCreationNotif.hooks.php
 * @ingroup PageCreationNotif
 *
 * @licence GNU GPL v3 or later
 * @author Nischay Nahata < nischayn22@gmail.com >
 */
final class PageCreationNotifHooks {

    /**
     * Adds the preferences of Page Creation Notification to the list of available ones.
     *
     * @since 0.1
     *
     * @param User $user
     * @param array $preferences
     *
     * @return true
     */
	public static function onGetPreferences( User $user, array &$preferences ) {

		$preferences['page_creation_notif'] = array(
			'type' => 'check',
			'label-message' => 'page-creation-notification',
			'section' => 'personal/email'
		);
		return true;
	}

	/**
	 * Called just before saving user preferences/options and update the pcn_users table.
	 *
	 * @since 0.1
	 *
	 * @param User $user
	 * @param array $options
	 *
	 * @return true
	 */
	public static function onUserSaveOptions( User $user, array &$options ) {
		$dbw = wfGetDB( DB_MASTER );

		$dbw->replace(
			'pcn_users',
			array(
				'pcn_user_id'
			),
			array(
				'pcn_user_id' => $user->getId(),
				'pcn_notify' => $options['page_creation_notif'] ? 1 : 0
			),
			__METHOD__
		);

		return true;

	}

	/**
	 * Schema update to set up the needed database tables.
	 *
	 * @since 0.1
	 *
	 * @param DatabaseUpdater $updater
	 *
	 * @return true
	 */
	public static function onSchemaUpdate( /* DatabaseUpdater */ $updater = null ) {
		global $wgDBtype;

		if ( $wgDBtype == 'mysql' ) {
            $updater->addExtensionUpdate( array(
                'addTable',
                'pcn_users',
                dirname( __FILE__ ) . '/PageCreationNotif.sql',
                true
            ) );
		}

		return true;
	}

	/**
	 * Called just after a new Article is created.
	 *
	 * @since 0.1
	 */
	public static function onArticleInsertComplete( &$article, User &$user, $text, $summary, $minoredit, $watchthis, $sectionanchor, &$flags, Revision 
	$revision ) {
		PageCreationNotifEmailer::notifyOnNewArticle( $article );

		return true;
	}

}
