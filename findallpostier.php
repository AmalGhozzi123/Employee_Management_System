<?php
session_start();
if(!isset($_SESSION['matricule'])|| !isset($_SESSION['password']) ){
    header("location:login.php");exit;
}
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/findall.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

<style>
.icon{color:#18022f;
font-size:15px;}
body {
    font-family: Georgia, serif;
background-color: #eaf0f2;;
}
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
.lien{ background-color:#18022f;
  color: white;
  border: none;
  border-radius:10px;
  padding:6px;
  cursor: pointer;
  text-decoration:none;
  transition: background-color 0.3s ease;
  font-family: Georgia, serif;
position:absolute;
left:5px;
font-size:10px;}
#i{position: absolute;
top:10px;
left:10px;
color:white;}
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
            width: 175%;
			max-width: 1500px;
			color: #333;
			border: 1px solid #ccc;
			border-radius: 10px;
			box-shadow: 0 3px 3px rgba(0, 0, 0, 0.1);
			background-color: #fff;
			overflow: hidden;
            position:absolute;
            left:20px;
            display:none;
		}
		table th, table td {
			padding: 8px;
			text-align: left;
			vertical-align: middle;
			border-top: 3px solid #ccc;
			border-bottom: 1px solid #ccc;
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

#nombreusers {
  color: #fff; 
    font-size: 14px; 
    font-family:Georgia, serif;
    background-color: #18022f; 
    padding: 8px;
    border-radius: 10px;
    box-shadow: 3px 3px 3px #999; 
    position:absolute;
left:700px;
top:110px;

  }
 #plus{font-size:12px;}
 .Affichage{position:absolute;
left:4px;
top:45px;}
</style>
</head>
<body  style="background-color: #eaf0f2">
<?php
$title ="<header><h4><b>Liste <span>Des Employés</span></b></h4></header>";
ob_start();
require_once "cruduser.php";
$crud = new cruduser();
$users = $crud->findAll();
$nbusers = $crud->somme()[0];//retourne un tableau contenant une seule valeur, et que cette valeur est récupérée en utilisant l'indice 0.

echo "<b id='nombreusers'>Nombre_Total : " . $nbusers."</b><br><br>";
?>
<a href="accueilRRh.php" class="retour"><i class="fa fa-chevron-left"></i> Retour</a> 
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
        <input type="submit" value="Rechercher" name="ok"  id="ok"></div></form>

        <?php
if(isset($_GET['ok'])){
  $mat=htmlspecialchars($_GET['mat']);
  //si matricule non vide 
  if(!empty($mat)){
      $user = $crud->find($mat);
      //Si la méthode 'find' renvoie 'null',
      if ($user == null) {
        echo "<div  id='alerte'  class='alert alert-info' style='background-color: #F8D7DA; color: #721C24; padding: 10px; font-weight: bold; border: 1px solid #F5C6CB; width:400px; height: 50px;position:absolute;left:600px;text-align:center'>Matricule Introuvable!!!
        <svg  id='fermer' xmlns='http://www.w3.org/2000/svg' width='16' height='16'>
        <path d='M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z'/>
      </svg></div>";
      
      } else {
          header("location:trouver.php?mat=".$mat);
      }
  }
}

?>
<script>
    document.getElementById("fermer").addEventListener("click", function() {
        // Récupération de l'élément contenant l'alerte
        var element = document.getElementById("alerte");
        // Suppression de l'élément de la page
        element.parentNode.removeChild(element);
    });
</script>
    
<form action="" method="post" enctype="multipart/form-data">
<table>
<thead >
        <tr>
            <th>Matricule</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th >Grade</th>
            <th >Direction</th>
            <th>DDE</th>
            <th>Tel</th>
            <th>Salaire</th>
        </tr>  
</thead>
<a href="ajouteremployé.php" class="lien"><b><h6>Ajouter Nouvel Postier <i class="fa fa-plus" id="plus"></i></h6></b></a><br><br><br>

        <tbody>
        <?php
        foreach ($users as $user) {
            echo "<tr>";
            foreach ($user as $key => $value) {
                echo "<td>$value</td>";
            }
            ?>
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
