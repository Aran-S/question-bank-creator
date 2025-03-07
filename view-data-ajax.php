<?php
$q = intval($_GET['q']);

include('configs/db.php');

$sql = "SELECT DISTINCT regulation FROM courses WHERE program_id='" . $q . "'";
$result = mysqli_query($con, $sql);
echo "<div class='mb-3'>";
echo "<select class='form-control' id='regulation' name='regulation' onchange='showCourseTitles()' required>";
echo "<option value=''>-- SELECT Regulation --</option>";
while ($row = mysqli_fetch_array($result)) {
    echo "<option value='" . $row['regulation'] . "'>" . $row['regulation'] . "</option>";
}
echo "</select>";
echo "</div>";
?>