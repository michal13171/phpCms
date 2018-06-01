<?php

    const PATH_VIEWS = '../src/viewsCms/';
    $view = PATH_VIEWS . 'start.php';

    if (isset($_GET['page']) && !empty($_GET['page'])) {
        $page = htmlentities(trim($_GET['page']));
        switch($page) {
            case 'add':
            $view = PATH_VIEWS . 'add.php';
            break;
            case 'mod':
            $view = PATH_VIEWS . 'mod.php';
            break;
            case 'del':
            $view = PATH_VIEWS . 'del.php';
            break;
        }
    }

?>