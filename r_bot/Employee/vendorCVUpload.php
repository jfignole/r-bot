<?php
if ($handle = opendir('../upload/')) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
            echo "$entry<br>";
        }
    }
    closedir($handle);
}
?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="../styles.css">
  </head>
  <body>
    <h1>CGI</h1>
    <h2>R-Bot</h2>
  </body>
