<?php
session_start();

require_once('config.php');

if (isset($_POST['login'])){
    //input credentials
    $inputEmail = $_POST['email'];
    $inputPwd = $_POST['password'];

    //check if email field is empty
    if (empty($inputEmail)){
        echo "<script>alert('Email address cannot be empty')</script>";
        echo "<script>window.open('login.php', '_self')</script>";
        exit;
    }

    //check if password field is empty
    if (empty($inputPwd)){
        echo "<script>alert('Password cannot be empty')</script>";
        echo "<script>window.open('login.php', '_self')</script>";
        exit;
    }

    //retrieve existing account credentials
    $sql = "SELECT * FROM ACCOUNT";
    $accounts = $pdo->query($sql);

    while ($account = $accounts->fetch()){
        $getEmail = $account['acc_email'];
        $getPwd = $account['acc_password'];

        //correct email but incorrect password
        if ($inputEmail == $getEmail && $inputPwd != $getPwd){
            echo "<script>alert('Password entered is wrong. Try again.')</script>";
            echo "<script>window.open('login.php', '_self')</script>";
            exit;
        }

        //both email and password are correct
        if ($inputEmail == $getEmail && $inputPwd == $getPwd){
            unset($account['acc_password']);
            $_SESSION = $account;
            $username = $_SESSION['acc_name'];
            echo "<script>alert('Welcome back $username.')</script>";
            echo "<script>window.open('index.php', '_self')</script>";
            exit;
        }
    }

    //email not registered
    echo "<script>alert('Email address not recognized. Try again.')</script>";
    echo "<script>window.open('login.php', '_self')</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="apple-touch-icon" sizes="180x180" href="resource/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="resource/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="resource/favicon/favicon-16x16.png">
    <link rel="manifest" href="resource/favicon/site.webmanifest">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/styles.css" type="text/css">
</head>
<body class="d-flex flex-column min-vh-100">
    <header>
        <div class="container-fluid">
            <div class="row my-4">
                <div class="col">
                    <a href="index.php"><img src="resource/images/Trademark Logo.svg" class="img-fluid mx-3 h-50" alt=""></a>
                </div>
            </div>
        </div>
    </header>

    <main class="my-5 mb-auto">
        <div class="container px-5">
            <div class="row">
                <div class="col-lg-7">
                    <img src="resource/images/Catchphrase.svg" class="img-fluid mt-5" alt="">
                </div>

                <div class="col-lg-5 mb-5 px-4 border rounded-4 login">
                    <form method="POST">
                        <div class="mb-3 mt-5 font-ns fs-1">
                            <b>LOGIN</b>
                        </div>

                        <div class="mb-3">
                          <label for="email" class="form-label font-koulen">Email</label>
                          <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email address" autocomplete="off">
                        </div>

                        <div class="mb-3">
                          <label for="password" class="form-label font-koulen">Password</label>
                          <input type="password" class="form-control" name="password" id="password" placeholder="Enter account password" autocomplete="off">
                          <p>Don't have an account? <a href="register.php">Sign up</a></p>
                        </div>
                        
                        <div class="float-end mb-5">
                            <button type="submit" class="float-right btn btn-lg font-koulen" name="login" style="border-radius: 100px; background-color: #5AD5FC; color: white; width: 150px;">Let's go</button>
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