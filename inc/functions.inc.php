<?php

function is_post_request() {
    return $_SERVER['REQUEST_METHOD'] == 'POST';
}

function has_length_greater_than($value, $min) {
    $length = strlen($value);
    return $length > $min;
}

function display_error_bucket($error_bucket) {
    echo '<div class="pt-4 alert alert-warning">';
    echo '<p>The following errors were detected:</p>';
    echo '<ul>';
    foreach ($error_bucket as $text) {
        echo '<li>' . $text . '</li>';
    }
    echo '</ul>';
    echo '<p>All of these fields are required. Please fill them in.</p>';
    echo '</div>';
}


function delete_results($db) {
    $sql = "DELETE FROM results WHERE student_id = " . $_GET['student_id'] . " LIMIT 1";

    echo $sql;

    $result = $db->query($sql);

    if (!$db->error) {
        $db->close();
        header("location: index.php");
    } else {
        return false;
    }
}