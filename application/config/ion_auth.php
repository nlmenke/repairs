<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/*
| Name:			Ion Auth Config
| Author:		Ben Edmunds
| 				ben.edmunds@gmail.com
| 				@benedmunds
| Edits:		Phil Sturgeon
| Location:		http://github.com/benedmunds/CodeIgniter-Ion-Auth/
| Created:		10/01/2009
| Description:	Modified auth system based on redux_auth with extensive
| 				customization. This is basically what Redux Auth 2 should
| 				be. Original Author name has been kept but that does not
| 				mean that the method has not been modified.
*/

$config['tables']['groups']					= 'groups';
$config['tables']['users']					= 'users';
$config['tables']['meta']					= 'meta';

$config['site_title']						= 'Gamers inc. Orlando';		// Site Title (example.com)
$config['admin_email']						= 'support@gamersorlando.com';	// Admin Email (admin@example.com)
$config['default_group']					= 'customer';					// Default Group (use name)
$config['admin_group']						= 'admin';						// Administrators Group (use name)
$config['join']								= 'user_id';					// Meta table column you want to join WITH. Joins from users.id
$config['columns']							= array(
	'first_name',
	'last_name',
	'phone',
	'company'
);																			// Columns in your meta table, id not required
$config['identity']							= 'email';						// A database column which is used to login
$config['min_password_length']				= 6;							// Minimum Required Length of Password
$config['max_password_length']				= 20;							// Maximum Allowed Length of Password
$config['email_activation']					= FALSE;						// Email Activation for registration
$config['remember_users']					= TRUE;							// Allow users to be remembered and enable auto-login
$config['user_expire']						= 86500;						// How long to remember the user (seconds)
$config['user_extend_on_login']				= FALSE;						// Extend the users cookies everytime they auto-login
$config['email_type']						= 'html';						// Type of email to send (HTML or text), Default: html
$config['email_templates']					= 'auth/email/';				// Folder where email templates are stored, Default : auth/email/
$config['email_activate']					= 'activate.tpl.php';			// Activate Account Email Template, Default: activate.tpl.php
$config['email_forgot_password']			= 'forgot_password.tpl.php';	// Forgot Password Email Template, Default: forgot_password.tpl.php
$config['email_forgot_password_complete']	= 'new_password.tpl.php';		// Forgot Password Complete Email Template, Default: new_password.tpl.php
$config['salt_length']						= 10;							// Salt Length, needs to be at least as long as the minimum password length
$config['store_salt']						= FALSE;						// Should the salt be stored in the database? This will change your password encryption algorithm, default password, 'password', changes to fbaa5e216d163a02ae630ab1a43372635dd374c0 with default salt.
$config['message_start_delimiter']			= '<p>';						// Message Start Delimiter
$config['message_end_delimiter']			= '</p>';						// Message End Delimiter
$config['error_start_delimiter']			= '<p>';						// Error Start Delimiter
$config['error_end_delimiter']				= '</p>';						// Error End Delimiter

/* End of file ion_auth.php */
/* Location: ./system/application/config/ion_auth.php */