<?php
$conn=new mysqli("localhost","root","","gdlwebcam");

if($conn->connect_error){
    echo $error -> $conn->connect_error;
}
?>