<?php

class Model_Admin extends Model {

    private $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";

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
            if ($red['password'] == $post['password']) {
                return $red;
            }
        }
        return false;
    }

    public function checkEmpty($res) {
        return empty($res);
    }

    public function generateCode($length = 6) {

        $code = "";
        $clen = $this->getLength($this->chars) - 1;
        while ($this->getLength(strlen($code)) < $length) {
            $code .= $this->chars[$this->getRand(0, $clen)];
        }
        return $code;
    }

    private function getLength($str) {
        return strlen($str);
    }

    private function getRand($p, $str) {
        return mt_rand($p, $str);
    }

    public function login($data) {
        $pdo = $this->getConnectDb();

        $hash = md5($this->generateCode(10));

        $sth = $pdo->prepare('
          UPDATE users
          SET user_hash = ?
          WHERE id = ?
          ');
        $sth->execute(array($hash, $data['id']));
        $this->setCookie('id', $data['id'], $this->getTimecookie());
        $this->setCookie('hash', $hash, $this->getTimecookie());
    }

    public function logout($id) {
        $pdo = $this->getConnectDb();
        $sth = $pdo->prepare('
          UPDATE users
          SET user_hash = ?
          WHERE id = ?
          ');
        $sth->execute(array('', $id));
        $this->deleteCookie('id');
        $this->deleteCookie('hash');
    }

    public function getCookie($name) {
        return $_COOKIE[$name];
    }

    public function deleteCookie($name) {
        unset($_COOKIE[$name]);
    }

    private function setCookie($name, $value, $time, $path, $domain, $sucure, $httponly) {
        return setcookie($name, $value, $time, $path, $domain, $sucure, $httponly);
    }

    private function getTimecookie() {
        return time()+60*60*24*30;
    }
}