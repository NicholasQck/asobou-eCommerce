<?php
session_start();

require_once('config.php');

if (isset($_SESSION['acc_id'])){
    $roleId = $_SESSION['role_id'];
    $username = $_SESSION['acc_name'];
    $accId = $_SESSION['acc_id'];
}

if (isset($_GET['logout']) && $_GET['logout'] == true){
    $_SESSION = array();

    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    session_destroy();
    echo "<script>alert('You have successfully logged out.')</script>";
    echo "<script>window.open('index.php', '_self')</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asobou</title>
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

        <div class="container-lg">
            <div class="row mx-5">
                <div class="col-lg-7">
                    <img class="img-fluid" src="resource/images/Nintendo-Switch.jpg" alt="Nintendo Switch">
                </div>
                <div class="col-lg-5" style="font-size: large;">
                    <h1 class="mt-5 font-ps"><b>Play With The Games You Love</b></h1>
                    <p class="mt-3 font-ps">Own a Nintendo Switch at a lower price when you shop with us!</p>
                    <a href="product.php"><button type="button" class="btn btn-lg mt-5 font-ps" style="border-radius: 44px; background-color: #5AD5FC; color: white;">See More</button></a>
                </div>
            </div>

            <div class="row mx-5 mt-5">
                <div class="col me-auto">
                    <h1 class="font-ps">Top Selling Products</h1>
                </div>
            </div>

            
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <a href="product.php?prod_id=8"><img src="resource/images/nintendo_switch/nintendo_switch_game4.jpg" class="d-block h-100" alt="Product Image"></a>
                    </div>
                    <div class="carousel-item">
                        <a href="product.php?prod_id=5"><img src="resource/images/nintendo_switch/nintendo_switch_game3.jpeg" class="d-block h-100" alt="Product Image"></a>
                    </div>
                    <div class="carousel-item">
                        <a href="product.php?prod_id=41"><img src="resource/images/xbox/xbox_nyko_sound_pad.jpg" class="d-block h-100" alt="Product Image"></a>
                    </div>
                    <div class="carousel-item">
                        <a href="product.php?prod_id=23"><img src="resource/images/nintendo_switch/nintendo_switch_controller.jpg" class="d-block h-100" alt="Product Image"></a>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
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
