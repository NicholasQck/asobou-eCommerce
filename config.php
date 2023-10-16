<?php
$host = 'localhost';
$user = 'root';
$password = '';
$db = 'asobou';
$dsn = 'mysql:host=' . $host . ';dbname=' . $db;

//Create a pdo instance
$pdo = new PDO($dsn, $user, $password);

//Set attributes
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

//session timeout if inactive for 30 minutes (30 * 60)
if (isset($_SESSION['LAST_ACTIVITY']) && (isset($_SESSION['acc_id'])) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)){
    $_SESSION = array();

    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    session_destroy();
    echo "<script>alert('Session timeout. Please login again.')</script>";
    echo "<script>window.open('login.php', '_self')</script>";
}
$_SESSION['LAST_ACTIVITY'] = time();
?>