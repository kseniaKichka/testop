<?php

class Controller_Admin extends Controller {

    public function __construct() {
        $this->model = new Model_Admin();
        $this->view = new View();
    }

    public function action_index() {
        if (isset($_POST['admin'])) {
            if ($res = $this->model->check($_POST['admin'])) {
                $this->model->login($res);
            }
        }

        if (isset($_COOKIE['id'])) {
            $host = 'http://'.$_SERVER['HTTP_HOST'].'/panel';
            header('Location:'.$host);
        }

        $this->view->generate(
            'admin_view.php',
            'template_view.php'

        );
    }

    public function action_logout() {
        if (isset($_COOKIE['id']) ) {
            $this->model->logout($this->model->getCookie('id'));
        }
    }
}