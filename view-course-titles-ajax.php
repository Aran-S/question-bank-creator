<?php
$program_id = intval($_GET['program_id']);
$regulation = $_GET['regulation'];

include('configs/db.php');

$sql = "SELECT DISTINCT title,semester FROM courses WHERE program_id='" . $program_id . "' AND regulation='" . $regulation . "' ORDER BY semester";
$result = mysqli_query($con, $sql);

echo "<select class='form-control' name='course_title'>";
echo "<option value=''>-- SELECT Course Title --</option>";
while ($row = mysqli_fetch_array($result)) {
    echo "<option value='" . $row['title'] . "'>" . $row['title'] . "</option>";
}
echo "</select>";
?>