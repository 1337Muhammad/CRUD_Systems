<?php
   function requriedVal($val){
       if(empty($val)){
           return false;
       }
       return true;
   }

   function minVal($val, $min){
       if(strlen($val)<$min){
           return false;
       }
       return true;
   }
?>