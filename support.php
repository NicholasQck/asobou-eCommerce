<?php
session_start();

require_once('config.php');

if (isset($_SESSION['acc_id'])){
    $roleId = $_SESSION['role_id'];
    $username = $_SESSION['acc_name'];
    $accId = $_SESSION['acc_id'];
}

if (isset($_POST['submit_feedback'])){
    $feedbackName = $_POST['feedbackName'];
    $feedbackEmail = $_POST['feedbackEmail'];
    $feedback = $_POST['feedback'];

    //form validation
    if (empty($feedbackName)){
        echo "<script>alert('Please enter your name to provide feedback');</script>";
        echo "<script>window.open('support.php', '_self');</script>";
        exit;
    }

    if (!filter_var($feedbackEmail, FILTER_VALIDATE_EMAIL)){
        echo "<script>alert('Please enter a valid email to provide feedback');</script>";
        echo "<script>window.open('support.php', '_self');</script>";
        exit;
    }

    if (empty($feedback)){
        echo "<script>alert('No feedback provided');</script>";
        echo "<script>window.open('support.php', '_self');</script>";
        exit;
    }

    $feedbackSql = "INSERT INTO SUPPORT (provider_name, email, feedback) VALUES (?, ?, ?)";
    $feedbackQuery = $pdo->prepare($feedbackSql);
    $feedbackQuery->execute([$feedbackName, $feedbackEmail, $feedback]);

    echo "<script>alert('Your feedback is much appreciated');</script>";
    echo "<script>window.open('index.php', '_self');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support</title>
    <link rel="apple-touch-icon" sizes="180x180" href="resource/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="resource/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="resource/favicon/favicon-16x16.png">
    <link rel="manifest" href="resource/favicon/site.webmanifest">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/styles.css" type="text/css">
</head>
<body class="d-flex flex-column min-vh-100">
    <header>
        <nav class="navbar navbar-expand-md navbar-dark" style="background-color: black;">
            <div class="container-fluid">
              <a class="navbar-brand font-jso ps-5" href="index.php">
                <img src="resource/images/Logo.svg" width="50" height="50" class="d-inline-block align-center" alt="Logo">
                Asobou
              </a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item pe-4 font-koulen">
                        <a class="nav-link" href="product.php">Products</a>
                    </li>
                    <li class="nav-item pe-4 font-koulen">
                        <a class="nav-link active" href="support.php">Support</a>
                    </li>
                    <?php
                    if (isset($roleId)){
                        echo "
                        <li class='nav-item dropdown pe-4 font-koulen'>
                            <a class='nav-link dropdown-toggle' href='#' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                            $username
                            </a>
                            <ul class='dropdown-menu'>
                                <li><a class='dropdown-item' href='dashboard.php'>View Profile</a></li>
                                <li><a class='dropdown-item' href='index.php?logout=true'>Logout</a></li>
                            </ul>
                        </li>
                        ";
                    }
                    else{
                        echo "
                        <li class='nav-item pe-4 font-koulen'>
                            <a class='nav-link' href='login.php'>Login</a>
                        </li>
                        ";
                    }
                    ?>
                    <li class="nav-item pe-5 cart">
                        <a class="nav-link" href="cart.php" >
                            <img src="resource/images/cart.svg" class="d-inline-block align-center" width="25" alt="Cart">
                        </a>
                    </li>
                </ul>
              </div>
            </div>
          </nav>
    </header>

    <main class="my-5 mb-auto">
        <div class="container">
            <div class="row mb-5">
                <h1 class="font-ns text-center"><b>Asobou Support</b></h1>
                <hr class="mb-3">
            </div>

            <div class="row text-center mx-auto font-ps">
                <p class="fs-1">Your feedback matters to us</p>
                <p class="fs-4 text-muted">We hope to understand the issues you are facing and hear your ideas on how we can make Asobou a better experience for you</p>
            </div>

            <div class="row mb-5 d-flex justify-alignment-center">
                <div class="col my-3">
                    <form method="POST">
                        <div class="mb-3 w-50 mx-auto font-ps">
                            <label for="feedbackName" class="form-label fw-bold fs-4">Name</label>
                            <input type="text" class="form-control" name="feedbackName" id="feedbackName" placeholder="eg. Ashley Granger">
                        </div>

                        <div class="mb-3 w-50 mx-auto font-ps">
                            <label for="feedbackEmail" class="form-label fw-bold fs-4">Email</label>
                            <input type="text" class="form-control" name="feedbackEmail" id="feedbackEmail" placeholder="eg. ashley@gmail.com">
                        </div>

                        <div class="mb-3 w-50 mx-auto font-ps">
                            <label for="feedback" class="form-label fw-bold fs-4">Feedback</label>
                            <textarea type="text" class="form-control" name="feedback" id="feedback" placeholder="Feedback or suggestions"></textarea>
                        </div>

                        <div class="text-center">
                            <input type="submit" name="submit_feedback" value="Submit Feedback" class="btn btn-lg btn-dark font-koulen">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <footer class="footer mt-auto py-3" style="background-color: black;">
        <div class="container">
          <span class="text-muted"><img src="resource/images/Logo.svg" width="40" height="40" class="d-inline-block align-center" alt="Logo"> © 2022 Asobou, Inc</span>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

</body>
</html>