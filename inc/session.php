<?php

function successMsg(){
    if(isset($_SESSION['success'])){
        return $_SESSION['success'];
    }
}

function errorsMsg(){
    if(isset($_SESSION['errors'])){
        // return $_SESSION['errors'];
        return true;
    }
    return false;
}

function unsetSession(...$keys){
    foreach($keys as $key){
        if(isset($_SESSION[$key])){
            unset($_SESSION[$key]);
        }
    }
}