<?php
/* 
 * initialization...
 */
//Directory Separator is Pre-Defined in PHP
//This takes care of / or \ between windows and unix
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

defined('SITE_ROOT') ? null :
        define('SITE_ROOT', 'C:'.DS.'wamp'.DS.'www'.DS.'photo_gallery');

defined('LIB_PATH') ? null :
        define('LIB_PATH', SITE_ROOT.DS.'includes');

//Load config file first
require_once (LIB_PATH.DS.'config.php');

//Load basic functions
require_once (LIB_PATH.DS.'functions.php');

//Load core objects
require_once (LIB_PATH.DS.'session.php');
require_once (LIB_PATH.DS.'database.php');
require_once (LIB_PATH.DS.'DatabaseObject.php');

// Load DB related classes
require_once (LIB_PATH.DS.'user.php');
?>