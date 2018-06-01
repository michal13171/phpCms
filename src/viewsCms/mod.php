<hr>
<?php
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        
        $id = (int)$_GET['id'];
        
        try {
            $getNews = new News();
        } catch (Exception $e) {
            echo $e->getMessage();
            die();
        }
        
        $stmt = $getNews->getOneNews($id);        
        $arr = $stmt->fetch();

        // var_dump($arr);
    }

    if (isset($_POST['zapisz'])) {

        $id = (int)$_POST['id'];
        $title = htmlentities(trim($_POST['title']));
        $text = htmlentities(trim($_POST['content']));
        $id_group = (int)$_POST['group'];

        try {
            $modNews = new News();
        } catch (Exception $e) {
            echo $e->getMessage();
            die();
        }
        
        $newModification = $modNews->modNews($id, $title, $text, $id_group);
        if ($newModification) {
            header('Location: indexlog.php');
        }
    }
?>


<form action="<?php echo $_SERVER['PHP_SELF']?>?page=mod" method="post" style="width: 50%;">
    <br>
    <input type="text" name="title" value="<?php echo $arr->title; ?>"> podaj tytuł <br><br>
    <textarea name="content" id="editor"><?php echo $arr->text; ?></textarea><br>
    <input type="hidden" name="id" value="<?php echo $arr->id_news; ?>">
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
                $selected = '';
                if ($row->id_group === $arr->id_group) {
                    $selected = " selected=\"selected\"";
                }
        ?>
                <option value="<?php echo $row->id_group;?> selected="<?php echo $selected; ?>"><?php echo $row->name;?></option>
        <?php    
            }
        ?>
    </select> <br><br>
    <input type="submit" value="Zapisz" name="zapisz" class="btn btn-success">

</form>