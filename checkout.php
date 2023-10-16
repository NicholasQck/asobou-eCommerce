<?php
session_start();

require_once('config.php');

if (isset($_SESSION['acc_id'])){
    $roleId = $_SESSION['role_id'];
    $username = $_SESSION['acc_name'];
    $accId = $_SESSION['acc_id'];
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
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
                    <h1 class="font-ns">
                        <b>Checkout</b>
                    </h1>
                </div>
            </div>
        </div>
    
        <div class="container-fluid">
            <div class="row my-3">
                <div class="col-lg-6 col-md-6 col-sm-12 px-5">
                    <div class="border border-2 border-dark rounded-3">
                        <form action="success.php" method="POST" class="mx-3">
                            <div class="mb-3 font-ps fs-1">
                                <b>Shipping Details</b>
                            </div>
    
                            <div class="d-flex flex-row mb-3">
                                <div class=" flex-fill me-2">
                                    <label for="fname" class="form-label font-ps">First Name</label>
                                    <input type="text" class="form-control" name="fname" id="fname" autocomplete="off" placeholder="(required)">
                                </div>
                                  
                                <div class="flex-fill ms-2">
                                    <label for="lname" class="form-label font-ps">Last Name</label>
                                    <input type="text" class="form-control" name="lname" id="lname" autocomplete="off" placeholder="(required)">
                                </div>
                            </div>
    
                            <div class="d-flex flex-row mb-3">
                                <div class=" flex-fill me-2">
                                    <label for="contactNum" class="form-label font-ps">Contact No.</label>
                                    <input type="text" class="form-control" name="contactNum" id="contactNum" autocomplete="off" placeholder="eg. 0124570158">
                                </div>
                                
                                <div class="flex-fill ms-2">
                                    <label for="emergNum" class="form-label font-ps">Emergency No.</label>
                                    <input type="text" class="form-control" name="emergNum" id="emergNum" autocomplete="off" placeholder="eg. 0124570158">
                                </div>
                            </div>
    
                            <div class="d-flex flex-row mb-3">
                                <div class=" flex-fill">
                                    <label for="address1" class="form-label font-ps">Address Line 1</label>
                                    <input type="text" class="form-control" name="address1" id="address1" autocomplete="off" placeholder="(required)">
                                </div>
                            </div>
    
                            <div class="d-flex flex-row mb-3">
                                <div class=" flex-fill">
                                    <label for="address2" class="form-label font-ps">Address Line 2</label>
                                    <input type="text" class="form-control" name="address2" id="address2" autocomplete="off" placeholder="(optional)">
                                </div>
                            </div>
    
                            <div class="d-flex flex-row mb-3">
                                <div class=" flex-fill me-2">
                                    <label for="country" class="form-label font-ps">Country</label>
                                    <input type="text" class="form-control" name="country" id="country" value="Malaysia" autocomplete="off" readonly>
                                </div>
                                
                                <div class="flex-fill ms-2">
                                    <label for="state" class="form-label font-ps">State</label>
                                    <input type="text" class="form-control" name="state" id="state" autocomplete="off" placeholder="(required)">
                                </div>
                            </div>
    
                            <div class="d-flex flex-row mb-3">
                                <div class=" flex-fill me-2">
                                    <label for="city" class="form-label font-ps">City</label>
                                    <input type="text" class="form-control" name="city" id="city" autocomplete="off" placeholder="(required)">
                                </div>
                                
                                <div class="flex-fill ms-2">
                                    <label for="postcode" class="form-label font-ps">Postal Code</label>
                                    <input type="text" class="form-control" name="postcode" id="postcode" autocomplete="off" placeholder="(required)">
                                </div>
                            </div>
    
                            <div class="d-flex flex-row justify-content-center my-4">
                                <div>
                                    <button type="submit" class="btn btn-lg font-koulen fs-4" style="background-color: #14B01A; color: white; padding: 5px 30px;">Confirm</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
    
                <div class="col-lg-6 col-md-6 col-sm-12 px-5">

                    <div class="mb-1 ms-4 font-ps fs-1">
                        <b>Summary</b>
                    </div>

                    <div class="rounded-3 h-50 p-2" style="background-color: #D9D9D9; overflow: auto;">
                        <div class="mx-5">

                            <?php 
                            if (isset($_SESSION['cartMap'])){
                                $totalPrice = 0;

                                foreach ($_SESSION['cartMap'] as $cartItem){
                                    $prodId = $cartItem['prod_id'];
                                    $prodName = $cartItem['prod_name'];
                                    $prodPrice = $cartItem['price'];
                                    $prodQty = $cartItem['qty'];
                                    $prodImg = $cartItem['prod_img'];
                                    $subTotal = $prodQty * $prodPrice;
                                    $displaySubTotal = number_format($subTotal, 2);

                                    echo"
                                    <div class='card cart-card rounded-3 my-3' style='background-color: white;'>
                                        <div class='card-body p-3'>
                                            <div class='row d-flex justify-content-between align-items-center'>
                                                <div class='col-md-3 col-lg-3 col-xl-3'>
                                                    <img src='$prodImg' class='img-fluid rounded-3' alt='Product Image'>
                                                </div>

                                                <div class='col-md-6 col-lg-6 col-xl-6'>
                                                    <p class='fs-5 fw-bold mb-2 d-inline-block text-truncate mw-100'>$prodName</p>
                                                    <p class='fs-6'><span class='text-muted'>Qty: </span>$prodQty</p>
                                                </div>

                                                <div class='col-md-3 col-lg-3 col-xl-3'>
                                                    <p class='fs-6'>RM $displaySubTotal</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    ";

                                    $totalPrice += $prodPrice * $prodQty;
                                    $displayTotal = number_format($totalPrice, 2);
                                }
                            }
                            ?>

                        </div>
                    </div>

                    
                    <div class='mb-2 me-5 text-end'>
                        <p class='fs-3'>Total: <span class='fs-3 fw-bold'>RM <?php echo $displayTotal ?></span></p>
                    </div>
                    
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