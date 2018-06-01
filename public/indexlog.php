<?php
    session_start();
    require_once('../src/config/switchCms.inc.php');
    require_once('../src/config/autoloadConfig.inc.php');
    if ($_SESSION['id_session'] != session_id() || $_SESSION['ip'] =! $_SERVER['REMOTE_ADDR'] || 
    $_SESSION['client'] != $_SERVER['HTTP_USER_AGENT']) {
        header('Location: login.php');
        die();
    }
    //var_dump($_SESSION);      
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.ckeditor.com/ckeditor5/10.0.0/classic/ckeditor.js"></script>
    <title>Zarządzanie postami</title>
</head>

<style>
    body {
        padding: 30px;
    }
</style>
<body>
    Jestes zalogowany jako: <?php echo $_SESSION['login']; ?>
    <a href="login.php?logout=yes" class="btn btn-danger" id="logout">Wyloguj</a>
    <?php 
        if (isset($_GET['szukaj']) && !empty($_GET['search'])) {
            $searchTitle = htmlentities(trim($_GET['search']));
        }
    ?>
    <hr>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="search" name="search" id="">
    <input type="submit" class="btn btn-light" value="szukaj" name="Szukaj">
    </form>
    <?php
        require_once $view;
    ?>
    
    <script>
        const btn = document.getElementById('logout');
        btn.addEventListener('click', function() {
            confirm('Czy chcesz się wylogowac');
        });
    </script>

    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>

</body>
</html>