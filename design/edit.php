<?php 
session_start();
include '../inc/header.php';
?>

<?php

if (isset($_GET['id']) && $_SERVER['REQUEST_METHOD'] == "GET") {
    $id = $_GET['id'];

    if (file_exists('../files/data.json')) {
        $data = file_get_contents('../files/data.json');
        $data = json_decode($data, true);

        $errors = ['ID is not in file']; // consider that id is not in file


        foreach ($data as $key => $row) {
            if ($row['id'] == $id) { // if id existgit add . && git commit -m "initial commit" && git push
                $catId = $row['id'];
                $catName = $row['name'];
                $errors = []; // empty errors from ['ID is not in file']
                break;
            } // id is not in file
        }
    } else { // file not exist
        $errors[] = "File not exist";
    }
} else { // request error /* must not happen */
    // $errors
}


if(!empty($errors)){ // if errors exist
    $_SESSION['errors'] = $errors;
    header('location:categories.php');
    exit;
}
?>

<div class="container">
    <div class="row">
        <div class="col-10 mx-auto my-3 border p-3">
            <h1> All Categories</h1>
            <a href="categories.php" class="btn btn-primary">View All</a>
        </div>
    </div>
    <div class="row">
        <div class="col-10 mx-auto">
            <form action="../handlers/edit.php?id=<?= $catId ?>" method="POST">
                <!-- @csrf -->
                <h3>Edit Info</h3>
                <div class="mb-3">
                    <input type="hidden" name="id" value="<?= ($catId) ?? ''; ?>">
                    <label for="cat-name">Category Name</label>
                    <input type="name" name="name" class="form-control" id="cat-name" value="<?= ($catName) ?? ''; ?>">
                </div>
                <div class="mb-3">
                    <input type="submit" value="Save" class="form-control bg-success text-white" name="submit">
                </div>
            </form>
        </div>
    </div>
</div>

<?php include '../inc/footer.php'; ?>