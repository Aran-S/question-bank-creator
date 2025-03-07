<?php include("header.php") ?>
<div class="mb-5 mt-5">
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center">Add New Questions</h3>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <?php
                    if (isset($_POST['program_id'])) {
                        $program_id = $_POST['program_id'];
                        $regulation = $_POST['regulation'];
                        $course_title = $_POST['course_title'];
                        $part = $_POST['part'];
                        $questions = $_POST['questions'];
                        $semester = $_POST['semester'];
                        $inserted=0;
                        $array=array_filter(array_map('trim',explode( '!!',$questions)));
                        foreach($array as $array_questions){
                        $sql = "INSERT INTO question(program_id, department_id,regulation, course_title, question_part, questions,semester) VALUES('$program_id','$department_id', '$regulation', '$course_title', '$part', '$array_questions','$semester')";
                        if ($con->query($sql) === TRUE) {
                            $inserted++;
                        } else {
                            echo "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $con->error . "</div>";
                        }
                    }
                        if ($inserted > 0) {
                            echo "<div class='alert alert-success'>$inserted questions inserted successfully</div>";
                        }

                    }
                    ?>
                    <div class="mb-3">
                        <label for="program_id" class="form-label">Program</label>
                        <select class="form-select" id="program_id" name="program_id" required onchange="showRegulation(this.value)">
                            <option value="" selected>Select program</option>
                            <?php
                            $crse = "SELECT * FROM programs WHERE department_id = '$department_id'";
                            $result = $con->query($crse);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row['id'] . "'>" . $row['title'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Regulation</label>
                        <div id="regulationHint">
                            <select class="form-control" id="regulation" name="regulation" required>
                                <option value="">-- SELECT Regulation --</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Course Title</label>
                        <div id="courseTitleHint">
                            <select class="form-control" name="course_title" required>
                                <option value="">-- SELECT Course Title --</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="semester">Semester</label>
                        <input type="number" class="form-control" placeholder="Enter Semester" id="semester" name="semester" required>
                    </div>
                    <div class="mb-3">
                        <label for="part" class="form-label">Select Part</label>
                        <select class="form-control" name="part" id="part" required>
                            <option value="" selected>[--Select Part--]</option>
                            <option value="1">Part 1</option>
                            <option value="2">Part 2</option>
                            <option value="3">Part 3</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="questions" class="form-label">Questions [ use double exclamatory(!!) at the end of the questions ]</label>
                        <textarea class="form-control" id="questions" name="questions" rows="3" required></textarea>
                    </div>
                    <div class="text-center">
                    <button type="submit" class="btn btn-primary">Submit</button></div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function showRegulation(programId) {
        if (programId == "") {
            document.getElementById("regulationHint").innerHTML = "<select class='form-control' id='regulation' name='regulation' required><option value=''>-- SELECT Regulation --</option></select>";
            return;
        }
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("regulationHint").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "view-data-ajax.php?q=" + programId, true);
        xhttp.send();
    }

    function showCourseTitles() {
        var programId = document.getElementById("program_id").value;
        var regulation = document.getElementById("regulation").value;
        if (programId == "" || regulation == "") {
            document.getElementById("courseTitleHint").innerHTML = "<select class='form-control' name='course_title' required><option value=''>-- SELECT Course Title --</option></select>";
            return;
        }
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("courseTitleHint").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "view-course-titles-ajax.php?program_id=" + programId + "&regulation=" + regulation, true);
        xhttp.send();
    }
</script>
<?php include("footer.php") ?>