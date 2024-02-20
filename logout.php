<?php
session_start();
session_unset();
session_destroy();
$pageTitle = "Logged Out";
require "inc/header_logout.inc.php";
?>

<h2>You have successfully logged out.</h2>

<p>You'll be redirected back to the home page within a few seconds.</p>

<?php
require "inc/footer.inc.php";
?>
