<?php

session_start();

$errors = [];
if (isset($_GET['id']) && $_SERVER['REQUEST_METHOD'] == "GET") {
    $id = $_GET['id'];
    if (file_exists('../files/data.json')) {
        $data = file_get_contents('../files/data.json');
        $data = json_decode($data, true);

        $errors = ['ID is not in file']; // consider that id is not in file

        foreach($data as $key=>$row){
            if($row['id'] == $id){  
                unset($data[$key]); // deleteing the row
                $dataJson = json_encode($data, JSON_PRETTY_PRINT); // encoding to json
                file_put_contents('../files/data.json', $dataJson);
                $_SESSION['success'] = "Category deleted successfully";
                $errors = []; // empty errors from ['ID is not in file']
                break;
            }// id is not in file
        }
    }else{ // file not exist
        $errors[] = "File not exist";
    } 
}else{ // request error /* must not happen */
    // $errors
} 


$_SESSION['errors'] = $errors;


header('location:../design/categories.php');
