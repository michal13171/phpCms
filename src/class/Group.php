<?php

    declare(strict_types=1);

    class Group extends DBConnect {
        public function getAllGroups(): PDOStatement {
            $sql = 'SELECT * FROM codeskills.group';
            $query = $this->pdo->prepare($sql);
            $query->execute();
            return $query;
        }
    }

?>