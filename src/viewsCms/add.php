<?php

    if (isset($_POST['zapisz']) && !empty($_POST['title']) && !empty($_POST['content'])) {

        $title = htmlentities(trim($_POST['title']));
        $content = strip_tags(trim($_POST['content']), '<strong>, <i>, <p>, <h1>, <h2>, <h3>, <h4>, <h5>, <h6>, <ul>, <ol>, <li>, <img>, <blockquote>');
        $id_group = (int)$_POST['group'];
    
        try {
            $add = new News();
        } catch (Exception $e) {
            echo $e->getMessage();
            die();
        }
        $sess = new Session();
        $res = $add->addNews($title, $content, $id_group, $sess->id_user);
        if ($res) {
            header('Location: indexlog.php');
            die;
        }
    } 

?>

<form action="<?php echo $_SERVER['PHP_SELF']?>?page=add" method="post" style="width: 50%;">
    <br>
    <input type="text" name="title"> podaj tytuł <br><br>
    <textarea name="content" id="editor"></textarea><br>
    <select name="group">
        <?php
            try {
                $groups = new Group();
            } catch (Exception $e) {
                echo $e->getMessage();
                die();
            }
            $groupItems = $groups->getAllGroups();
            while ($row = $groupItems->fetch()) {
            ?>
                <option value="<?php echo $row->id_group;?>"><?php echo $row->name;?></option>
            <?php    
            }
        ?>
    </select> <br><br>
    <input type="submit" value="Zapisz" name="zapisz" class="btn btn-success">

</form>