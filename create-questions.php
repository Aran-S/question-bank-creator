<?php include("header.php") ?>
<div class="mb-5 mt-5">
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center">Create Questions</h3>
            </div>
            <div class="mt-3">
            </div>
            <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <?php
                    ?>
                    <div class="mb-3">
                        <label for="program_id" class="form-label">Program</label>
                        <select class="form-select" id="program_id" name="program_id" required onchange="showRegulation(this.value)">
                            <option value="" selected>Select program</option>
                            <?php
                            $crse = "SELECT DISTINCT p.program_id,pr.* FROM programs pr,question p WHERE pr.department_id = '$department_id' AND pr.id=p.program_id";
                            $result = $con->query($crse);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row['id'] . "'>" . $row['title'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label>Regulation</label>
                        <div id="regulationHint">
                            <select class="form-control" id="regulation" name="regulation" required onchange="showCourseTitles()">
                                <option value="">-- SELECT Regulation --</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label>Course Title</label>
                        <div id="courseTitleHint">
                            <select class="form-control" id="course_title" name="course_title" required onchange="showQuestionPart()">
                                <option value="">-- SELECT Course Title --</option>
                            </select>
                        </div>
                    </div>                   

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary mt-3">Create Question</button>
                    </div>
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
        xhttp.open("GET", "view-regulation-ajax.php?q=" + programId, true);
        xhttp.send();
    }

    function showCourseTitles() {
        var programId = document.getElementById("program_id").value;
        var regulation = document.getElementById("regulation").value;
        if (programId == "" || regulation == "") {
            document.getElementById("courseTitleHint").innerHTML = "<select class='form-control' id='course_title' name='course_title' required><option value=''>-- SELECT Course Title --</option></select>";
            return;
        }
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("courseTitleHint").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "course-titles-ajax.php?program_id=" + programId + "&regulation=" + regulation, true);
        xhttp.send();
    }
</script>
<?php include("footer.php") ?>