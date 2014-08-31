<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/*
| ------------------------------------------------------------------------
|  DATABASE TYPE
| ------------------------------------------------------------------------
| If set to TRUE, Ion Auth will use MongoDB as its database backend.
|
| If you use MongoDB there are two external dependencies that have to be
| integrated with your project:
|   CodeIgniter MongoDB Active Record Library
|       - http://github.com/alexbilbie/codeigniter-mongodb-library/tree/v2
|   CodeIgniter MongoDB Session Library
|       - http://github.com/sepehr/ci-mongodb-session
*/

$config['use_mongodb'] = false;

/*
| ------------------------------------------------------------------------
|  MONGODB COLLECTION
| ------------------------------------------------------------------------
| Setup the mongodb docs using the following command:
|   $ mongorestore sql/mongo
*/

$config['collections']['users']          = 'users';
$config['collections']['groups']         = 'groups';
$config['collections']['login_attempts'] = 'login_attempts';

/*
| ------------------------------------------------------------------------
|  TABLES
| ------------------------------------------------------------------------
| Database table names.
*/

$config['tables']['users']          = 'users';
$config['tables']['groups']         = 'groups';
$config['tables']['users_groups']   = 'users_groups';
$config['tables']['login_attempts'] = 'login_attempts';

/*
| Users table column and Group table column you want to join WITH.
|
|   Joins from users.id
|   Joins from groups.id
*/

$config['join']['users']  = 'user_id';
$config['join']['groups'] = 'group_id';

/*
| ------------------------------------------------------------------------
|  Hash Method (sha1 or bcrypt)
| ------------------------------------------------------------------------
| Bcrypt is available in PHP 5.3+
|
| IMPORTANT: Based on the recommendation by many professionals, it is
| highly recommended to use bcrypt instead of sha1.
|
| NOTE: If you use bcrypt you will need to increase your password column
| character limit to (80).
|
| Below there is "default_rounds" setting. This defines how strong the
| encryption will be, but remember the more rounds you set the longer it
| will take to hash (CPU usage) so adjust this based on your server
| hardware.
|
| If you are using Bcrypt the Admin password field also needs to be
| changed in order login as admin:
|   $2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36
|
| Be careful how high you set max_rounds, I would do your own testing on
| how long it takes to encrypt with x rounds.
*/

$config['hash_method']    = 'bcrypt'; // IMPORTANT: Make sure this is set to either sha1 or bcrypt.
$config['default_rounds'] = 8; // This does not apply if random_rounds is set to true.
$config['random_rounds']  = false;
$config['min_rounds']     = 5;
$config['max_rounds']     = 9;

/*
| ------------------------------------------------------------------------
|  AUTHENTICATION OPTIONS
| ------------------------------------------------------------------------
| maximum_login_attempts: This maximum is not enforced by the library, but
| is used by $this->ion_auth->is_max_login_attempts_exceeded(). The
| controller should check this function and act appropriately. If this
| variable set to 0, there is no maximum.
*/

$config['site_title']                 = 'Example'; // Site Title, example.com.
$config['admin_email']                = 'admin@example.com'; // Admin Email, admin@example.com.
$config['default_group']              = 'customer'; // Default group, use name.
$config['admin_group']                = 'admin'; // Default administrators group, use name.
$config['identity']                   = 'email'; // A database column which is used to login with.
$config['min_password_length']        = 6; // Minimum Required Length of Password.
$config['max_password_length']        = 20; // Maximum Allowed Length of Password.
$config['email_activation']           = false; // Email Activation for registration.
$config['manual_activation']          = false; // Manual Activation for registration.
$config['remember_users']             = true; // Allow users to be remembered and enable auto-login.
$config['user_expire']                = 86500; // How long to remember the user (seconds). Set to zero for no expiration.
$config['user_extend_on_login']       = false; // Extend the users cookies everytime they auto-login.
$config['track_login_attempts']       = false; // Track the number of failed login attempts for each user or ip.
$config['maximum_login_attempts']     = 3; // The maximum number of failed login attempts.
$config['lockout_time']               = 600; // The number of seconds to lockout an account due to exceeded attempts.
$config['forgot_password_expiration'] = 0; // The number of miliseconds after which a forgot password request will expire. If set to 0, forgot password requests will not expire.

/*
| ------------------------------------------------------------------------
|  EMAIL OPTIONS
| ------------------------------------------------------------------------
| email_config:
|   'file'  = Use the default CI config or use from a config file.
|   array   = Manually set your email config settings.
*/

$config['use_ci_email'] = false; // Send Email using the builtin CI email class, if false it will return the code and the identity.
$config['email_config'] = array(
    'mailtype' => 'html',
);

/*
| ------------------------------------------------------------------------
|  EMAIL TEMPLATES
| ------------------------------------------------------------------------
| Folder where email templates are stored. Default: auth/
*/

$config['email_templates'] = 'auth/email/';

/*
| ------------------------------------------------------------------------
|  ACTIVATE ACCOUNT EMAIL TEMPLATE
| ------------------------------------------------------------------------
| Default: activate.tpl.php
*/

$config['email_activate'] = 'activate.tpl.php';

/*
| ------------------------------------------------------------------------
|  FORGOT PASSWORD EMAIL TEMPLATE
| ------------------------------------------------------------------------
| Default: forgot_password.tpl.php
*/

$config['email_forgot_password'] = 'forgot_password.tpl.php';

/*
| ------------------------------------------------------------------------
|  FORGOT PASSWORD COMPLETE EMAIL TEMPLATE
| ------------------------------------------------------------------------
| Default: new_password.tpl.php
*/

$config['email_forgot_password_complete'] = 'new_password.tpl.php';

/*
| ------------------------------------------------------------------------
|  SALT OPTIONS
| ------------------------------------------------------------------------
| salt_length Default: 10
|
| store_salt: Should the salt be stored in the database? This will change
| your password encryption algorithm, default password, 'password',
| changes to:
|   fbaa5e216d163a02ae630ab1a43372635dd374c0 with default salt.
*/

$config['salt_length'] = 10;
$config['store_salt']  = false;

/*
| ------------------------------------------------------------------------
|  MESSAGE DELIMITERS
| ------------------------------------------------------------------------
*/

$config['message_start_delimiter'] = '<p>'; // Message start delimiter.
$config['message_end_delimiter']   = '</p>'; // Message end delimiter.
$config['error_start_delimiter']   = '<p>'; // Error mesage start delimiter.
$config['error_end_delimiter']     = '</p>'; // Error mesage end delimiter.

/* End of file ion_auth.php */
/* Location: ./application/config/ion_auth.php */