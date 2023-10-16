<?php
session_start();

require_once('config.php');

if (isset($_SESSION['acc_id'])){
    $roleId = $_SESSION['role_id'];
    $username = $_SESSION['acc_name'];
    $accId = $_SESSION['acc_id'];
}

if (isset($_GET['edit_id'])){
    $editAccId = $_GET['edit_id'];
    $editAccSql = "SELECT * FROM ACCOUNT WHERE acc_id = $editAccId";
    $editAccQuery = $pdo->query($editAccSql);
    $getEditAcc = $editAccQuery->fetch();
    $accRoleId = $getEditAcc['role_id'];
    $accName = $getEditAcc['acc_name'];
    $accEmail = $getEditAcc['acc_email'];

    $roleSql = "SELECT * FROM ROLES";
    $roleQuery = $pdo->query($roleSql);
    $getRole = $roleQuery->fetchAll();
    $accRoleName = "none";
    foreach ($getRole as $role){
        if ($role['role_id'] == $accRoleId){
            $accRoleName = $role['role_name'];
        }
    }
}

if (isset($_POST['update_changes'])){
    $updatedRole = $_POST['editRole'];
    $updatedName = $_POST['editUsername'];
    $updatedEmail = $_POST['editEmail'];

    //form validation
    if (empty($updatedName)){
        echo "<script>alert('Username cannot be empty');</script>";
        echo "<script>window.open('editUser.php?edit_id=$editAccId', '_self');</script>";
        exit;
    }

    if (!filter_var($updatedEmail, FILTER_VALIDATE_EMAIL)){
        echo "<script>alert('Email entered is not valid');</script>";
        echo "<script>window.open('editUser.php?edit_id=$editAccId', '_self');</script>";
        exit;
    }

    $updateSql = "UPDATE ACCOUNT SET role_id = ?, acc_name = ?, acc_email = ? WHERE acc_id = ?";
    $update = $pdo->prepare($updateSql);
    $update->execute([$updatedRole, $updatedName, $updatedEmail, $editAccId]);

    if ($accId == $editAccId){
        $_SESSION['role_id'] = $updatedRole;
        $_SESSION['acc_name'] = $updatedName;
        $_SESSION['acc_email'] = $updatedEmail;
    }

    echo "<script>alert('Changes have been updated');</script>";
    echo "<script>window.open('dashboard.php', '_self');</script>";
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
                <h1 class="font-ns"><b>Admin Management - Edit User</b></h1>
                <hr class="mb-4">
            </div>

            <div class="row my-auto d-flex justify-alignment-center">
                <div class="col my-3">
                    <form method="POST">
                        <div class="mb-3 w-50 mx-auto font-ps">
                            <label for="editUsername" class="form-label fw-bold fs-4">Username</label>
                            <input type="text" class="form-control" name="editUsername" id="editUsername" value="<?php echo $accName; ?>">
                        </div>

                        <div class="mb-3 w-50 mx-auto font-ps">
                            <label for="editRole" class="form-label fw-bold fs-4">Role</label>
                            <select class="form-select" name="editRole" id="editRole">
                                <?php
                                if ($editAccId == 1){
                                    echo "<option value='$accRoleId'>$accRoleName</option>";
                                }
                                else{
                                    echo "<option value='$accRoleId'>$accRoleName</option>";

                                    foreach ($getRole as $role){
                                        $roleId = $role['role_id'];
                                        $roleName = $role['role_name'];
                                        if ($roleId != $accRoleId){
                                            echo "
                                            <option value='$roleId'>$roleName</option>
                                            ";
                                        }
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="mb-3 w-50 mx-auto font-ps">
                            <label for="editEmail" class="form-label fw-bold fs-4">Email</label>
                            <input type="text" class="form-control" name="editEmail" id="editEmail" value="<?php echo $accEmail; ?>">
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