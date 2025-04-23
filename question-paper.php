<?php include("header.php") ?>
<?php
if (isset($_POST['program_id'])) {
    $program_id = $_POST['program_id'];
    $regulation = $_POST['regulation'];
    $course_title = $_POST['course_title'];
    $date = date("d-m-Y", strtotime($_POST['date']));

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

        shuffle($sectionA);
        shuffle($sectionB);
        shuffle($sectionC);
    }

    // Ensure the required number of questions for each section
    if (count($sectionA) < 10 || count($sectionB) < 10 || count($sectionC) < 6) {
        echo "<div class='alert alert-danger text-center'>Not enough questions to create a question paper. Section A requires 10 questions, Section B requires 10 questions (5 pairs), and Section C requires 6 questions (3 pairs).</div>";
        exit;
    } else {
        $sem = "SELECT semester FROM question WHERE program_id='$program_id' AND regulation='$regulation' AND course_title LIKE '%$course_title%' AND department_id='$department_id'";
        $result = $con->query($sem);
        $semester = $result->fetch_assoc()['semester'];

        $semesterText = [
            "I Semester",
            "II Semester",
            "III Semester",
            "IV Semester",
            "V Semester",
            "VI Semester",
            "VII Semester",
            "VIII Semester",
            "IX Semester",
            "X Semester",
            "XI Semester",
            "XII Semester",
            "XIII Semester",
            "XIV Semester"
        ];
        $semester = isset($semesterText[$semester - 1]) ? $semesterText[$semester - 1] : "Unknown Semester";

        $code = "SELECT subject_code FROM courses WHERE title1 LIKE '%$course_title%' AND program_id='$program_id'";
        $result = $con->query($code);
        $subject_code = $result->fetch_assoc()['subject_code'] ?? '';
        $prgm = "SELECT degree,subject FROM programs WHERE id='$program_id'";
        $result = $con->query($prgm);
        $row = $result->fetch_assoc();
        $degree = $row['degree'];
        $subject = $row['subject'];
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

            .header-container {
                display: flex;
                justify-content: space-between;
                font-weight: bold;
                margin-bottom: 10px;
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

            <div class="text-center">
                <img src="assets/logo.gif" alt="College Logo" class="logo mb-2">
                <h5 class="text-uppercase fw-bold">Department OF Computer Science and Engineering</h5>
                <p class="fw-bold text-primary">(Accredited by NAAC With "A" Grade)</p>
                <p class="fw-bold"> Bharathidasan University, Tiruchirappalli - 23</p>

                <div class="header-container">
                    <span>Date:&nbsp;<?php echo $date; ?></span>
                    <span>Time:&nbsp;3 Hours</span>
                </div>
                <div class="header-container">
                    <span>Program:&nbsp;<?php echo $degree . "" . "($subject)"; ?></span>&nbsp;
                    <span>Course Code:&nbsp;<?php echo $subject_code; ?></span>
                </div>
                <br>
                <h5 class="text-uppercase fw-bold"><?php echo $semester; ?></h5>
                <h6 class="fw-bold text-secondary"><?php echo htmlspecialchars($course_title); ?></h6>
                <hr>
            </div>

            <div class="text-end">
                <button class="btn btn-primary print-btn" onclick="window.print()">Print</button>
            </div>

            <div>
                <h6 class="fw-bold text-center">SECTION-A (2 Marks Each)</h6>
                <ol>
                    <?php
                    $totalMarks = 0;
                    for ($i = 0; $i < 10; $i++) {
                        echo "<li>" . htmlspecialchars($sectionA[$i]) . "</li>";
                        $totalMarks += 2;
                    }
                    ?>
                </ol>
                <hr>
                <h6 class="fw-bold text-center">SECTION-B (5 Marks Each)</h6>
                <ol>
                    <?php
                    for ($i = 0; $i < 5; $i++) {
                        echo "<li>";
                        echo "a) " . htmlspecialchars($sectionB[$i * 2]) . "<br>";
                        echo "b) " . htmlspecialchars($sectionB[$i * 2 + 1]);
                        echo "</li>";
                        $totalMarks += 5;
                    }
                    ?>
                </ol>
                <hr>
                <h6 class="fw-bold text-center">SECTION-C (10 Marks Each)</h6>
                <ol>
                    <?php
                    for ($i = 0; $i < 3; $i++) {
                        echo "<li>";
                        echo "a) " . htmlspecialchars($sectionC[$i * 2]) . "<br>";
                        echo "b) " . htmlspecialchars($sectionC[$i * 2 + 1]);
                        echo "</li>";
                        $totalMarks += 10;
                    }
                    ?>
                </ol>
            </div>
        </div>


        <script>
            document.title = "<?php echo $subject_code; ?>";

            function printDocument() {
                window.print();
            }

            window.onbeforeprint = function() {
                document.querySelector(".print-btn").style.display = "none";
            };

            window.onafterprint = function() {
                document.querySelector(".print-btn").style.display = "block";
            };
        </script>


<?php
    }
}
?>
<?php include("footer.php") ?>