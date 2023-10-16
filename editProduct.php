<?php
session_start();

require_once('config.php');

if (isset($_SESSION['acc_id'])){
    $roleId = $_SESSION['role_id'];
    $username = $_SESSION['acc_name'];
    $accId = $_SESSION['acc_id'];
}

if (isset($_GET['edit_id'])){
    $editProdId = $_GET['edit_id'];
    $editProdSql = "SELECT * FROM PRODUCT WHERE prod_id = $editProdId";
    $editProdQuery = $pdo->query($editProdSql);
    $getEditProd = $editProdQuery->fetch();
    $prodImg = $getEditProd['prod_img'];
    $prodName = $getEditProd['prod_name'];
    $prodDesc = $getEditProd['prod_desc'];
    $prodModelId = $getEditProd['model_id'];
    $prodCond = $getEditProd['prod_condition'];
    $prodReg = $getEditProd['region'];
    $prodPrice = $getEditProd['price'];

    $modelSql = "SELECT * FROM MODEL";
    $modelQuery = $pdo->query($modelSql);
    $getModel = $modelQuery->fetchAll();
    $prodModelName = "none";
    foreach ($getModel as $model){
        if ($model['model_id'] == $prodModelId){
            $prodModelName = $model['model_name'];
        }
    }
}

if (isset($_POST['update_changes'])){
    $updatedName = $_POST['productName'];
    $updatedDesc = $_POST['productDesc'];
    $updatedModel = $_POST['productModel'];
    $updatedCond = $_POST['productCond'];
    $updatedReg = $_POST['productRegion'];
    $updatedPrice = $_POST['productPrice'];

    //form validation
    if (empty($updatedName)){
        echo "<script>alert('Product name cannot be empty');</script>";
        echo "<script>window.open('editProduct.php?edit_id=$editProdId', '_self');</script>";
        exit;
    }

    if (empty($updatedDesc)){
        echo "<script>alert('Product description cannot be empty');</script>";
        echo "<script>window.open('editProduct.php?edit_id=$editProdId', '_self');</script>";
        exit;
    }

    if (empty($updatedCond)){
        echo "<script>alert('Product condition cannot be empty');</script>";
        echo "<script>window.open('editProduct.php?edit_id=$editProdId', '_self');</script>";
        exit;
    }

    if (empty($updatedDesc)){
        echo "<script>alert('Product description cannot be empty');</script>";
        echo "<script>window.open('editProduct.php?edit_id=$editProdId', '_self');</script>";
        exit;
    }

    if (empty($updatedReg)){
        echo "<script>alert('Product region cannot be empty');</script>";
        echo "<script>window.open('editProduct.php?edit_id=$editProdId', '_self');</script>";
        exit;
    }

    $pricePattern = "/^(?!^0\.00$)((^([1-9][\d]{0,6})|^([0]))\.[\d]{2})$|^([1-9][\d]{0,6})$/";

    if (!preg_match($pricePattern, $updatedPrice)){
        echo "<script>alert('Product price should be a positive number');</script>";
        echo "<script>window.open('editProduct.php?edit_id=$editProdId', '_self');</script>";
        exit;
    }

    $updateSql = "UPDATE PRODUCT SET model_id = ?, prod_name = ?, prod_condition = ?, price = ?, prod_desc = ?, region = ? WHERE prod_id = ?";
    $update = $pdo->prepare($updateSql);
    $update->execute([$updatedModel, $updatedName, $updatedCond, $updatedPrice, $updatedDesc, $updatedReg, $editProdId]);

    echo "<script>alert('Changes have been updated');</script>";
    echo "<script>window.open('dashboard.php?product_detail', '_self');</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Edit</title>
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
            <div class="row">
                <h1 class="font-ns"><b>Admin Management - Edit Product</b></h1>
                <hr class="mb-4">
            </div>

            <div class="row w-25 mx-auto">
                <img src="<?php echo $prodImg; ?>" alt="Product Image" class="img-fluid">
            </div>

            <div class="row my-auto d-flex justify-alignment-center">
                <div class="col my-3">
                    <form method="POST">
                        <div class="mb-3 w-50 mx-auto font-ps">
                            <label for="productName" class="form-label fw-bold fs-4">Product Name</label>
                            <input type="text" class="form-control" name="productName" id="editProductName" value="<?php echo $prodName; ?>">
                        </div>

                        <div class="mb-3 w-50 mx-auto font-ps">
                            <label for="productDesc" class="form-label fw-bold fs-4">Product Description</label>
                            <textarea type="text" class="form-control" name="productDesc" id="editProductDesc"><?php echo $prodDesc; ?></textarea>
                        </div>

                        <div class="mb-3 w-50 mx-auto font-ps">
                            <label for="productModel" class="form-label fw-bold fs-4">Product Model</label>
                            <select class="form-select" name="productModel" id="editProductModel">
                                <option value="<?php echo $prodModelId; ?>"><?php echo $prodModelName; ?></option>
                                <?php
                                foreach ($getModel as $model){
                                    $modelId = $model['model_id'];
                                    $modelName = $model['model_name'];
                                    if ($modelId != $prodModelId){
                                        echo "
                                        <option value='$modelId'>$modelName</option>
                                        ";
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="mb-3 w-50 mx-auto font-ps">
                            <label for="productCond" class="form-label fw-bold fs-4">Product Condition</label>
                            <input type="text" class="form-control" name="productCond" id="editProductCond" value="<?php echo $prodCond; ?>">
                        </div>

                        <div class="mb-3 w-50 mx-auto font-ps">
                            <label for="productRegion" class="form-label fw-bold fs-4">Product Region</label>
                            <input type="text" class="form-control" name="productRegion" id="editProductRegion" value="<?php echo $prodReg; ?>">
                        </div>

                        <div class="mb-3 w-50 mx-auto font-ps">
                            <label for="productPrice" class="form-label fw-bold fs-4">Product Price</label>
                            <input type="text" class="form-control" name="productPrice" id="editProductPrice" value="<?php echo $prodPrice; ?>">
                        </div>

                        <div class="text-center">
                            <input type="submit" name="update_changes" value="Update Changes" class="btn btn-lg btn-success font-koulen">
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