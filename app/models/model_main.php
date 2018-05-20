<?php

class Model_Main extends Model {

    public $limit = 2;
    public $starting_limit;
    public $page = 1;
    public $total_pages;
    private $width = 320;
    private $height = 240;
    private $types = array('image/gif', 'image/png', 'image/jpeg');
    public $status = array(0 => 'Opened', 1 => 'Completed');

    public function getConnectDb() {
        return Db::getConnection();
    }

    public function getStatuses() {
        return $this->status;
    }

    public function get_data() {
        $pdo = $this->getConnectDb();

        $this->getPagination();
        $query = "
          SELECT * 
          FROM task
          LEFT JOIN task_text
          ON task.id = task_text.id_task
          LIMIT $this->starting_limit, $this->limit
        ";
        $stmt = $pdo->prepare($query);

        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getModal($data) {

    }

    public function getPagination() {
        $pdo = $this->getConnectDb();

        $query = "SELECT * FROM task";
        $s = $pdo->prepare($query);
        $s->execute();

        $total_results = $s->rowCount();
        $this->total_pages = $this->setTotalPages($total_results);

        $this->setNumber();

        $this->starting_limit = $this->setLimit();
        return $this->starting_limit;
    }

    public function setNumber() {
        if ($this->checkGetPage()) {
            $this->setCurrentPage($_GET['page']);
        }
    }

    public function setTotalPages($res) {
        return ceil($res / $this->limit);
    }

    public function setLimit() {
        return ($this->page - 1) * $this->limit;
    }

    public function setCurrentPage($get) {
        return $this->page = $get;
    }

    public function checkGetPage() {
        return isset($_GET['page']);
    }

    public function getPage() {
        return $this->page;
    }

    public function getTotalPages() {
        return $this->total_pages;
    }


    public function setTest($post, $img_path) {
        $pdo = $this->getConnectDb();

        $query = "
          INSERT INTO task 
          (`email`, `status`, `image_path`)
          VALUES (?,?,?)
        ";
        $stmt = $pdo->prepare($query);
        $stmt->execute(array($post['user_email'], 0,$img_path));

        $ins = "
          INSERT INTO task_text
          (`id_task`, `text`, `user_name`)
          VALUES (?,?,?)
        ";
        $stmt = $pdo->prepare($ins);
        $stmt->execute(array($pdo->lastInsertId(), $post['text'],$post['user_name']));
    }

    public function getuploadDir() {
        return $_SERVER['DOCUMENT_ROOT']. '/upload/';
    }

    public function getUploadFile($img) {
        return $this->getuploadDir() . basename($img['image']['name']);
    }

    public function setUploadFile($img, $uploadfile) {
        return move_uploaded_file($img['image']['tmp_name'], $uploadfile);
    }

    public function uploadFile($img) {

        if ($this->checkType($img)) {
            if ($this->checkSize($img)) {
                if ($this->setUploadFile($img, $this->getUploadFile($img))) {
                    return $this->getUploadFile($img);
                }
            } else {
                return $this->resizeImg($img, $this->getSize($img), false, $img["image"]["tmp_name"]);
            }
        }
        return false;
    }

    public function checkType($img) {
        return in_array($img['image']['type'], $this->types);
    }

    public function getSize($img) {
        return getimagesize($img["image"]["tmp_name"]);
    }

    public function checkSize($img) {
        $img_size = $this->getSize($img);
        if ($img_size[0] <= $this->width && $img_size[1] <= $this->height) {
            return true;
        }

        return false;

    }

    public function createImage($img) {
        if ($img['image']['type'] == 'image/jpeg') {
            return imagecreatefromjpeg($img['image']['tmp_name']);
        } elseif ($img['image']['type'] == 'image/png') {
            return imagecreatefrompng($img['image']['tmp_name']);
        } elseif ($img['image']['type'] == 'image/gif') {
            return imagecreatefromgif($img['image']['tmp_name']);
        }
    }

    public function resizeImg($img, $size, $save, $src) {

        $source = $this->createImage($img);

        $now = $this->getRatio($size[0], $size[1]);
        $need = $this->getRatio($this->width, $this->height);
        $scale = $this->getScale($this->height, $size[1]);
        if($now < $need) {
            $new_size = array($this->height * $now, $this->height);
            $src_pos = array(0,0);
        } else {
            $new_size = array($this->width, $this->width / $now);
            $src_pos = array(($size[1] * $scale - $this->height) / $scale / 2, 0);
        }

        $thumb = $this->getCreate($new_size);

        $this->getImageCopy($thumb, $source, $src_pos, $new_size, $size);

        if ($i = $this->saveImg($thumb, $img)) {
            return $i;
        }
        return false;

    }

    public function getCreate($new_size) {
        return imagecreatetruecolor($new_size[0], $new_size[1]);
    }

    public function getImageCopy($thumb, $source, $src_pos, $new_size, $size) {
        return imagecopyresampled($thumb, $source, 0, 0, $src_pos[0], $src_pos[1], $new_size[0], $new_size[1], $size[0], $size[1]);;
    }

    public function getScale($s_n, $s) {
        return $s_n / $s;
    }

    public function getRatio($w, $h) {
        return $w / $h;
    }

    public function saveImg($thumb, $img) {
        if ($img['image']['type'] == 'image/jpeg') {
            imagejpeg($thumb, $_SERVER['DOCUMENT_ROOT'] . '/upload/' . $img['image']['name']);
        } elseif ($img['image']['type'] == 'image/png') {
            imagepng($thumb, $_SERVER['DOCUMENT_ROOT'] . '/upload/' . $img['image']['name']);
        } elseif ($img['image']['type'] == 'image/gif') {
            imagegif($thumb, $_SERVER['DOCUMENT_ROOT'] . '/upload/' . $_FILES['image']['name']);
        }
        return 'http://'.$_SERVER['HTTP_HOST'] . '/upload/' . $_FILES['image']['name'];
    }
}