<?php //echo "<pre>"; var_dump($data['text']); die; ?>
<div class="container">
    <div class="row justify-content-start">
        <div class="col-4 offset-4">
            <form action="" method="post">
                <div class="form-group">
                    <label for="exampleFormControlInput1">User Name</label>
                    <input type="text" value="<?= $data['user_name'] ?>" readonly name="update[user_name]" class="form-control" id="exampleFormControlInput1" placeholder="Enter user name">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Email address</label>
                    <input type="email" value="<?= $data['email'] ?>" readonly name="update[user_email]" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Task Text</label>
                    <textarea class="form-control"  name="update[text]" id="exampleFormControlTextarea1" rows="3"><?= $data['text'] ?>
                    </textarea>
                </div>
                <div class="form-group">
                    <label for="select">Status</label>
                    <select class="custom-select" id="select" name="update[status]">
                        <option <?php if ($data['status'] == 0) { echo 'selected'; } ?>value="0">Opened</option>
                        <option <?php if ($data['status'] == 1) { echo 'selected'; } ?> value="1">Completed</option>
                    </select>
                </div>
                <input type="hidden" name="update[id]" value="<?= $data['id_task'] ?>">
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>