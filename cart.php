<?php
session_start();

require_once('config.php');

if (isset($_SESSION['acc_id'])){
    $roleId = $_SESSION['role_id'];
    $username = $_SESSION['acc_name'];
    $accId = $_SESSION['acc_id'];

    if (isset($_GET['activity']) && isset($_GET['cartProd_id'])){
        $prodId = $_GET['cartProd_id'];

        switch($_GET['activity']){
            case "add":
                foreach ($_SESSION['cartMap'] as $key => $value){

                    if ($prodId == $key){
                        $_SESSION['cartMap'][$key]['qty'] += 1;
                    }
                }
                break;

            case "reduce":
                foreach ($_SESSION['cartMap'] as $key => $value){

                    if ($prodId == $key && ($_SESSION['cartMap'][$key]['qty'] > 1)){
                        $_SESSION['cartMap'][$key]['qty'] -= 1;
                    }
                }
                break;

            case "delete":
                foreach ($_SESSION['cartMap'] as $key => $value){

                    if ($prodId == $key){
                        unset($_SESSION['cartMap'][$key]);
                    }

                    if (empty($_SESSION['cartMap'])){
                        unset($_SESSION['cartMap']);
                    }
                }
                break;
        }
    }
}
else{
    echo "<script>alert('Login to use the cart function')</script>";
    echo "<script>window.open('login.php', '_self')</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
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
                        <a class='nav-link dropdown-toggle' href='#' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                            <?php echo $username; ?>
                        </a>
                        <ul class='dropdown-menu'>
                            <li><a class='dropdown-item' href='dashboard.php'>View Profile</a></li>
                            <li><a class='dropdown-item' href='index.php?logout=true'>Logout</a></li>
                        </ul>
                    </li>
                    <li class="nav-item pe-5 cart-active">
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
            <div class="row mt-5">
                <div class="col text-center">
                    <h1 class="font-ns"><b>Shopping Cart</b></h1>
                    <hr class="mb-5">
                </div>
            </div>

            <?php
            if (isset($_SESSION['cartMap'])){
                $totalPrice = 0;

                foreach ($_SESSION['cartMap'] as $cartItem){
                    $prodId = $cartItem['prod_id'];
                    $prodName = $cartItem['prod_name'];
                    $prodPrice = $cartItem['price'];
                    $displayPrice = number_format($prodPrice, 2);
                    $prodQty = $cartItem['qty'];
                    $prodImg = $cartItem['prod_img'];

                    echo"
                    <div class='row d-flex justify-content-center align-items-center h-100'>
                        <div class='col-md-10'>
                            <div class='card cart-card rounded-3 mb-5'>
                                <div class='card-body p-4'>
                                <div class='row d-flex justify-content-between align-items-center'>
                                    <div class='col-md-2 col-lg-2 col-xl-2'>
                                        <img src='$prodImg' class='img-fluid rounded-3' alt='Product Image'>
                                    </div>

                                    <div class='col-md-6 col-lg-6 col-xl-6'>
                                        <p class='h1 fw-bold mb-2'>$prodName</p>
                                        <p class='fs-3'><span class='text-muted'>Price: </span>RM $displayPrice</p>
                                    </div>

                                    <div class='col-md-3 col-lg-3 col-xl-3 d-flex justify-content-center text-center'>
                                        <a href='cart.php?activity=reduce&cartProd_id=$prodId' style='color: black;'><h2>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='30' height='30' fill='currentColor' class='bi bi-dash-circle' viewBox='0 0 16 16'>
                                                <path d='M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z'/>
                                                <path d='M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z'/>
                                            </svg>
                                        </h2></a>
                                        <h2>
                                            <span class='border border-0 mx-3' id='prodQty' style='display: inline-block; width: 100px; background-color: white;'>$prodQty</span>
                                        </h2>
                                        <a href='cart.php?activity=add&cartProd_id=$prodId' style='color: black;'><h2>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='30' height='30' fill='currentColor' class='bi bi-plus-circle' viewBox='0 0 16 16'>
                                                <path d='M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z'/>
                                                <path d='M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z'/>
                                            </svg>
                                        </h2></a>
                                    </div>

                                    <div class='col-md-1 col-lg-1 col-xl-1 text-center'>
                                    <a href='cart.php?activity=delete&cartProd_id=$prodId' class='text-danger'>
                                        <svg xmlns='http://www.w3.org/2000/svg' width='30' height='30' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                                            <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>
                                        </svg>
                                    </a>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    ";

                    $totalPrice += $prodPrice * $prodQty;
                    $displayTotal = number_format($totalPrice, 2);
                } 

                echo "
                <div class='row d-flex justify-content-center align-items-center h-100'>
                    <div class='col-md-10'>
                        <div class='mb-2'>
                            <p class='display-5'>Total: <span class='display-5 fw-bold'>RM $displayTotal</span></p>
                        </div>

                        <div class='text-center mb-5'>
                            <a href='checkout.php'><button type='button' class='btn btn-lg btn-dark font-koulen'>Checkout</button></a>
                        </div>
                    </div>
                </div>
                ";
            }
            else{
                echo "
                <div class='text-center mb-5'>
                    <p class='display-5'>There are no items in the cart</p>
                    <a href='product.php'><button type='button' class='btn btn-dark font-koulen'>Go Shopping</button></a>
                </div>
                ";
            }
            ?>
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