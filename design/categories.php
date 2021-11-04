<?php
session_start();
include '../inc/header.php';
include '../inc/session.php';

if (file_exists("../files/data.json")) {
    $data = file_get_contents("../files/data.json");
    $data = json_decode($data, true);
}else{
    $data = [];
}
?>

<div class="container">
    <div class="row">
        <div class="col-10 mx-auto my-3">
            <h1> All Categories</h1>
            <a href="add.php" class="btn btn-primary">Add New Category</a>
        </div>
    </div>

    <div class="row">
        <?php
        if (isset($_SESSION['success'])) {
        ?>
            <div class="alert alert-success col-10 mx-auto"><?= $_SESSION['success']; ?></div>
        <?php
        }
        ?>

        <?php
        if (isset($_SESSION['errors'])) {
            foreach ($_SESSION['errors'] as $err) {
        ?>
                <div class="alert alert-danger col-10 mx-auto"><?= $err; ?></div>
        <?php
            }
        }
        ?>
        <div class="col-10 mx-auto">
            <table class="table table-bordered">

                <thead>
                    <th>#</th>
                    <th>Category Name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </thead>

                <?php $i=1; foreach ($data as $row) : ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= $row['name']  ?></td>
                        <td>
                            <a href="../design/edit.php?id=<?= $row['id'] ?>" class="btn btn-info">Edit</a>
                        </td>
                        <td>
                            <a href="../handlers/delete.php?id=<?= $row['id'] ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </table>
        </div>
    </div>
</div>

<?php unsetSession('errors', 'success'); ?>
<?php include '../inc/footer.php'; ?>