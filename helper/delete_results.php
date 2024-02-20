<?php
session_start();
$pageTitle = "Post Deleted";
require "inc/header_logout.inc.php";
require "inc/nav.inc.php";
require "inc/functions.inc.php";
require "inc/db_connect.inc.php";

if (!isset($_GET['student_id'])) {
    echo "<p>We cannot delete this post for you.</p>";
    die();
}

delete_results($db);

require "inc/footer.inc.php";