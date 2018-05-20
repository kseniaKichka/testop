<?php
require_once 'app/models/model_main.php';

class Model_Panel extends Model_Main {

    public function getConnectDb() {
        return Db::getConnection();
    }


    public function getTask($id) {

        $pdo = $this->getConnectDb();

        $query = "
          SELECT * 
          FROM task
          LEFT JOIN task_text
          ON task.id = task_text.id_task
          WHERE task.id = ?
        ";
        $stmt = $pdo->prepare($query);

        $stmt->execute(array($id));
        return $stmt->fetch();
    }

    public function updateTask($post) {
        $pdo = $this->getConnectDb();

        $query = "
          UPDATE task 
          SET status = ?
          WHERE id = ?
        ";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array($post['status'], $post['id']));
        $queryk = "
          UPDATE task_text 
          SET text = ?
          WHERE id_task = ?
        ";
        $stmt = $pdo->prepare($queryk);
        $stmt->execute(array($post['text'],$post['id']));
    }
}