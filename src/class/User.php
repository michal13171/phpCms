<?php
declare (strict_types = 1);
require 'DBConnect.php';

class User extends DBConnect
{

    public function logIn(String $login, String $password): void
    {
        $sql = 'SELECT count(id_user) FROM users WHERE login = :login AND password = :password';
        $query = $this->pdo->prepare($sql);
        $query->bindValue(':login', $login, PDO::PARAM_STR);
        $query->bindValue(':password', $password, PDO::PARAM_STR);
        $query->execute();

        //metoda sprawdzająca czy dany użytkownik istnieje i zwraca 1 jak tak i 0 jak nie
        $loginOK = $query->fetchColumn();
        //echo '<p>' . $loginOK . '</p>';
        //var_dump($loginOK);
        $sess = new Session();
        if (!isset($_SESSION['badlogin'][$login])) {
            $_SESSION['badlogin'][$login] = 0;
        }
        
        if ((int) $loginOK === 1) {
            $query2 = $this->pdo->prepare("SELECT id_user, login, is_admin FROM users WHERE login = '$login'");
            $query2->execute();
            $sess->id_session = session_id();
            $sess->ip = $_SERVER['REMOTE_ADDR']; // ściąga IP
            $sess->client = $_SERVER['HTTP_USER_AGENT']; // ściąga adres http
            $arr = $query2->fetch();
            var_dump($arr);
            $sess->id_user = $arr->id_user;
            $sess->login = $arr->login;
            $sess->is_admin = $arr->is_admin;
            new Logger('test.log', '[INFO] Poprawne zalogowanie', $login);
            header('Location: indexlog.php');
            exit;
        } else {
            $_SESSION['badlogin'][$login]++;
            if ($_SESSION['badlogin'][$login] > 3) {
                $del = new News();
                $del->blockUser($login);
                echo 'Konto zablokowane stworz nowe';
                die;
            }elseif ($_SESSION['badlogin'][$login] > 2) {
                echo 'uważaj jak zle wpiszesz zablokujesz se konto';
            }
            var_dump($_SESSION);
            // require_once('Logger.php');
            new Logger('test.log', '[ERROR] Bledne logowanie', $login);

        }
    }

}
