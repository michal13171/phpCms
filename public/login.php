<?php
session_start();
if (isset($_GET['logout']) && $_GET['logout'] === 'yes') {
    session_regenerate_id(); // generuje jeszcze raz nowy klucz
    session_destroy();
    $_SESSION = array();
}
require '../src/config/autoloadConfig.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Logowanie</title>
    <link rel="stylesheet" href="./css/style.css">

    <style>

    </style>
</head>
<body>
    <?php
if (isset($_POST['zaloguj'])) {
    $login = htmlentities(trim($_POST['login']));
    $password = sha1(htmlentities(trim($_POST['password'])));

    if (isset($_POST['remember'])) {
        setcookie('remember_me', "$login", time() + (24 * 60 * 60 * 90));
    }
    if (!isset($_POST['remember']) && isset($_COOKIE['remember'])) {
     //   unset($_COOKIE["remember_me"]);
        setcookie("remember_me", "$login", time() - 90);
    }
    $user = new User();
    $user->logIn($login, $password);
}

if (isset($_GET['logout'])) {
    echo 'Wylogowano poprawnie';
    header('Location: login.php');
}

if (isset($_COOKIE['remember_me'])) {
    $userlogin = $_COOKIE['remember_me'];
    $check = " checked";
} else {
    $userlogin = '';
    $check = '';
}

?>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="form-group">
            <label for="login">Podaj login</label>
            <input type="text" name="login" id="login" class="form-control" value="<?php echo $userlogin; ?>">
        </div>
        <div class="form-group">
            <label for="password">Podaj hasło</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>
        <div class="form-group form-check">
            <input type="checkbox" name="remember" id="remember" valeu="yes"<?php echo $check; ?> class="form-check-input">
            <label for="remember">Zapamiętaj moj login</label>
        </div>
        <input type="submit" name="zaloguj" value="Zaloguj" class="btn btn-primary">
    </form>

</body>
</html>