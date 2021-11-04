<?php

session_start();
include '../core/validations.php';

$errors = [];

if (isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    // sanitize data
    $name = trim(htmlspecialchars($_POST['name']));
    // echo $name;
    // start validation
    if (!requriedVal($name)) {
        $errors[] = "Name is required";
    } elseif (!minVal($name, 3)) {
        $errors[] = "Length must be greater than 3 chars";
    }

    //if no errors , store in jsonFile
    if (empty($errors)) {
        $data = ['id' => rand(100, 1000000), 'name' => $name];

        // check if file exists
        if (file_exists('../files/data.json')) { // file exist
            // get current file content convert to array , append new data , save to json file
            $oldData = file_get_contents('../files/data.json');
            $oldData = json_decode($oldData, true);
            $oldData[] = $data; 
            $dataJson = json_encode($oldData, JSON_PRETTY_PRINT);
            
            file_put_contents('../files/data.json' ,$dataJson);
        } else { // file no exist
            $dataJson = json_encode([$data], JSON_PRETTY_PRINT);
            file_put_contents('../files/data.json' ,$dataJson);
        }
            // echo "<pre>";
            // print_r($dataJson);
            // echo "</pre>";die;
        /* $data
            {
                "id": 771913,
                "name": "Men Wears"
            }
        */
        /* [$data]
            [
                {
                    "id": 603790,
                    "name": "arrcat"
                }
            ]
        */

        $_SESSION['success'] = "Category Added!";


        header('location:../design/add.php');
    } else {
        $_SESSION['errors'] = $errors;
        header('location:../design/add.php');
    }
}
