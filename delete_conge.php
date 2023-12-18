<?php
require_once "cruduser.php";
$crud = new cruduser();
$mat= $_GET['mat'];
$id=$_GET['id'];
if ($crud->deleteconge($id,$mat)) {
   echo "<script>alert('Le congé a été supprimé avec succès');</script>";
} else {
   echo "<script>alert('La suppression du congé a échoué');</script>";
}
header("location:congepre.php");
?>