<?php include("header.php") ?>
<div class="mb-5 mt-5">
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center">Add New Questions</h3>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="program_id" class="form-label">Program</label>
                        <select class="form-select" id="program_id" name="program_id" onchange="showRegulation(this.value)">
                            <option selected>Select program</option>
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
                    <br>
                    <div class="form-group">
                        <label>Regulation</label>
                        <div id="regulationHint"></div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label>Course Title</label>
                        <div id="courseTitleHint"></div>
                    </div>
                    <br>
                    <div class="mb-3">
                        <label for="part" class="form-label">Select Part</label>
                        <select class="form-control" name="part" id="part">
                            <option selected>[--Select Part--]</option>
                            <option value="1">Part 1</option>
                            <option value="2">Part 2</option>
                            <option value="3">Part 3</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="part" class="form-label">Part</label>
                        <textarea class="form-control" id="part" name="part" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function showRegulation(programId) {
        if (programId == "") {
            document.getElementById("regulationHint").innerHTML = "";
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
            document.getElementById("courseTitleHint").innerHTML = "";
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