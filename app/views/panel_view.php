<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="h2">Panel</div>
        </div>
    </div>
</div>
<?php
$page = 1;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}
?>
<div class="row">
    <div class="col-12">
        <div class="btn-group">
            <div class="dropdown">
                <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Sort by name
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a href="?page=<?= $page?>&sort=user_name_asc" class="btn btn-outline-primary btn-sm " role="button" aria-pressed="true">ASC</a>
                    <a href="?page=<?= $page?>&sort=user_name_desc" class="btn btn-outline-primary btn-sm " role="button" aria-pressed="true">DESC</a>
                </div>
            </div>
        </div>
        <div class="btn-group">
            <div class="dropdown">
                <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Sort by email
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a href="?page=<?= $page?>&sort=email_asc" class="btn btn-outline-primary btn-sm " role="button" aria-pressed="true">ASC</a>
                    <a href="?page=<?= $page?>&sort=email_desc" class="btn btn-outline-primary btn-sm " role="button" aria-pressed="true">DESC</a>
                </div>
            </div>
        </div>
        <div class="btn-group">
            <div class="dropdown">
                <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Sort by status
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a href="?page=<?= $page?>&sort=status_asc" class="btn btn-outline-primary btn-sm " role="button" aria-pressed="true">ASC</a>
                    <a href="?page=<?= $page?>&sort=status_desc" class="btn btn-outline-primary btn-sm " role="button" aria-pressed="true">DESC</a>
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
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($data['data'] as $val) : ?>
        <tr>
            <th scope="row"><?= $val['id_task'] ?></th>
            <td class="text-center"><img  src="<?= !empty($val['image_path']) ? $val['image_path'] : '/images/no-photo.png' ?>"></td>
            <td><?= $val['email'] ?></td>
            <td><?= $val['user_name'] ?></td>
            <td><?= $val['text'] ?></td>
            <td><?= $val['date_create'] ?></td>
            <td><?= $data['status'][$val['status']] ?></td>
            <td><a href="/panel/edit?id=<?= $val['id_task']?>">Edit</a></td>
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