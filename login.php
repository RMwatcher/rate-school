<?php

session_start();
$pageTitle = "Login";
require "inc/header.inc.php";
require "inc/functions.inc.php";
require_once "inc/db_connect.inc.php";

?>

<?php
if (is_post_request()) {
    
    $username = $db->real_escape_string($_POST['username']);

    $password = hash('sha512', $db->real_escape_string($_POST['password']));

    $sql = "SELECT * FROM students WHERE username='$username' AND password='$password'";

    $result = $db->query($sql);

    if ($result->num_rows == 1) {

        $row = $result->fetch_assoc();
        $_SESSION['loggedin'] = 1;
        $_SESSION['username'] = $row['username'];
        $_SESSION['student_id'] = $row['student_id'];

        header('location: index.php');
    } else {
        echo '';
        echo '<p>Incorrect username and/or password. Please try again.</p>';
        echo '';
    }
}
?>

<aside class="about">
    <h2>Login</h2>
    <form action="login.php" method="POST">

        <label for="username">Username</label>
        <input type="text" name="username" required id="username" placeholder="Enter username">

        <label for="password">Password</label>
        <span id="showPassword" onClick="showPassword();">Show Password</span>
        <input type="password" name="password" required id="password" placeholder="password">

        <input type="submit" value="Login">

    </form>

    <p>New User? <a href="register.php">Register</a></p>
</aside>

<script src="js/script.js"></script>
<?php

require "inc/footer.inc.php";

?>
