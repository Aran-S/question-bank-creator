<?php include("header.php") ?>
<?php
if (isset($_POST['program_id'])) {
    $program_id = $_POST['program_id'];
    $regulation = $_POST['regulation'];
    $course_title = $_POST['course_title'];
    $sql = "SELECT * FROM question WHERE program_id='$program_id' AND regulation='$regulation' AND course_title='$course_title' AND department_id='$department_id'";
    $result = $con->query($sql);

    $sectionA = [];
    $sectionB = [];
    $sectionC = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $question_part = $row['question_part'];
            $question = $row['questions'];

            if ($question_part == 1) {
                $sectionA[] = $question;
            } elseif ($question_part == 2) {
                $sectionB[] = $question;
            } elseif ($question_part == 3) {
                $sectionC[] = $question;
            }
        }

        // Shuffle the questions within each section
        shuffle($sectionA);
        shuffle($sectionB);
        shuffle($sectionC);
    }
}
?>
<style>
    body {
        font-family: Arial, sans-serif;
    }

    .logo {
        max-width: 100px;
    }

    .print-btn {
        margin-bottom: 20px;
    }

    @media print {

        .navbar,
        footer,
        #live-time,
        .card.mb-3.mt-3 {
            display: none;
        }
    }
</style>
<div class="container mt-4">
    <!-- Header Section -->
    <div class="text-center">
        <img src="assets/logo.gif" alt="College Logo" class="logo mb-2">
        <h5 class="text-uppercase fw-bold">Department OF Computer Science and Engineering</h5>
        <p class="fw-bold text-primary">(Accredited by NAAC With "A" Grade)</p>
        <p class="fw-bold"> Bharathidasan University, Tiruchirappalli - 24</p>
        <hr>
        <h4 class="fw-bold">Department of Business Administration</h4>
        <h5 class="text-uppercase">Question Bank - III Semester</h5>
        <h6 class="fw-bold text-secondary"></h6><?php echo $course_title ?></h6>
    </div>

    <!-- Print Button -->
    <div class="text-end">
        <button class="btn btn-primary print-btn" onclick="window.print()">Print</button>
    </div>

    <!-- Question Sections -->
    <div>
        <h5 class="fw-bold">UNIT-I</h5>
        <h6 class="fw-bold">SECTION-A (2 Marks Each)</h6>
        <ol>
            <?php
            $totalMarks = 0;
            foreach ($sectionA as $question) {
                if ($totalMarks + 2 <= 75) {
                    echo "<li>" . htmlspecialchars($question) . "</li>";
                    $totalMarks += 2;
                }
            }
            ?>
        </ol>

        <h6 class="fw-bold">SECTION-B (5 Marks Each)</h6>
        <ol>
            <?php
            foreach ($sectionB as $question) {
                if ($totalMarks + 5 <= 75) {
                    echo "<li>" . htmlspecialchars($question) . "</li>";
                    $totalMarks += 5;
                }
            }
            ?>
        </ol>

        <h6 class="fw-bold">SECTION-C (10 Marks Each)</h6>
        <ol>
            <?php
            foreach ($sectionC as $question) {
                if ($totalMarks + 10 <= 75) {
                    echo "<li>" . htmlspecialchars($question) . "</li>";
                    $totalMarks += 10;
                }
            }
            ?>
        </ol>
    </div>
</div>

<script>
    // Hide the print button while printing
    window.onbeforeprint = function() {
        document.querySelector(".print-btn").style.display = "none";
    };
    window.onafterprint = function() {
        document.querySelector(".print-btn").style.display = "block";
    };
</script>
<?php include("footer.php") ?>