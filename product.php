<?php
session_start();

require_once('config.php');

if (isset($_SESSION['acc_id'])){
    $roleId = $_SESSION['role_id'];
    $username = $_SESSION['acc_name'];
    $accId = $_SESSION['acc_id'];

    if (isset($_GET['activity'])){
        if (!empty($_POST['cartProd_qty'])){
            $sql = "SELECT * FROM PRODUCT WHERE prod_id = ?";
            $query = $pdo->prepare($sql);
            $query->execute([$_POST['cartProd_id']]);
            $itemToAdd = $query->fetch();

            $itemMap = array(
                    'prod_id' => $itemToAdd['prod_id'], 
                    'prod_name' => $itemToAdd['prod_name'], 
                    'price' => $itemToAdd['price'], 
                    'qty' => $_POST['cartProd_qty'], 
                    'prod_img' => $itemToAdd['prod_img']);

            if (!empty($_SESSION['cartMap'])){

                if(in_array($itemToAdd['prod_id'], array_keys($_SESSION['cartMap']))){

                    foreach ($_SESSION['cartMap'] as $key => $value){

                        if ($itemToAdd['prod_id'] == $key){
                            $_SESSION['cartMap'][$key]['qty'] += $_POST['cartProd_qty'];
                        }
                    }
                }
                else{
                    $_SESSION['cartMap'][$itemToAdd['prod_id']] =  $itemMap;
                }
            }
            else{
                $_SESSION['cartMap'][$itemToAdd['prod_id']] = $itemMap;
                // print_r(array_keys($_SESSION['cartMap']));
                // print_r($_SESSION['cartMap']);
            }
            echo "<script>alert('Item has been added to the cart');</script>";
        }
    }
}
else{
    if (isset($_GET['activity'])){
        echo "<script>alert('Login to use the cart function')</script>";
        echo "<script>window.open('login.php', '_self')</script>";
        exit;

    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
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
                        <a class="nav-link active" href="product.php">Products</a>
                    </li>
                    <li class="nav-item pe-4 font-koulen">
                        <a class="nav-link" href="support.php">Support</a>
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
        <?php
        if (!isset($_GET['prod_id'])){
        ?>
        <div class="container">
            <div class="row mt-5">
                <div class="col text-center">
                    <h1 class="font-ns"><b>Products</b></h1>
                </div>
            </div>

            <div class="row mt-5">
                <!-- img size: 1280:720-->
                <?php
                if (!isset($_GET['model'])){
                    $sql = $pdo->query("SELECT * FROM MODEL");

                    while ($row = $sql->fetch()){
                        $modelId = $row['model_id'];
                        $modelImage = $row['model_img'];
                        $modelDesc = $row['model_desc'];
    
                        echo "
                        <div class='col-lg-4 col-md-6 col-sm-12 text-center my-3'>
                        <div class='card product-card border-dark' style='height: 30rem; overflow: auto;'>
                            <div style='height: 165px;'>
                                <img src='$modelImage' class='card-img-top' alt='Product Model Image'>
                            </div>
                            <div class='card-body'>
                            <p class='card-text font-ps mt-5 fs-4'>$modelDesc</p>
                            <a href='product.php?model=$modelId' class='stretched-link'></a>
                            </div>
                        </div>
                        </div>";
                    }
                }

                if (isset($_GET['model'])){
                    $model = $_GET['model'];
                    $sql = "SELECT * FROM PRODUCT WHERE model_id = ?";
                    $query = $pdo->prepare($sql);
                    $query->execute([$model]);
                    $products = $query->fetchAll();

                    foreach ($products as $product){
                        $prodId = $product['prod_id'];
                        $prodName = $product['prod_name'];
                        $prodPrice = $product['price'];
                        $displayPrice = number_format($prodPrice, 2);
                        $prodCond = $product['prod_condition'];
                        $prodReg = $product['region'];
                        $prodImg = $product['prod_img'];
    
                        echo "
                        <div class='col-xl-3 col-lg-4 col-md-6 my-3'>
                        <div class='card product-card rounded-0' style='width: 18rem;'>
                            <img src='$prodImg' class='card-img-top' alt='Product Image'>
                            <div class='card-body'>
                                <h5 class='card-title d-inline-block text-truncate mw-100' >$prodName</h5>
                                <p class='card-text font-ps'>
                                <span class='text-muted'>Price: </span>RM $displayPrice 
                                <br> 
                                <span class='text-muted'>Condition: </span>$prodCond 
                                <br> 
                                <span class='text-muted'>Region: </span>$prodReg
                                </p>
                                <a href='product.php?prod_id=$prodId' class='btn btn-sm font-koulen' style='background-color: black; color: white;'>See More</a>
                                <form action='product.php?model=$model&activity=add' method='POST' class='d-inline-block'>
                                    <input type='hidden' name='cartProd_id' id='hiddenId' value='$prodId'>
                                    <input type='hidden' name='cartProd_qty' id='hiddenQty' value='1'>
                                    <button type='submit' class='btn btn-sm font-koulen' style='background-color: #5AD5FC; color: white;'>Add to Cart</button>
                                </form>
                            </div>
                        </div>
                        </div>";
                    }
                }
                ?>
            </div>
        </div>
        <?php
        }
        ?>

        <?php
        if (isset($_GET['prod_id'])){
            $prodId = $_GET['prod_id'];
            $sql = "SELECT * FROM PRODUCT WHERE prod_id = ?";
            $query = $pdo->prepare($sql);
            $query->execute([$prodId]);
            $result = $query->fetch();

            $prodName = $result['prod_name'];
            $prodDesc = $result['prod_desc'];
            $prodPrice = $result['price'];
            $displayPrice = number_format($prodPrice, 2);
            $prodCond = $result['prod_condition'];
            $prodReg = $result['region'];
            $prodImg = $result['prod_img'];

        echo"
            <div class='container'>
                <div class='row'>
                    <div class='col text-center'>
                    <img src='$prodImg' class='img-fluid' width='350px' alt='Product Image'>
                    </div>
                </div>
            </div>

            <div class='container-fluid' style='background-color: #D9D9D9; color: black'>
                <div class='row text-center'>
                    <h1>$prodName</h1>
                    <p class='font-ps'>
                    $prodDesc
                    <br>
                    <br>
                    <b>Price:</b> RM $displayPrice
                    <br>
                    <b>Condition:</b> $prodCond
                    <br>
                    <b>Region:</b> $prodReg
                    </p>
                </div>

                <div class='row text-center'>
                    <div class='col-lg-12 col-md-12 col-sm-12'>
                        <h2>
                            <svg xmlns='http://www.w3.org/2000/svg' onclick='decQty()' width='30' height='30' fill='currentColor' class='bi bi-dash-circle' viewBox='0 0 16 16'>
                                <path d='M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z'/>
                                <path d='M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z'/>
                            </svg>
                            <span class='border border-0 mx-3' id='prodQty' style='display: inline-block; width: 100px; background-color: white;'>1</span>
                            <svg xmlns='http://www.w3.org/2000/svg' onclick='incQty()' width='30' height='30' fill='currentColor' class='bi bi-plus-circle' viewBox='0 0 16 16'>
                                <path d='M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z'/>
                                <path d='M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z'/>
                            </svg>
                        </h2>
                    </div>
                </div>
            </div>

            <div class='container'>
                <div class='row text-center my-4'>
                    <div class='col-lg-12 col-md-12 col-sm-12'>
                        <form action='product.php?prod_id=$prodId&activity=add'method='POST'>
                            <input type='hidden' name='cartProd_id' id='hiddenId' value='$prodId'>
                            <input type='hidden' name='cartProd_qty' id='hiddenQty' value='1'>
                            <button type='submit' class='btn btn-dark rounded-pill font-koulen' style='width: 200px;'>Add to Cart</button>
                        </form>
                    </div>
                </div>
            </div>
        ";
        }
        ?>

    </main>

    <footer class="footer mt-auto py-3" style="background-color: black;">
        <div class="container">
          <span class="text-muted"><img src="resource/images/Logo.svg" width="40" height="40" class="d-inline-block align-center" alt="Logo"> © 2022 Asobou, Inc</span>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script>
        var qty = document.getElementById('prodQty').innerText;

        function incQty(){
            if (qty < 10){
                document.getElementById('prodQty').innerText = ++qty;
                //qty = document.getElementById('prodQty').innerText;
                document.querySelector('#hiddenQty').value = qty;
            }
        }

        function decQty(){
            if (qty > 1){
                document.getElementById('prodQty').innerText = --qty;
                //qty = document.getElementById('prodQty').innerText;
                document.querySelector('#hiddenQty').value = qty;
            }
        }
    </script>

</body>
</html>
