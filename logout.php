<?php
include_once("includes/header.php");
/*
echo "<br>Post: ";
print_r($_POST);
echo "<br>Get: ";
print_r($_GET);
echo "<br>Session: ";
print_r($_SESSION);
*/
logout_user();
set_message('<div class="alert alert-success justify-content-center text-center">Sie wurden erfolgreich ausgeloggt</div>');
redirect("index.php"); 
?>
