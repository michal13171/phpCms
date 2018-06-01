<?php
    try {
        $objDelete = new News();
    } catch(Exception $e) {
        echo $e->getMessage();
        die();
    }
    $id = (int)$_GET['id'];
    if (isset($id)) {
        $isOk = $objDelete->delNews($id);
        if ($isOk) {
            header('Location: indexlog.php');
            die();
        }
    }
?>