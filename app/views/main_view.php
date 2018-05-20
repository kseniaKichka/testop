<div class="h2">Tasks</div>
<?php
//echo "<pre>";
//var_dump($data); die;
?>
<div class="row">
    <div class="col-6">
        <div class="btn-group">
            <div class="dropdown">
                <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Sort by name
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a href="?page=<?= $_GET['page']?>&sort=user_name_asc" class="btn btn-outline-primary btn-sm " role="button" aria-pressed="true">ASC</a>
                    <a href="?page=<?= $_GET['page']?>&sort=user_name_desc" class="btn btn-outline-primary btn-sm " role="button" aria-pressed="true">DESC</a>
                </div>
            </div>
        </div>
        <div class="btn-group">
            <div class="dropdown">
                <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Sort by email
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a href="?page=<?= $_GET['page']?>&sort=email_asc" class="btn btn-outline-primary btn-sm " role="button" aria-pressed="true">ASC</a>
                    <a href="?page=<?= $_GET['page']?>&sort=email_desc" class="btn btn-outline-primary btn-sm " role="button" aria-pressed="true">DESC</a>
                </div>
            </div>
        </div>
        <div class="btn-group">
            <div class="dropdown">
                <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Sort by status
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a href="?page=<?= $_GET['page']?>&sort=status_asc" class="btn btn-outline-primary btn-sm " role="button" aria-pressed="true">ASC</a>
                    <a href="?page=<?= $_GET['page']?>&sort=status_desc" class="btn btn-outline-primary btn-sm " role="button" aria-pressed="true">DESC</a>
                </div>
            </div>
        </div>
    </div>
</div>

<table class="table">
    <thead>
    <tr>
        <th scope="col">Id</th>
        <th scope="col">Image</th>
        <th scope="col">User Email</th>
        <th scope="col">User Name</th>
        <th scope="col">Task Text </th>
        <th scope="col">Date Created</th>
        <th scope="col">Status</th>
    </tr>
    </thead>
    <tbody>
        <?php foreach ($data['data'] as $val) : ?>
            <tr>
                <th scope="row"><?= $val['id'] ?></th>
                <td><img src="<?= $val['image_path'] ?>"></td>
                <td><?= $val['email'] ?></td>
                <td><?= $val['user_name'] ?></td>
                <td><?= $val['text'] ?></td>
                <td><?= $val['date_create'] ?></td>
                <td><?= $data['status'][$val['status']] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<nav aria-label="Page navigation example">
  <ul class="pagination">
    <?php
    if ($data['pages'] >1) :
    for ($data['page']=1; $data['page'] <= $data['pages'] ; $data['page']++):?>
        <li class="page-item"><a class="page-link" href="<?php echo "?page=".$data['page'].""; ?><?php if (isset($_GET['sort'])) {echo "&sort=". $_GET['sort']; }?>"><?php  echo $data['page']; ?></a></li>


    <?php endfor; ?>
    <?php endif; ?>
  </ul>
</nav>
