<?php

session_start();
$pageTitle = "Rate The School";
require_once "inc/header.inc.php";
require_once "inc/db_connect.inc.php";

?>

<p>Welcome to Rate the School where you'll be able to see reviews of different schools
    from various students all around the Pacific NorthWest.
    Simply look for a school of your choosing and see what other
    students are saying about that school, or you can sign-up to Rate the School and post a review yourself.</p>

<?php

if (is_post_request()) {

    if (empty($_POST['search'])) {
        echo"<p>Please enter the name of the school you want to search for.</p>";
    } else {
        $search = $db->real_escape_string($_POST['search']);
    }
}

$sql = "SELECT students.username, schools.school_name, results.results_1,
results.results_2, results.results_3, results.results_4, results.results_5,
results.results_6 FROM results JOIN students ON students.student_id = results.student_id
JOIN schools ON schools.school_id = results.school_id WHERE schools.school_name = $search ORDER BY date DESC";

$result = $db->query($sql);

if (!$result->num_rows == 1) {
    echo "<p>No schools were found in your search.</p>";
} else {
    echo "<p>Here are your search results.</p>";
    echo "<article class=\"review\">";
}

while ($row = $result->fetch_assoc()) {
    if (isset($_SESSION['username']) && $_SESSION['username'] == $row['username']) {
        echo "<div class=\"delete\"><a href=
        \"helper/delete_results.php?student_id=" . $_SESSION['student_id'] . "\"Delete</a></div><br>";
    }

    echo "<aside class=\"review_results\">";

    echo "<h4>School:</h4>";

    switch ($row['results_1']) {
        case "University of Washington":
            echo "<p>University of Washington</p>";
            break;
        case "University of Oregon Portland":
            echo "<p>University of Oregon Portland</p>";
            break;
        case "Portland Community College Southeast":
            echo "<p>Portland Community College Southeast</p>";
            break;
        case "Clark College":
            echo "<p>Clark College</p>";
            break;
        case "Mt Hood Community College":
            echo "<p>Mt Hood Community College</p>";
            break;
        case "Portland State University":
            echo "<p>Portland State University</p>";
            break;
        case "Washington State University Vancouver":
            echo "<p>Washington State University Vancouver</p>";
            break;
        default:
            echo "<p>No School Was Selected</p>";
            break;
    }

    echo "<h4>Username:</h4>";

    echo "<p>" . $row['username'] . "</p>";

    echo "<h4>Rating:</h4>";

    echo "<p>{$row['result_2']}</p>";

    echo "<h4>Things the school did great:</h4>";

    echo "<p>{$row['result_3']}</p>";

    echo "<h4>What could be improved upon:</h4>";

    echo "<p>{$row['result_4']}</p>";

    echo "<h4>Recommend this school to other students?:</h4>";

    echo "<p>{$row['result_5']}</p>";

    echo "<h4>Additional comments:</h4>";

    echo "<p>{$row['result_6']}</p>";

    echo "</aside>";
}

?>

<search>
    <form action="index.php" method="post">
        <label for="search">Search for School:</label>
        <input type="search" id="search" name="search">
        <input type="submit" value="Submit">
        <input type="reset" value="Clear">
    </form>
</search>

<?php

$sql = "SELECT students.username, schools.school_name, results.results_1, results.results_2,
 results.results_3, results.results_4, results.results_5, results.results_6
 FROM results JOIN students ON students.student_id = results.student_id
 JOIN schools ON schools.school_id = results.school_id ORDER BY date DESC";

$result = $db->query($sql);

if (!$result->num_rows == 1){
    echo "<p>There are no reviews at this time.</p>";
} else {
    echo "<p>Here are what other people are saying about their schools.</p>";
    echo "<article class=\"review\">";
}

while ($row = $result->fetch_assoc()) {
    if (isset($_SESSION['username']) && $_SESSION['username'] == $row['username']) {
        echo "<div class=\"delete\"><a href=
        \"helper/delete_results.php?student_id=" . $_SESSION['student_id'] . "\"Delete</a></div><br>";
    }

    echo "<aside class=\"review_results\">";

    echo "<h3>School:</h3>";

    switch ($row['results_1']) {
        case "University of Washington":
            echo "<p>University of Washington</p>";
            break;
        case "University of Oregon Portland":
            echo "<p>University of Oregon Portland</p>";
            break;
        case "Portland Community College Southeast":
            echo "<p>Portland Community College Southeast</p>";
            break;
        case "Clark College":
            echo "<p>Clark College</p>";
            break;
        case "Mt Hood Community College":
            echo "<p>Mt Hood Community College</p>";
            break;
        case "Portland State University":
            echo "<p>Portland State University</p>";
            break;
        case "Washington State University Vancouver":
            echo "<p>Washington State University Vancouver</p>";
            break;
        default:
            echo "<p>No School Was Selected</p>";
            break;
    }

    echo "<h4>Username:</h4>";

    echo "<p>" . $row['username'] . "</p>";

    echo "<h4>Rating:</h4>";

    echo "<p>{$row['result_2']}</p>";

    echo "<h4>Things the school did great:</h4>";

    echo "<p>{$row['result_3']}</p>";

    echo "<h4>What could be improved upon:</h4>";

    echo "<p>{$row['result_4']}</p>";

    echo "<h4>Recommend this school to other students?:</h4>";

    echo "<p>{$row['result_5']}</p>";

    echo "<h4>Additional comments:</h4>";

    echo "<p>{$row['result_6']}</p>";

    echo "</aside>";
}
?>

<script defer src="js/script.js"></script>
<?php
require_once "inc/footer.inc.php";

?>
