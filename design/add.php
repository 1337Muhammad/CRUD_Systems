<?php
session_start();
include '../inc/header.php'; ?>
<?php include '../inc/session.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-10 mx-auto my-3 border p-3">
            <h1> All Categories</h1>
            <a href="categories.php" class="btn btn-primary">View All</a>
        </div>
    </div>
    <div class="row">
        <div class="col-10 mx-auto">
            <?php
            if (isset($_SESSION['success'])) {
            ?>
                <div class="alert alert-success"><?= $_SESSION['success']; ?></div>
            <?php
            }
            ?>

            <?php
            if (isset($_SESSION['errors'])) {
                foreach ($_SESSION['errors'] as $err) {
            ?>
                    <div class="alert alert-danger"><?= $err; ?></div>
            <?php
                }
            }
            ?>
            <form action="../handlers/add.php" method="POST">
                <div class="mb-3">
                    <label for="cat-name"> Category Name</label>
                    <input type="name" name="name" class="form-control <?= (!empty($_SESSION['errors']))? 'is-invalid':'' ; ?>" id="cat-name">
                    <!-- <div class="invalid-feedback">
                        somthing
                    </div> -->
                </div>
                <div class="mb-3">
                    <input type="submit" value="Save" class="form-control bg-success text-white" name="submit">
                </div>
            </form>
        </div>
    </div>
</div>

<?php unsetSession('errors', 'success'); ?>

<?php include '../inc/footer.php'; ?>