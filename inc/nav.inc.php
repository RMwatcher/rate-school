<nav>
    <a href="index.php">Home</a>
    <?= (!isset($_SESSION['username'])) ? "<a href=\"login.php\">Login</a>" : ""; ?>
    <a href="register.php">Register</a>
    <?php
    if (isset($_SESSION['username'])) {
        echo "<a href=\"survey.php\">Survey</a>";
        echo "<a href=\"logout.php\">Logout</a>";
    }
    ?>
</nav>
<h2>Welcome <?= isset($_SESSION['username']) ? $_SESSION['username'] : "guest" ?></h2>