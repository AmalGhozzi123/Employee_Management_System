<?php
session_start();
if(!isset($_SESSION['matricule'])|| !isset($_SESSION['ppassword']) ){
    header("location:login.php");exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/findpostier.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Document</title>
    <style>
.input{width:70px;}
#ok{position:absolute;
top:200px;
left:700px;
font-family:Georgia, serif;
}
.cherche{position:absolute;
left:100px;
top:0px;}
.icon{color:black;
font-size:20px;}
header h4 {
    color: #e0ac1c;
  
}

header span {
    color: #031b62;

}
header{text-align:center;
    font-family:Georgia, serif;
    }
    .retour {
  display: inline-block;
  padding: 10px 10px;
  background-color:#18022f ;
  color: white;
  font-size: 12px;
  text-decoration: none;
  border-radius: 7px;
  transition: background-color 0.3s ease;
  position:absolute;
  top:0px;
  left:0px;
}

.retour i {
  margin-right: 10px;
}

.retour:hover {
  background-color:#e0ac1c ;
}
table {font-family:Georgia, serif;
			width: 500%;
			max-width: 1400px;
			color: #333;
			border: 3px solid #ccc;
			border-radius: 10px;
			box-shadow: 0 3px 3px rgba(0, 0, 0, 0.1);
			background-color: #fff;
			overflow: hidden;
            position:absolute;
            left:50px;
		}
		table th, table td {
			padding: 12px;
			text-align: left;
			vertical-align: middle;
			border-top: 3px solid #ccc;
			border-bottom: 3px solid #ccc;
            font-size:15px;
		}
		table th {
			background-color: #f1f1f1;
			color: #666;
		
			letter-spacing: 1px;
			font-weight: 600;
			border-top: none;
		}
		table td {
			background-color: #fff;
			color: #333;
		}
		table tr:nth-child(even) td {
			background-color: #f9f9f9;
		}
		table tr:hover td {
			background-color: #f5f5f5;
		}
    </style>
</head>
<body style="background-color: #eaf0f2">
<?php
$title ="<header><h4><b>Employé <span>Cherchée</span></b></h4></header></br>";
ob_start();
require_once "crud.php";
$crud = new CRUD();
$mat=$_GET['mat'];
$user=$crud->finddconge($mat); 
?>
<a href="admincongés.php" class="retour"><i class="fa fa-chevron-left"></i> Retour</a>  
<table >
<thead >
        <tr>
            <th>Matricule</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th >Grade</th>
            <th>Direction</th>
            <th>Date Début</th>
            <th>Date Fin</th>
            <th>Raison</th>
            <th colspan="2">Statut</th>

        </tr>  
</thead>
<tbody>
    <?php
        echo "<tr>";
        foreach ($user as $value){
            echo "<td>$value</td>";
           
        }
        ?>
</tr></tbody></table>
<?php

    $container =ob_get_clean();
    include "layout.php";
    ?>
    
    
</body>
</html>
