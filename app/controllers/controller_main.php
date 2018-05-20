<?php

class Controller_Main extends Controller {

    public function __construct() {
        $this->model = new Model_Main();
        $this->view = new View();
    }

    function action_index() {
        $data = $this->model->get_data();
        $page = $this->model->getPage();
        $status = $this->model->getStatuses();
        $total_pages = $this->model->getTotalPages();
        $this->view->generate(
            'main_view.php',
            'template_view.php',
            array(
                'data' => $data,
                'page' => $page,
                'status' => $status,
                'pages' => $total_pages
            )
        );
    }

    function action_create() {

        if (isset($_POST['create']) && isset($_POST['create']['submit'])) {
            $this->model->setTest($_POST['create'], $this->model->uploadFile($_FILES));
            $host = 'http://'.$_SERVER['HTTP_HOST'].'/main';
            header('Location:'.$host);
        }
        if (isset($_POST) && !empty($_FILES)) {
            echo json_encode($this->model->uploadFile($_FILES)); die;
        }

        if (isset($_POST['create']) && isset($_POST['create']['preview'])) {
            $this->model->setTest($_POST['create'], $_POST['create']['image']);
            $host = 'http://'.$_SERVER['HTTP_HOST'].'/main';
            header('Location:'.$host);
        }

        $this->view->generate(
            'main_create_view.php',
            'template_view.php'
        );
    }
}