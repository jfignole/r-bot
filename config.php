<?php
/**
* @package r_bot
* @author Jonathan Fignole <jonathan.fignole@cgi.com>
* @copyright  2017 CGI Group Inc.
*/
    #set off all error for security purposes
	error_reporting(E_ALL);
	#define some contstants for connection to the database
    define( "DB_DSN", "mysql:host=localhost;dbname=r_bot" );
    define( "DB_USERNAME", "root" );
    define( "DB_PASSWORD", "cgi@1234" );
	define( "CLS_PATH", "class" ); #Define the CLass Path
	#include the classes and their paths
	include_once(CLS_PATH . "/user.php" );
	include_once(CLS_PATH . "/vendors.php");
	include_once(CLS_PATH . "/rmClass.php");
	include_once(CLS_PATH . "/template.php");
?>
