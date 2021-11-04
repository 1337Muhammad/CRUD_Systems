<?php
session_start();
include '../core/validations.php';

if (isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == "POST") {

    $id = ($_POST['id']) ?? '';
    $catName = (trim(htmlspecialchars($_POST['name']))) ?? '';

    $errors = [];


    if (file_exists('../files/data.json')) {
        $data = file_get_contents('../files/data.json');
        $data = json_decode($data, true);

        $errors = ['ID is not in file']; // consider that id is not in file

        foreach ($data as $key => $row) {
            if ($row['id'] == $id) { // id exist

                $errors = []; // empty errors from ['ID is not in file']

                // validate $row
                if (!requriedVal($catName)) {
                    $errors[] = "Name is required";
                    break;
                } elseif (!minVal($catName, 3)) {
                    $errors[] = "Length must be greater than 3 chars";
                    break;
                }

                // insert row
                $data[$key]['name'] = $catName;

                $dataJson = json_encode($data, JSON_PRETTY_PRINT); // encoding to json
                file_put_contents('../files/data.json', $dataJson); // save file with new edits
                $_SESSION['success'] = "Category updated successfully";
                break;
            } // id is not in file
        }

    } else { // file not exist
        $errors[] = "File not exist";
    }
} else { // request error /* must not happen */
    // $errors
}


$_SESSION['errors'] = $errors;

// echo "<pre>";
// print_r($errors);
// echo "</pre>";die;

header('location:../design/categories.php');

