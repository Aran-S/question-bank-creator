<?php
session_start();
if (!isset($_SESSION['admin_loggedin'])) {
    header('Location: index.php');
    exit;
}

require_once "configs/db.php";

$admin_id = $_SESSION['id'];

$sql = "SELECT * FROM users WHERE id = ?";
if ($stmt = $con->prepare($sql)) {
    $stmt->bind_param("i", $admin_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $user_name = $row['username'];
        $created_on = $row['created_on'];
        $level = $row['level'];
        $department_id = $row['department_id'];
    }

    $stmt->close();
}

date_default_timezone_set('Asia/Kolkata');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Question-Bank Creator</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/logo.gif" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <style>
        @media print {

            .navbar,
            footer,
            #live-time,
            .card.mb-3.mt-3 {
                display: none;
            }
        }

        #live-time {
            font-size: 1.2em;
            font-weight: bold;
            color: #000066;
            animation: blink 1s step-start infinite;
        }

        @keyframes blink {
            10% {
                opacity: 0;
            }
        }
    </style>
</head>

<body>
    <!-- Responsive navbar-->
    <div class="">
        <nav class="navbar navbar-expand-lg fw-bold" style="background-color: #000066;">
            <div class="container px-lg-5">
                <a class="navbar-brand text-white" href="#!">Welcome <?php echo htmlspecialchars($user_name); ?></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link active text-white" aria-current="page" href="dashboard.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link text-white" href="logout.php" onclick="return(confirm('Are you sure want logout ?'))">Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div class="container">
        <div class="col-12 d-flex justify-content-end">
            <div class="card mb-3 mt-3">
                <div class="card-body">
                    <i class="bi bi-calendar"></i>&nbsp;<span id="live-time"></span>
                </div>
            </div>
        </div>
    </div>