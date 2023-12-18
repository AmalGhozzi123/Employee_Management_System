<?php
require_once "cruduser.php";
$crud = new cruduser();
$mat= $_GET['mat'];
$crud->delete($mat);
header("location:findallpostier.php");

