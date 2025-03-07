<?php include("header.php") ?>
<!-- Header-->
<header class="py-5">
    <div class="container px-lg-5">
        <div class="p-4 p-lg-5 bg-light rounded-3 text-center">
            <div class="m-4 m-lg-5">
                <h1 class="display-5 fw-bold">A warm welcome!</h1>
                <p class="fs-4">This app helps to create question banks automated!!</p>
                <a class="btn btn-primary btn-lg" href="">Call to action</a>
            </div>
        </div>
    </div>
</header>
<!-- Page Content-->
<section class="pt-4">
    <div class="container px-lg-5" id="features">
        <!-- Page Features-->
        <div class="row gx-lg-5">
            <div class="col-lg-6 col-xxl-4 mb-5">
                <div class="card bg-light border-0 h-100">
                    <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                        <a href="create-questions.php">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4"><i class="bi bi-collection"></i></div>
                        </a>
                        <h2 class="fs-4 fw-bold">Fresh new Questions</h2>
                        <p class="mb-0">Create Questions for exams!!</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xxl-4 mb-5">
                <div class="card bg-light border-0 h-100">
                    <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                        <a href="new-questions.php">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4"><i class="bi bi-cloud-download"></i></div>
                        </a>
                        <h2 class="fs-4 fw-bold">Add Questions </h2>
                        <p class="mb-0">In this Page you can create question by typing!!</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xxl-4 mb-5">
                <div class="card bg-light border-0 h-100">
                    <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                        <a href="import-questions.php">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4"><i class="bi bi-card-heading"></i></div>
                        </a>
                        <h2 class="fs-4 fw-bold">Add Questions by Importing</h2>
                        <p class="mb-0">In this page you can upload questions by Excel!</p>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <div class="col-lg-6 col-xxl-4 mb-5 d-">
                    <div class="card bg-light border-0 h-100">
                        <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                            <a href="view-courses.php">
                            <div class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4"><i class="bi bi-book"></i></div>
                            </a>
                            <h2 class="fs-4 fw-bold">View Courses</h2>
                            <p class="mb-0">In this page you can view the courses offered!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("footer.php") ?>