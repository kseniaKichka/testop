<?php

class Controller_Main extends Controller {

    public function __construct() {
        $this->model = new Model_Main();
        $this->view = new View();
    }

    function action_index() {
        $data = $this->model->get_data();
        $page = $this->model->getPage();
        $total_pages = $this->model->getTotalPages();
        $this->view->generate(
            'main_view.php',
            'template_view.php',
            array(
                'data' => $data,
                'page' => $page,
                'pages' => $total_pages
            )
        );
    }

    function action_create() {
        if (isset($_POST['create'])) {
            $this->model->setTest($_POST['create'], $this->model->uploadFile($_FILES));
            $host = 'http://'.$_SERVER['HTTP_HOST'].'/main';
            header('Location:'.$host);
        }

        $this->view->generate(
            'main_create_view.php',
            'template_view.php'
        );
    }
}