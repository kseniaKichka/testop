
<div class="h2">Panel</div>

<table class="table">
    <thead>
    <tr>
        <th scope="col">Id</th>
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
            <td><?= $val['email'] ?></td>
            <td><?= $val['user_name'] ?></td>
            <td><?= $val['text'] ?></td>
            <td><?= $val['date_create'] ?></td>
            <td><?= $val['status'] ?></td>
            <td><a href="/panel/edit?id=<?= $val['id_task']?>">Edit</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php

for ($data['page']=1; $data['page'] <= $data['pages'] ; $data['page']++):?>

    <a href='<?php echo "?page=".$data['page'].""; ?>' class="links"><?php  echo $data['page']; ?>
    </a>

<?php endfor; ?>