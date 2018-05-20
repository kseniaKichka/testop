<div class="h2">Tasks</div>
<?php
//echo "<pre>";
//var_dump($data); die;
?>
<table class="table">
    <thead>
    <tr>
        <th scope="col">Id</th>
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
                <td><?= $val['email'] ?></td>
                <td><?= $val['user_name'] ?></td>
                <td><?= $val['text'] ?></td>
                <td><?= $val['date_create'] ?></td>
                <td><?= $val['status'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php
if ($data['pages'] >1) :


for ($data['page']=1; $data['page'] <= $data['pages'] ; $data['page']++):?>

<a href='<?php echo "?page=".$data['page'].""; ?>' class="links"><?php  echo $data['page']; ?>
 </a>

<?php endfor; ?>
<?php endif; ?>