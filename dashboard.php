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
    <title>
        <?php
        echo "$username | Asobou";
        ?>
    </title>
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
            <div class="row mt-5">
                <div class="col text-center">
                    <h1 class="font-ns display-3">
                        <b><?php echo"$username"; ?></b>
                    </h1>
                </div>
            </div>

            <div class="row mt-5">
                <div class="mb-5">
                    <?php
                    if ($roleId == 1){
                        echo "<img src='resource/images/admin_profile_pic.png' alt='User Profile pic' class='rounded-circle mx-auto d-block border border-3' width='300px'>";
                    }

                    if ($roleId == 2){
                        echo "<img src='resource/images/user_profile_pic.png' alt='User Profile pic' class='rounded-circle mx-auto d-block border border-3' width='300px'>";
                    }
                    ?>
                </div>
            </div>

            <?php 
            if ($roleId == 1){
                echo "
                <div class='row'>
                    <div class='d-flex justify-content-start'>
                    <a href='dashboard.php?product_detail' class='btn btn-sm font-koulen me-3' style='background-color: black; color: white;'>Manage Product</a>
                    <a href='dashboard.php?user_detail' class='btn btn-sm font-koulen me-3' style='background-color: black; color: white;'>Manage Users</a>
                    <a href='dashboard.php?feedback_list' class='btn btn-sm font-koulen me-3' style='background-color: black; color: white;'>View Feedback</a>
                    <a href='dashboard.php?order_history' class='btn btn-sm font-koulen me-3' style='background-color: black; color: white;'>Order History</a>
                    </div>
                </div>
                ";
            }
            else{
                echo "
                <div class='row'>
                    <div class='d-flex justify-content-start'>
                    <a href='dashboard.php?order_history' class='btn btn-sm font-koulen me-3' style='background-color: black; color: white;'>Order History</a>
                    </div>
                </div>
                ";
            }
            ?>
        </div>

        <div class="container-fluid mt-5">
            <div class="row d-flex justify-content-center align-items-center pt-3" style="background-color: #D9D9D9; color: black;">
                <div class="col-md-10">
                    <?php
                    if ($roleId == 1 && (!isset($_GET['order_history']) && !isset($_GET['product_detail']) && !isset($_GET['feedback_list']) && !isset($_GET['user_detail']))){
                        echo "
                        <div class='text-center mt-3'>
                            <img src='resource/images/admin.png' width='10%' alt='Admin Icon'>
                            <br><br>
                            <p class='fs-1 font-ps'>Welcome to the admin dashboard</p>
                        </div>
                        ";
                    }

                    if ($roleId != 1 && (!isset($_GET['order_history']) && !isset($_GET['product_detail']) && !isset($_GET['feedback_list']) && !isset($_GET['user_detail']))){
                        echo "
                        <div class='text-center mt-3'>
                            <img src='resource/images/user.png' width='10%' alt='Admin Icon'>
                            <br><br>
                            <p class='fs-1 font-ps'>Welcome to the user dashboard</p>
                        </div>
                        ";
                    }

                    if (isset($_GET['order_history'])){
                        echo"
                        <div class='row'>
                            <h1 class='font-ps'>Order History</h1>
                        </div>
                        ";

                        $getOrderSql = "SELECT order_id FROM ORDER_LIST WHERE acc_id = ?";
                        $getOrderQuery = $pdo->prepare($getOrderSql);
                        $getOrderQuery->execute([$accId]);
                        $orders = $getOrderQuery->fetchAll();

                        if ($getOrderQuery->rowCount() < 1){
                            echo "
                            <div class='text-center mt-3'>
                                <img src='resource/images/leaf.png' width='5%' alt='No Order Image'>
                                <br><br>
                                <p class='fs-3 font-ps'>No orders yet</p>
                            </div>
                            ";
                        }
                        else{
                            foreach ($orders as $order){
                                $getProdSql = "SELECT * FROM ORDER_PRODUCT WHERE order_id = ?";
                                $getProdQuery = $pdo->prepare($getProdSql);
                                $getProdQuery->execute([$order['order_id']]);
                                $orderedItems = $getProdQuery->fetchAll();

                                foreach ($orderedItems as $orderedItem){
                                    $prodSql = "SELECT * FROM PRODUCT WHERE prod_id = ?";
                                    $prodQuery = $pdo->prepare($prodSql);
                                    $prodQuery->execute([$orderedItem['prod_id']]);
                                    $product = $prodQuery->fetch();

                                    $prodName = $product['prod_name'];
                                    $prodImg = $product['prod_img'];
                                    $prodQty = $orderedItem['qty'];
                                    $prodPrice = $product['price'];
                                    $formattedPrice = number_format($prodPrice, 2);
                                    $subtotal = $prodQty * $prodPrice;
                                    $formattedSubtotal = number_format($subtotal, 2);

                                    echo "
                                    <div class='card mb-4'>
                                        <div class='card-body px-4 py-1'>
                            
                                        <div class='row align-items-center'>
                                            <div class='col-md-2'>
                                            <img src='$prodImg'
                                                class='img-fluid' alt='Product image'>
                                            </div>
                                            <div class='col-md-4 d-flex justify-content-start'>
                                            <div>
                                                <p class='small text-muted mb-4 pb-2'>Name</p>
                                                <p class='lead fw-normal mb-0 font-ps'>$prodName</p>
                                            </div>
                                            </div>
                                            <div class='col-md-2 d-flex justify-content-center'>
                                            <div>
                                                <p class='small text-muted mb-4 pb-2'>Quantity</p>
                                                <p class='lead fw-normal mb-0 font-ps'>$prodQty</p>
                                            </div>
                                            </div>
                                            <div class='col-md-2 d-flex justify-content-center'>
                                            <div>
                                                <p class='small text-muted mb-4 pb-2'>Price / unit</p>
                                                <p class='lead fw-normal mb-0 font-ps'>RM $formattedPrice</p>
                                            </div>
                                            </div>
                                            <div class='col-md-2 d-flex justify-content-center'>
                                            <div>
                                                <p class='small text-muted mb-4 pb-2'>Total</p>
                                                <p class='lead fw-normal mb-0 font-ps'>RM $formattedSubtotal</p>
                                            </div>
                                            </div>
                                        </div>
                            
                                        </div>
                                    </div>
                                    ";

                                }
                            }
                        }
                    }

                    if (isset($_GET['product_detail'])){
                        echo"
                        <div class='row'>
                            <h1 class='font-ps'>Product Details</h1>
                        </div>

                        <div class='table-responsive'>
                            <table class='table table-light table-hover font-ps text-center'>
                                <thead>
                                    <tr>
                                        <th scope='col'>Product ID</th>
                                        <th scope='col' style='width: 10%;'>Image</th>
                                        <th scope='col'>Name</th>
                                        <th scope='col'>Model ID</th>
                                        <th scope='col'>Condition</th>
                                        <th scope='col'>Region</th>
                                        <th scope='col'>Price</th>
                                        <th scope='col'></th>
                                        <th scope='col'></th>
                                    </tr>
                                </thead>
                                <tbody>


                        ";

                        $allProductSql = "SELECT * FROM PRODUCT";
                        $allProductQuery = $pdo->query($allProductSql);

                        foreach ($allProductQuery as $product){
                            $prodId = $product['prod_id'];
                            $prodImg = $product['prod_img'];
                            $prodName = $product['prod_name'];
                            $modelId = $product['model_id'];
                            $condition = $product['prod_condition'];
                            $region = $product['region'];
                            $prodPrice = $product['price'];
                            $formattedPrice = number_format($prodPrice, 2);

                            echo "    
                            <tr>
                                <th scope='row'>$prodId</th>
                                <td><img src='$prodImg'alt='Product Image' class='img-fluid'></td>
                                <td>$prodName</td>
                                <td>$modelId</td>
                                <td>$condition</td>
                                <td>$region</td>
                                <td>RM $formattedPrice</td>
                                <td><a href='editProduct.php?edit_id=$prodId' class='btn btn-sm font-koulen' style='background-color: #5AD5FC; color: white;'>Edit</a></td>
                                <td><a href='deleteProduct.php?delete_id=$prodId' class='btn btn-sm font-koulen' style='background-color: #fc655a; color: white;'>Delete</a></td>
                            </tr>
                            ";
                        }

                        echo "
                                </tbody>
                            </table>
                        </div>
                        ";
                    }
                    
                    if (isset($_GET['feedback_list'])){
                        echo"
                        <div class='row'>
                            <h1 class='font-ps'>User Feedback</h1>
                        </div>
                        
                        <div class='table-responsive'>
                            <table class='table table-light table-hover font-ps text-center'>
                                <thead>
                                    <tr>
                                        <th scope='col'>Support ID</th>
                                        <th scope='col'>Feedback Provider</th>
                                        <th scope='col'>Email</th>
                                        <th scope='col'>Feedback</th>
                                    </tr>
                                </thead>
                                <tbody>


                        ";

                        $allFeedbackSql = "SELECT * FROM SUPPORT";
                        $allFeedbackQuery = $pdo->query($allFeedbackSql);

                        foreach ($allFeedbackQuery as $feedback){
                            $feedbackId = $feedback['support_id'];
                            $feedbackName = $feedback['provider_name'];
                            $feedbackEmail = $feedback['email'];
                            $feedback = $feedback['feedback'];

                            echo "    
                            <tr>
                                <th scope='row'>$feedbackId</th>
                                <td>$feedbackName</td>
                                <td>$feedbackEmail</td>
                                <td>$feedback</td>
                            </tr>
                            ";
                        }

                        echo "
                                </tbody>
                            </table>
                        </div>
                        ";
                    }

                    if (isset($_GET['user_detail'])){
                        echo"
                        <div class='row'>
                            <h1 class='font-ps'>User Details</h1>
                        </div>
                        
                        <div class='table-responsive'>
                            <table class='table table-light table-hover font-ps text-center'>
                                <thead>
                                    <tr>
                                        <th scope='col'>Account ID</th>
                                        <th scope='col'>Role ID</th>
                                        <th scope='col'>Username</th>
                                        <th scope='col'>Email</th>
                                        <th scope='col'></th>
                                        <th scope='col'></th>
                                    </tr>
                                </thead>
                                <tbody>


                        ";

                        $allAccountSql = "SELECT * FROM ACCOUNT";
                        $allAccountQuery = $pdo->query($allAccountSql);

                        foreach ($allAccountQuery as $account){
                            $accountId = $account['acc_id'];
                            $accountRole = $account['role_id'];
                            $accountName = $account['acc_name'];
                            $accountEmail = $account['acc_email'];

                            echo "    
                            <tr>
                                <th scope='row'>$accountId</th>
                                <td>$accountRole</td>
                                <td>$accountName</td>
                                <td>$accountEmail</td>
                                <td><a href='editUser.php?edit_id=$accountId' class='btn btn-sm font-koulen' style='background-color: #5AD5FC; color: white;'>Edit</a></td>
                                ";
                                if ($accountRole == 1){
                                    echo "<td></td>";
                                }
                                else{
                                echo "<td><a href='deleteUser.php?delete_id=$accountId' class='btn btn-sm font-koulen' style='background-color: #fc655a; color: white;'>Delete</a></td>";
                                }
                            echo "
                            </tr>
                            ";
                        }

                        echo "
                                </tbody>
                            </table>
                        </div>
                        ";
                    }
                    ?>

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
