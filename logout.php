<?php 
session_start();//démarre une  session 
session_unset();//supprime toutes les variables de session
session_destroy();//détruit complètement la session en cours
header("location:login.php");exit;