<?php
session_start();
if(!isset($_SESSION['matricule'])|| !isset($_SESSION['password']) ){
    header("location:login.php");exit;
}
?>
<html>
<head>
<style>
</style>
<link rel="stylesheet" type="text/css" href="css/findall.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">


<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<style>
    .button {
  background-color:#18022f;
  color: white;
  border: none;
  border-radius: 5px;
  padding: 7px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.button:hover {
  background-color: #e0ac1c;
}
.icon{color:#18022f;
font-size:15px;}
body{font-family:Georgia, serif;
    background-color: #eaf0f2;
}
.cherche{position:absolute;
left:700px;
top:-120px;}
#input{position:absolute;
    top:121px;
    left:575px;
    width:170px;
    font-family:Georgia, serif;
}
#ok{position:absolute;
top:121px;
left:740px;
font-family:Georgia, serif;
background-color:#18022f;
  color: white;
  border: none;
  border-radius: 5px;
  padding: 7px;
  cursor: pointer;
  transition: background-color 0.3s ease;
  background-color:#18022f;
  background-color: #e0ac1c;
}
#ok:hover{background-color:#18022f;}
table {font-family:Georgia, serif;
			width:1500px;
			color: #333;
			border: 3px solid #ccc;
			border-radius: 10px;
			box-shadow: 0 3px 3px rgba(0, 0, 0, 0.1);
      display:none;
			background-color: #fff;
			overflow: hidden;
            position:absolute;
            left:20px;
		}
		table th, table td {
			padding: 8px;
			text-align: left;
			vertical-align: middle;
			border-top: 3px solid #ccc;
			border-bottom: 1px solid #ccc;
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
.Affichage{position:absolute;
left:4px;
top:45px;}
</style>
</head>
<body style="background-color: #eaf0f2">
<?php
$title ="";
ob_start();
require_once "crud.php";
$crud = new CRUD();
$postiers = $crud->findAllprime();
$s=$crud->somme();

?>
<button onclick="toggleTable()" class="Affichage">
  <i class="bi bi-caret-down-fill"></i>
</button>
<script>
function toggleTable() {
  var table = document.querySelector("table");
  if (table.style.display === "none") {
    table.style.display = "table";
  } else {
    table.style.display = "none";
  }
}
</script>

<form action="<?= $_SERVER['PHP_SELF'] ?>" method="get" id="f">
<div class="cherche">
        <input class="form-control" name="mat" id="input" type="number" placeholder="Entrer Matricule" >
        <input type="submit" value="Rechercher" name="ok"  id="ok"></div></form><br><br><br>
 
<?php
if(isset($_GET['ok'])){
  $mat=htmlspecialchars($_GET['mat']);
  //si matricule non vide 
  if(!empty($mat)){
      $postier = $crud->find($mat);
      //Si la méthode 'find' renvoie 'null',
      if ($postier == null) {
        echo "<div class='alert alert-info' style='background-color: #F8D7DA; color: #721C24; padding: 10px; font-weight: bold; border: 1px solid #F5C6CB; width:400px; height: 50px;position:absolute;top:75px;left:600px;text-align:center'>Matricule n'existe pas!!!</div>";
      } else {
          header("location:findpostier.php?mat=".$mat);
      }
  }
}

?>
<a href="accueilRRh.php" class="retour"><i class="fa fa-chevron-left"></i> Retour</a>  
<form action="" method="post" enctype="multipart/form-data">
  <br><br>
<table id="employes">
<thead >
        <tr>
       
            <th>Matricule</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th >Grade</th>
            <th>Direction</th>
            <th>Mois</th>
            <th>Année</th>
            <th>Nbrs_Heures</th>
            <th>Brut</th>
          
        </tr>  
</thead>
        <tbody>
        <?php
        foreach ($postiers as $postier) {
            echo "<tr>";
            foreach ($postier as $key => $value) {
                echo "<td>$value</td>";
            }
            ?>
  </td>
<?php            
echo "</tr>";
        }
        echo " </tbody></table></form>";
       ?>
       <?php
        $container = ob_get_clean();
        include "layout.php";
        ?>
        </body>
        </html>







