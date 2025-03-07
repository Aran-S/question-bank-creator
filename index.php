<?php
session_start();
if (isset($_SESSION["admin_loggedin"]) && $_SESSION["admin_loggedin"] === true) {
    header("location: dashboard.php");
    exit;
}

require_once "configs/db.php";

$username_err = $password_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);


    $sql = "SELECT id, username, password FROM users WHERE username = ?";
    if ($stmt = $con->prepare($sql)) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            if (password_verify($password, $row["password"])) {
                $_SESSION["admin_loggedin"] = true;
                $_SESSION["id"] = $row["id"];
                $_SESSION["admin_username"] = $row["username"];
                header("location: dashboard.php");
                exit;
            } elseif(!password_verify($password, $row["password"])) {
                $password_err = " password.";
            }elseif(!password_verify($username, $row["username"])){
                $username_err = " username.";
            }
        } else {
            $username_err = "Invalid username or password.";
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Question Creator</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/components/logins/login-3/assets/css/login-3.css">
    <style>
        body {
            background-color: blue;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            max-width: 800px;
        }

        .image-container {
            height: 100%;
        }

        .image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 0;
        }
    </style>
</head>

<body>
    <section class="p-3 p-md-4 p-xl-5">
        <div class="container">
            <div class="row">
                <!-- Left side (Image) -->
                <div class="col-12 col-md-6 p-0">
                    <div class="image-container">
                        <img class="img-fluid" loading="lazy" src="assets/front.jpg" alt="Login Image">
                    </div>
                </div>

                <!-- Right side (Login form) -->
                <div class="col-12 col-md-6 bg-light">
                    <div class="p-3 p-md-4 p-xl-5">
                        <h3 class="mb-4">Log in to get Question Paper</h3>
                        <form action="" method="post" autocomplete="off">
                            <?php if (!empty($username_err) || !empty($password_err) || !empty($username_err)) : ?>
                                <div class="alert alert-danger"><?php echo $username_err . $password_err . $username_err ; ?></div>
                            <?php endif; ?>

                            <div class="mb-3">
                                <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="username" id="username" placeholder="Enter Username" required>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" required>
                            </div>

                            <div class="d-grid">
                                <button class="btn btn-success" type="submit">Log in now</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

</html>