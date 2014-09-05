<?php

	/*
	 * Plugin Name: CTLT Redirect WP-Signup For Non-Logged-in Users
	 * Plugin URI: http://ctlt.ubc.ca/
	 * Description: Prevent non-logged-in access to the wp-signup.php file
	 * Version: 0.1
	 * Author: Richard Tape, UBC CTLT
	 * Author URI: http://richardtape.com/
	 * License: GPLv2 or later
	 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
	 * TextDomain: rwsnliu
	 * DomainPath:
	 * Network: true
	 */

	// If this file is called directly, abort.
	if( !defined( 'WPINC' ) ){
		die;
	}

	class CTLT_Redirect_WPSignup_For_Non_Logged_In_Users
	{

		/**
		 * Actions and filters
		 *
		 * @since 0.1
		 *
		 * @param null
		 * @return null
		 */

		public function __construct()
		{

			// Redirect to log in if not logged in
			add_action( 'signup_header', array( $this, 'signup_header__redirectUsersIfNotLoggedIn' ), 1 );

		}/* __construct() */


		/**
		 * If a user tries to access the wp-signup.php page directly, redirect them to login
		 *
		 * @since 0.1
		 *
		 * @param null
		 * @return null
		 */

		public function signup_header__redirectUsersIfNotLoggedIn()
		{

			// If they're logged in, we're good
			if( is_user_logged_in() ){
				return;
			}

			// Check if we have a redirect_to, in which case sanitize and apply that
			$redirectTo = ( isset( $_GET['redirect_to'] ) ) ? sanitize_text_field( $_GET['redirect_to'] ) : home_url( 'wp-signup.php' );

			wp_redirect( wp_login_url( $redirectTo ) );

			exit;

		}/* signup_header__redirectUsersIfNotLoggedIn() */

	}/* class CTLT_Redirect_WPSignup_For_Non_Logged_In_Users */

	$CTLT_Redirect_WPSignup_For_Non_Logged_In_Users = new CTLT_Redirect_WPSignup_For_Non_Logged_In_Users;