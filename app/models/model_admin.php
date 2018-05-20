<?php

class Model_Admin extends Model {


    public function getConnectDb() {
        return Db::getConnection();
    }

    public function check($post) {
        $pdo = $this->getConnectDb();

        $query = '
          SELECT id, password
          FROM users
          WHERE login = ?
          LIMIT 1
          ';
        $sth = $pdo->prepare($query);
        $sth->execute(array($post['login']));
        $red = $sth->fetch();

        if (!$this->checkEmpty($red)) {
            if ($red['password'] == md5($post['password'])) {
                return $red;
            }
        }
        return false;
    }

    public function checkEmpty($res) {
        return empty($res);
    }

    private function getLength($str) {
        return strlen($str);
    }

    private function getRand($p, $str) {
        return mt_rand($p, $str);
    }

    public function login($data) {

        $_SESSION['id'] = $data['id'];
    }

    public function logout($id) {
        unset($_SESSION['id']);
    }


}