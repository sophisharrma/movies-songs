<?php
try{
    $username = 'root';
    $password = '';
    $conn = new PDO('mysql:host=localhost; dbname=media',$username,$password);
}catch(PDOException $e){
    echo 'Connection cannot be created '.$e->getMessage();
    exit();
}