<?php
session_start();
$pageTitle = "Survey";
require "inc/header.inc.php";
require "inc/db_connect.inc.php";
require "inc/function.inc.php";
?>

<?php
$error_bucket = [];
$school_id;

if(is_post_request()) {

    if(!isset($_SESSION['student_id'])) {
        $student_id = "0";
    } else {
        $student_id = $db->real_escape_string($_SESSION['student_id']);
    }

    if ($_POST['results_1'] == " ") {
        array_push($error_bucket, "<p>Please select a school.</p>");
    } else {
        $results_1 = $db->real_escape_string($_POST['results_1']);
    }

    if ($results_1 == "University of Washington") {
        $school_id = $db->real_escape_string(2100);
    } elseif ($results_1 == "University of Oregon Portland") {
        $school_id = $db->real_escape_string(3696);
    } elseif ($results_1 == "Portland Community College Southeast") {
        $school_id = $db->real_escape_string(6111);
    } elseif ($results_1 == "Clark College") {
        $school_id = $db->real_escape_string(6398);
    } elseif ($results_1 == "Mt Hood Community College") {
        $school_id = $db->real_escape_string(6422);
    } elseif ($results_1 == "Portland State University") {
        $school_id = $db->real_escape_string(8887);
    } elseif ($results_1 == "Washington State University Vancouver") {
        $school_id = $db->real_escape_string(9788);
    }

    if ($_POST['results_2'] == " "){
        array_push($error_bucket, "<p>Please select a rating.</p>");
    } else {
        $results_2 = $db->real_escape_string($_POST['results_2']);
    }

    if (empty($_POST['results_3'])) {
        array_push($error_bucket, "<p>Please list what your school did great at.</p>");
    } else {
        $results_3 = $db->real_escape_string($_POST['results_3']);
    }

    if (empty($_POST['results_4'])) {
        array_push($error_bucket, "<p>Please list what your school could improve upon.</p>");
    } else {
        $results_4 = $db->real_escape_string($_POST['results_4']);
    }

    if (empty($_POST['results_5'])) {
        array_push($error_bucket, "<p>Please select whether you would recommend this school.</p>");
    } else {
        $results_5 = $db->real_escape_string($_POST['results_5']);
    }

    if (empty($_POST['results_6'])) {
        array_push($error_bucket, "<p>Please leave a comment about the school.</p>");
    } else {
        $results_5 = $db->real_escape_string($_POST['results_6']);
    }

    if (count($error_bucket) == 0) {

        $sql = "INSERT INTO results (student_id, school_id, results_1, results_2, results_3, results_4, results_5, results_6) VALUES ('$student_id', '$school_id', '$results_1', '$results_2', '$results_3', '$results_4', '$results_5', '$results_6')";

        $result = $db->query($sql);

        if (!$result) {
            echo "<p>Something went wrong with submitting your survey, please try again.</p>";
        } else {
            echo "<p>Your survey was submitted successfully!</p>";
        }
    } else {
        display_error_bucket($error_bucket);
    }
}
?>

<aside class=""sign_up">
    <h2>Rate The School's Survey</h2>
    <p>Here you can review your favorite school and have it posted on the home page for everyone to see. Since you're a member, you can delete you past reviews as long as you're signed in. Keep in mind that you cannot delete reviews from other members.</p>

    <form action="survey.php" method="post">
        <label for="school" id="school"></label><br>
        <select name="results_1" id="school">
            <option value=" " <?php if (isset($results_1) && $results_1 == " ") echo "selected" ?>>--Select--</option>

            <option value="University of Washington" <?php if (isset($results_1) && $results_1 == "University of Washington") echo "selected" ?>>University of Washington</option>

            <option value="University of Oregon Portland" <?php if (isset($results_1) && $results_1 == "University of Oregon Portland") echo "selected" ?>>University of Oregon Portland</option>

            <option value="Portland Community College Southeast" <?php if (isset($results_1) && $results_1 == "Portland Community College Southeast") echo "selected" ?>>Portland Community College Southeast</option>

            <option value="Clark College" <?php if (isset($results_1) && $results_1 == "Clark College") echo "selected" ?>>Clark College</option>

            <option value="Mt Hood Community College" <?php if (isset($results_1) && $results_1 == "Mt Hood Community College") echo "selected" ?>>Mt Hood Community College</option>

            <option value="Portland State University" <?php if (isset($results_1) && $results_1 == "Portland State University") echo "selected" ?>>Portland State University</option>
            
            <option value="Washington State University Vancouver" <?php if (isset($results_1) && $results_1 == "Washington State University Vancouver") echo "selected" ?>>Washington State University Vancouver</option>

        </select><br><br>

        <label for="rating">What rating would you give your school?</label><br>
        <select name="results_2" id="rating">
            <option value=" " <?php if (isset($results_2) && $results_2 = " ") echo "selected" ?>>--Select--</option>
            <option value="Bad" <?php if (isset($results_2) && $results_2 = "Bad") echo "selected" ?>>Bad</option>
            <option value="Poor" <?php if (isset($results_2) && $results_2 = "Poor") echo "selected" ?>>Poor</option>
            <option value="Fair" <?php if (isset($results_2) && $results_2 = "Fair") echo "selected" ?>>Fair</option>
            <option value="Good" <?php if (isset($results_2) && $results_2 = "Good") echo "selected" ?>>Good</option>
            <option value="Excellent" <?php if (isset($results_2) && $results_2 = "Excellent") echo "selected" ?>>Excellent</option>
        </select><br><br>

        <label for="did_great">What are the things the school did great?</label><br>
        <input type="text" name="results_3" id="did_great" size="40" maxlength="60" value="<?php echo (isset($results_3)) ? $results_3 : " " ?>"><br><br>

        <label for="improve">What could the school improve upon?</label><br>
        <input type="text" name="results_4" id="improve" size="40" maxlength="60" value="<?php echo (isset($results_4)) ? $results_4 : " " ?>"><br><br>

        <p>Would you recommend this school to other students?</p>

        <label for="yes">
            <input type="radio" name="results_5" id="yes" value="yes" <?php echo ($results_5 = "yes" ? "checked" : ""); ?>>
            Yes
        </label><br><br>

        <label for="no">
            <input type="radio" name="results_5" id="no" value="no" <?php echo ($results_5 = "no" ? "checked" : ""); ?>>
            No
        </label><br><br>

        <label for="comment">Additional comments?</label><br>
        <textarea name="results_6" id="comment" cols="42" rows="5" value="<?php echo (isset($results_6)) ? $results_6 : " " ?>"></textarea><br><br>

        <input type="submit" value="Submit Survey">

    </form>
</aside>

<?php
require "inc/footer.inc.php";
?>