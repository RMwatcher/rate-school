<?php

// mysqli(hostname, username, password, database)
$db = new mysqli('localhost', 'root', '', 'rate-school');
if ($db->connect_error) {
    $error = $db->connect_error;
    echo $error;
}
$db->set_charset('utf8');
?>