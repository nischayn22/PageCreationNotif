<?php

/**
 * Class holding functions for sending emails.
 *
 * @since 0.1
 *
 * @file PageCreationNotifEmailer.php
 * @ingroup PageCreationNotif
 *
 * @licence GNU GPL v3 or later
 * @author Nischay Nahata < nischayn22@gmail.com >
 */
class PageCreationNotifEmailer {

	/**
	 * This function will notify all users using PCN by emails about
	 * creation of a new article.
	 *
	 * @since 0.1
	 *
	 */
	public static function notifyOnNewArticle( $article, $user ) {
		global $wgPCNSender, $wgPCNSenderName;

		$usersEmail = self::getNotifUsersEmail();
		$subject = wfMsgExt(
			'page-creation-email-subject',
			'parse',
			$article->getTitle()->getFullText(),
			$GLOBALS['wgSitename']
		);

		$emailText = wfMsgExt(
			'page-creation-email-body',
			'parse',
			$article->getTitle()->getFullText(),
			$user->getName(),
			$GLOBALS['wgSitename'],
			$article->getTitle()->getFullURL()
		);

		UserMailer::send(
			$usersEmail,
			new MailAddress( $wgPCNSender, $wgPCNSenderName ),
			$subject,
			$emailText,
			null,
			'text/html; charset=ISO-8859-1'
		);
		// die silently ignoring the status message
	}

	/**
	 * Get all the users and their e-mail addresses
	 *
	 * @since 0.1
	 *
	 * @return Array of String containing user's email addresses
	 */
	public static function getNotifUsersEmail() {
		$dbr = wfGetDB( DB_SLAVE );

		$rows = $dbr->select(
			'pcn_users',
			array(
				'pcn_user_id'
			),
			array(
				'pcn_notify' => 1
			)
		);
		
		$usersEmail = array();
		
		foreach ( $rows as $row ) {
			$usersEmail[] = new MailAddress( User::newFromId( $row->pcn_user_id ) );
		}

		return $usersEmail;
	}
}