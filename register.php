<?php
session_start();

require_once('config.php');

if (isset($_POST['register'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];
    $confirm = $_POST['confirmation'];

    //get existing accounts
    $sqlOld = $pdo->query("SELECT * FROM ACCOUNT");

    //form validation
    while ($row = $sqlOld->fetch()){
        $getUsername = $row['acc_name'];
        $getEmail = $row['acc_email'];

        if ($username == $getUsername || $email == $getEmail){
            echo "<script>alert('Username or email has already been taken');</script>";
            echo "<script>window.open('register.php', '_self');</script>";
            exit;
        }
    }

    $pwdPattern = "/^[\S]{8,16}$/";

    if (empty($username)){
        echo "<script>alert('Username cannot be empty');</script>";
        echo "<script>window.open('register.php', '_self');</script>";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo "<script>alert('Invalid email');</script>";
        echo "<script>window.open('register.php', '_self');</script>";
        exit;
    }

    if (!preg_match($pwdPattern, $pwd)){
        echo "<script>alert('Password must be 8-16 characters long');</script>";
        echo "<script>window.open('register.php', '_self');</script>";
        exit;
        
    }

    if ($pwd != $confirm){
        echo "<script>alert('Password does not match');</script>";
        echo "<script>window.open('register.php', '_self');</script>";
        exit;
    }

    $sqlNew = "INSERT INTO ACCOUNT (role_id, acc_name, acc_email, acc_password) VALUES (2, ?, ?, ?)";
    $insert = $pdo->prepare($sqlNew);
    $insert->execute([$username, $email, $pwd]);
    echo "<script>alert('Account registered successfully');</script>";
    echo "<script>window.open('login.php', '_self');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="apple-touch-icon" sizes="180x180" href="resource/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="resource/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="resource/favicon/favicon-16x16.png">
    <link rel="manifest" href="resource/favicon/site.webmanifest">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/styles.css" type="text/css">
</head>
<body class="d-flex flex-column min-vh-100">
    <main class="my-5 mb-auto">
        <div class="container">
            <form class="m-auto" style="max-width: 600px;" method="POST">
                <div class="container">
                    <img src="resource/images/Trademark Logo.svg" alt="trademark logo" class="logo mx-auto" style="width: 50%; display: block;">
                </div>
                <h2 class="text-center fs-1 fw-bold py-3">Let's create your user account!</h2>
                
                <div class="pb-3 fw-bold">
                    <label for="username">Username</label><br>
                    <input type="text" name="username" class="form-control" id="username" placeholder="eg. John Wick" autocomplete="off">
                </div>

                <div class="pb-3 fw-bold">
                    <label for="email">Email</label><br>
                    <input type="text" name="email" class="form-control" id="emailReg" placeholder="eg. johnwick123@gmail.com" autocomplete="off">
                </div>

                <div class="pb-3 fw-bold">
                    <label for="pwd">Password</label><br>
                    <input type="text" name="pwd" class="form-control" id="pwd" placeholder="Password should contain 8-16 characters" autocomplete="off" title="Password must be 8-16 characters long">
                </div>

                <div class="pb-3 fw-bold">
                    <label for="cpwd">Confirm Password</label><br>
                    <input type="text" name="confirmation" class="form-control" id="cpwd" placeholder="Re-enter password" autocomplete="off">
                </div>
                
                <input type="submit" class="btn w-100 mt-2 fs-4 font-koulen" style="background-color: #81E471; color: white;" name="register" value="CREATE">
                <p style="font-size: 10px;">By creating an account, you agree to the Terms of Service.</p>
            </form>
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
