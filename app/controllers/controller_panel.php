<?php

class Controller_Panel extends Controller {

    public function __construct() {
        $this->model = new Model_Panel();
        $this->view = new View();
    }

    public function action_index() {

        $this->model->checkLogin();

        $data = $this->model->get_data();
        $page = $this->model->getPage();
        $status = $this->model->getStatuses();
        $total_pages = $this->model->getTotalPages();
        $this->view->generate(
            'panel_view.php',
            'template_view.php',
            array(
                'data' => $data,
                'page' => $page,
                'status' => $status,
                'pages' => $total_pages
            )
        );
    }

    public function action_edit() {
        $this->model->checkLogin();
        if (isset($_POST['update'])) {
            $this->model->updateTask($_POST['update']);
            $host = 'http://'.$_SERVER['HTTP_HOST'].'/panel';
            header('Location:'.$host);
        }
        $data = $this->model->getTask($_GET['id']);

        $this->view->generate(
            'panel_edit_view.php',
            'template_view.php',
             $data

        );
    }
}