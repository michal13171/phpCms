
<?php

try {
    $news = new News();
} catch (Exception $e) {
    echo $e->getMessage();
    die();
}

$id = (int) $_SESSION['id_user'];
$is_admin = (int) $_SESSION['is_admin'];
if (isset($_GET['search'])) {
    $searchTitle = htmlentities(trim($_GET['search']));
}else {
    $searchTitle ='';
}
$newsItems = $news->getAllNewsByUser($id, $is_admin, $searchTitle);
?>

<table class="table">
            <thead>
                <tr>
                    <th scope="col">LP</th>
                    <th scope="col">TITLE</th>
                    <th scope="col">Date_add</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>

<?php
$lp = 1;
while ($row = $newsItems->fetch()) {
    ?>
    <tbody>
        <tr>
            <td><?php echo $lp++; ?></td>
            <td><?php echo $row->title; ?></td>
            <td><?php echo $row->date_add; ?></td>
            <td>
                <a href="?page=mod&id=<?php echo $row->id_news; ?>" class="btn btn-sm btn-primary">Modyfikuj</a>
                <a href="?page=del&id=<?php echo $row->id_news; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Czy chcesz usunac ten rekord?')">Usuń</a>
            </td>
        </tr>
    </tbody>
<?php
}
?>

  </table>

<hr>
<a href="?page=add" class="btn btn-success">Dodaj</a>
