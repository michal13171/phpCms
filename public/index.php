<?php 
    session_start();
    require('../src/config/autoloadConfig.inc.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Wiadomości</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <a href="login.php" class="btn btn-info">Zaloguj</a>
   
    <?php
    
        try {
            $news = new News();
        } catch (Exception $e) {
            echo $e->getMessage();
            die();
        }

        $newsItems = $news->getAllNews();
        while($row = $newsItems->fetch()) {
        ?>    
            <div class="jumbotron">
                <h1 class="display-4"><?php echo $row->title; ?></h1>
                <p class="lead"><?php echo $row->text; ?></p>
                <hr class="my-4">
                <p><?php echo 'Dodano: ' . $row->DATE . ' przez ' . $row->firstname . ' ' . $row->surname ?></p>
            </div>
        <?php    
        }
        $newsItems->closeCursor();
        unset($newsItems);
        unset($news);
    ?>
</body>
</html>