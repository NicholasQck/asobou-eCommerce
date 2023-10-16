<?php
session_start();

require_once('config.php');

if (isset($_SESSION['acc_id'])){
    $roleId = $_SESSION['role_id'];
    $username = $_SESSION['acc_name'];
    $accId = $_SESSION['acc_id'];
}

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$contactNum = $_POST['contactNum'];
$emergNum = $_POST['emergNum'];
$add1 = $_POST['address1'];
$add2 = $_POST['address2'];
$add = $add1 . "\n" . $add2;
$country = $_POST['country'];
$state = $_POST['state'];
$city = $_POST['city'];
$postcode = $_POST['postcode'];

//form validation
if (empty($fname)){
    echo "<script>alert('First name cannot be empty');</script>";
    echo "<script>window.open('checkout.php', '_self');</script>";
    exit;
}

if (empty($lname)){
    echo "<script>alert('Last name cannot be empty');</script>";
    echo "<script>window.open('checkout.php', '_self');</script>";
    exit;
}

$contactNumPattern1 = "/^(01[0 2-4 6-9][0-9]{7})$|^(011[0-9]{8})$/";

if (!preg_match($contactNumPattern1, $contactNum)){
    echo "<script>alert('Contact number entered is not valid');</script>";
    echo "<script>window.open('checkout.php', '_self');</script>";
    exit;
}

if (!preg_match($contactNumPattern1, $emergNum)){
    echo "<script>alert('Emergency number entered is not valid');</script>";
    echo "<script>window.open('checkout.php', '_self');</script>";
    exit;
}

if (empty($add1)){
    echo "<script>alert('Address line 1 cannot be empty');</script>";
    echo "<script>window.open('checkout.php', '_self');</script>";
    exit;
}

$locationPattern = "/^[a-z A-Z]+$/";
$postcodePattern = "/^[0-9]{5}$/";

if (!preg_match($locationPattern, $state)){
    echo "<script>alert('State entered is not valid');</script>";
    echo "<script>window.open('checkout.php', '_self');</script>";
    exit;
}

if (!preg_match($locationPattern, $city)){
    echo "<script>alert('City entered is not valid');</script>";
    echo "<script>window.open('checkout.php', '_self');</script>";
    exit;
}

if (!preg_match($postcodePattern, $postcode)){
    echo "<script>alert('Postcode entered is not valid');</script>";
    echo "<script>window.open('checkout.php', '_self');</script>";
    exit;
}

$orderId = session_id();
foreach ($_SESSION['cartMap'] as $cartItem){
    $prodId = $cartItem['prod_id'];
    $prodQty = $cartItem['qty'];
    $sql1 = "INSERT INTO ORDER_PRODUCT (order_id, prod_id, qty) VALUES (?, ?, ?)";
    $insert = $pdo->prepare($sql1);
    $insert->execute([$orderId, $prodId, $prodQty]);
}
unset($_SESSION['cartMap']);

$sql2 = "INSERT INTO ORDER_LIST (order_id, acc_id, fname, lname, contact_num, emerg_num, post_add, country, post_state, city, postcode) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$insert = $pdo->prepare($sql2);
$insert->execute([$orderId, $accId, $fname, $lname, $contactNum, $emergNum, $add, $country, $state, $city, $postcode]);
session_regenerate_id();
header("refresh:5; url=index.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success</title>
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
                        <a class="nav-link" href="support.php">Support</a>
                    </li>
                    <li class='nav-item dropdown pe-4 font-koulen'>
                        <a class='nav-link dropdown-toggle active' href='#' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                            <?php echo $username; ?>
                        </a>
                        <ul class='dropdown-menu'>
                            <li><a class='dropdown-item' href='dashboard.php'>View Profile</a></li>
                            <li><a class='dropdown-item' href='index.php?logout=true'>Logout</a></li>
                        </ul>
                    </li>
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
            <div class="row my-auto">
                <div class="col text-center">
                    <img src="resource/images/check.png" width="15%" alt="Image of a check icon">
                    <p class="fs-1 font-ps">Your order has been received</p>
                    <p class="fs-7 font-ps">Redirecting to home page... <i>if nothing happens <a href="index.php">click here</a></i></p>
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