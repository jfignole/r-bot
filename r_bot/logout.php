<?php /**
* Logout page.
*
* Logs user out of screen and returns to index.php for user login.
*
* @package r_bot
* @author Jonathan Fignole <jonathan.fignole@cgi.com>
* @copyright  2017 CGI Group Inc.
*/
session_start();
#Ends session and kicks back to login page
session_destroy();
header('Location: index.php');
die;
?>
