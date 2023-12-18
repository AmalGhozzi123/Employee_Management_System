<?php
require_once "crud.php";

if(isset($_GET['id']) && isset($_GET['mat'])) {
    $id = $_GET['id'];
    $mat = $_GET['mat'];

    $crud = new crud();
    $res = $crud->deleteprime($id, $mat);

    if($res) {
       header("location:findpostier.php");

     
    } 
}





?>
