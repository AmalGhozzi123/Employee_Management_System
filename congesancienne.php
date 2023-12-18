<?php
session_start();
if(!isset($_SESSION['matricule'])|| !isset($_SESSION['password']) ){
    header("location:login.php");exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    table {font-family:Georgia, serif;
            width: 150%;
			max-width: 1350px;
			color: #333;
			border: 1px solid #ccc;
			border-radius: 10px;
			box-shadow: 0 3px 3px rgba(0, 0, 0, 0.1);
			background-color: #fff;
			overflow: hidden;
            position:absolute;
            left:100px;
			top:160px;
		}
		table th, table td {
			padding: 8px;
			text-align: left;
			vertical-align: middle;
			border-top: 1px solid #ccc;
			border-bottom: 1px solid #ccc;
      font-size:15px;
		}
		table th {
			background-color: #f1f1f1;
			color: #666;
			text-transform: uppercase;
			letter-spacing: 1px;
			font-weight: 600;
			border-top: none;
		}
		table td {
			background-color: #fff;
			color: #333;
      font-weight:200px;
		}
		table tr:nth-child(even) td {
			background-color: #f9f9f9;
		}
		table tr:hover td {
			background-color: #f5f5f5;
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
.accept-btn {
  background-color: #3cb371;
  color: #fff;
  padding: 6px 12px;
  border-radius: 4px;
  text-decoration: none;
  border: none;
}

.reject-btn {
  background-color: #dc143c;
  color: #fff;
  padding: 6px 12px;
  border-radius: 4px;
  text-decoration: none;
  border: none;
}
header {
    text-align: center;
    margin-bottom: 20px;
    font-family:Georgia, serif;
  

}

header h6 {
    font-size: 28px;
    font-weight: bold;
    color: #333;
    margin: 0;
    color:#e0ac1c;
    
}

header span {
 
    color: #031b62;
}
	</style>

</head>
<body  style="background-color: #eaf0f2;font-family:Georgia, serif">
<?php
$title = "<header><h6><b>congés <span>Anciennes</span></b></h6></header>";
ob_start();
require_once "crudconge.php";
$crud = new crudconge();
$conges = $crud->findAllconges(); 
?>
<a href="pap.php" class="retour"><i class="fa fa-chevron-left"></i> Retour</a>  
<table>
  <thead>
    <tr>
        <th>Matrciule</th>
      <th>Nom</th>
      <th>Prénom</th>
      <th>Date début</th>
      <th>Date fin</th>
      <th>Raison</th>
      <th>Statut</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($conges as $conge) { ?>
    <tr>
    <?php
$id = $conge[0];
?>

    <td><?= $conge[1] ?></td>
      <td><?= $conge[2] ?></td>
      <td><?= $conge[3] ?></td>
      <td><?= $conge[4] ?></td>
      <td><?= $conge[5] ?></td>
      <td><?= $conge[6] ?></td>
      <td><?= $conge[7] ?></td>
      <td><a onclick="return confirm('Êtes-Vous Sûr De Vouloir supprimer!!')" class="icon" href="delete_conge.php?mat=<?php echo $conge[1]?>&id=<?php echo $conge[0]?>"><i class='fa fa-trash' style="color:#18022f"></i></a> 
      <a href="modifier_conge.php?id=<?= $conge[0] ?>">
      <i class='fa fa-pencil-square-o' style="color:#18022f"></i></a></td>
    </tr>
    <?php } ?>
 


<?php
        $container = ob_get_clean();
        include "layout.php";
        ?>
</body>
</html>
