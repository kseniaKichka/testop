<?php

class Model_Main extends Model {

    public $limit = 2;
    public $starting_limit;
    public $page;
    public $total_pages;

    public function get_data() {
        $pdo = Db::getConnection();

        $this->getPagination();
        $stmt = $pdo->prepare("
          SELECT * 
          FROM task
          LEFT JOIN task_text
          ON task.id = task_text.id_task
          LIMIT $this->starting_limit, $this->limit
        ");

        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getPagination() {
        $pdo = Db::getConnection();
        $query = "SELECT * FROM task";

        $s = $pdo->prepare($query);
        $s->execute();
        $total_results = $s->rowCount();
        $this->total_pages = ceil($total_results/$this->limit);

        if (!isset($_GET['page'])) {
            $this->page = 1;
        } else{
            $this->page = $_GET['page'];
        }

        $this->starting_limit = ($this->page-1)*$this->limit;
        return $this->starting_limit;
    }

    public function getPage() {
        return $this->page;
    }

    public function getTotalPages() {
        return $this->total_pages;
    }
}