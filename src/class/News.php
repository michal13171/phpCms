<?php
declare (strict_types = 1);
require 'DBConnect.php';

class News extends DBConnect
{

    public function getAllNews(): PDOStatement
    {
        $sql = 'SELECT *, DATE(news.date_add) AS DATE FROM news, users WHERE users.id_user = news.id_user ORDER BY id_news DESC';
        $query = $this->pdo->prepare($sql);
        $query->execute();
        return $query;
    }

    public function getOneNews(int $id): PDOStatement
    {
        $sql = 'SELECT * FROM news WHERE id_news=:id';
        $query = $this->pdo->prepare($sql);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        return $query;
    }

    public function getAllNewsByUser(int $id, int $is_admin=0, string $searchValue=''): PDOStatement
    {
        if ($searchValue != '') {
            $addSearch = ' AND title LIKE "%'. $searchValue .'"';
        }else {
            $addSearch ='';
        }
        if ($is_admin === 0) {
            $sql = 'SELECT * FROM news WHERE id_user = :id_user'.$addSearch;
        }else {
            $sql = 'SELECT * FROM news WHERE 1 =1' . $addSearch;
        }
        $query = $this->pdo->prepare($sql);

        $query->bindValue(':id_user', $id, PDO::PARAM_INT);
        $query->execute();
        return $query;
    }

    public function addNews(string $title, string $text, int $id_group, int $id_user): bool
    {
        $sql = 'INSERT INTO news(title, text, id_group, id_user) VALUES (:title, :text, :id_group, :id_user)';
        $query = $this->pdo->prepare($sql);
        $query->bindValue(':title', $title, PDO::PARAM_STR);
        $query->bindValue(':text', $text, PDO::PARAM_STR);
        $query->bindValue(':id_group', $id_group, PDO::PARAM_INT);
        $query->bindValue(':id_user', $id_user, PDO::PARAM_INT);
        $result = $query->execute();
        return $result;
    }

    public function delNews(int $id): bool
    {
        $sql = 'DELETE FROM news WHERE id_news=:id';
        $query = $this->pdo->prepare($sql);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $result = $query->execute();
        return $result;
    }

    public function blockUser(int $id): bool
    {
        $sql = 'DELETE FROM news WHERE login=:login';
        $query = $this->pdo->prepare($sql);
        $query->bindValue(':login', $id, PDO::PARAM_INT);
        $result = $query->execute();
        return $result;
    }

    public function modNews(int $id, string $title, string $text, int $id_group): bool
    {
        $sql = 'UPDATE news SET title=:title, text=:text, id_group=:id_group WHERE id_news=:id';
        $query = $this->pdo->prepare($sql);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->bindValue(':title', $title, PDO::PARAM_STR);
        $query->bindValue(':text', $text, PDO::PARAM_STR);
        $query->bindValue(':id_group', $id_group, PDO::PARAM_INT);
        $result = $query->execute();
        return $result;
    }

}
