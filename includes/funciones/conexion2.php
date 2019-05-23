<?php 

$conn=new mysqli("localhost","usuario","pass","bd");

    if($conn->connect_error){
        echo $error=$conn->connect_error;
    }

?>