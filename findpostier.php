<?php
session_start();
ob_start();
if(!isset($_SESSION['matricule'])|| !isset($_SESSION['password']) ){
    header("location:login.php");
    exit;
}
require_once "cruduser.php";
require_once "crudprimes_nuit.php";
$crudd = new crudprime();
$crud = new cruduser();

$mat = isset($_GET['mat']) ? $_GET['mat'] : ""; // Ajouter une vérification si $_GET['mat'] est défini
$user = $crud->findprime($mat); 
$primes = $crud->findAllprimemat($mat);
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <title>Document</title>
    <style>
        body{
            background-color: #eaf0f2;
            font-family: 'Poppins', sans-serif;
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
.input{width:70px;}
#input{position:absolute;
    top:200px;
    left:550px;
    width:170px;
    font-family:Georgia, serif;
}
#ok{position:absolute;
top:200px;
left:700px;
font-family:Georgia, serif;
}
.cherche{position:absolute;
left:700px;
top:-120px;}
.icon{color:#18022f;
font-size:15px;}
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
            /*width:2000px;*/
            width:1440px;;
			color: #333;
			border: 3px solid #ccc;
			border-radius: 10px;
			box-shadow: 0 3px 3px rgba(0, 0, 0, 0.1);
			background-color: #fff;
			overflow: hidden;
            position:absolute;
            left:25px;
        
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
			font-weight: 600px;
			border-top: none;
		}
		table td {
			background-color: #fff;
			color: #333;
      font-weight: 300;
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
   #valide {
  background-color:#18022f;
  color: #fff;
  border: none;
  padding: 10px 20px;
  border-radius: 10px;
  cursor: pointer;
  font-size: 16px;
    position:absolute;
    right:0px;
    top:250px;
 
}
.table2 {font-family:Georgia, serif;
            /*width:2000px;*/
            width:1440px;;
			color: #333;
			border: 3px solid #ccc;
			border-radius: 10px;
			box-shadow: 0 3px 3px rgba(0, 0, 0, 0.1);
			background-color: #fff;
			overflow: hidden;
            position:absolute;
            top:350px;
            left:25px;
            display:none;
        
		}
		.table2 th, table td {
			padding: 8px;
			text-align: left;
			vertical-align: middle;
			border-top: 3px solid #ccc;
			border-bottom: 1px solid #ccc;
      font-size:15px;
		}
		.table2 th {
			background-color: #f1f1f1;
			color: #666;
		
			letter-spacing: 1px;
			font-weight: 600px;
			border-top: none;
		}
		.table2 td {
			background-color: #fff;
			color: #333;
      font-weight: 300;
		}
		.table2 tr:nth-child(even) td {
			background-color: #f9f9f9;
		}
		.table2 tr:hover td {
			background-color: #f5f5f5;
		}

    .header2 h4 {
    color: #e0ac1c;
  
}

.header2 span {
    color: #031b62;

}
.header2{text-align:center;
    font-family:Georgia, serif;
    position:absolute;
    top:280px;
    left:670px;
    }
    .Affichage{position:absolute;
left:890px;
top:280px;}
    </style>



    
</head>
<body>


<?php
$title="<header><h4><b>Nouvel Calcul <span> De Prime</span></b></h4></header>";
?>
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="get" id="f">
</form>
        <a href="formulairefindp.php" class="retour"><i class="fa fa-chevron-left"></i> Retour</a>  
        <br><br><br><table>
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
            <th>Actions</th>
        </tr>  
</thead>
<tbody>
    <?php
        echo "<tr>";
        foreach ($user as $value){
            echo "<td>$value</td>";
           
        }
        ?>
<form method="post">
<input type="number" name="mat" class="input" id="mat" value="<?= $_GET['mat'] ?>" required hidden>
<td>
  <select class="input" name="m" id="m" required>
    <option value="" disabled selected>Mois</option>
    <option value="1">Janvier</option>
    <option value="2">Février</option>
    <option value="3">Mars</option>
    <option value="4">Avril</option>
    <option value="5">Mai</option>
    <option value="6">Juin</option>
    <option value="7">Juillet</option>
    <option value="8">Août</option>
    <option value="9">Septembre</option>
    <option value="10">Octobre</option>
    <option value="11">Novembre</option>
    <option value="12">Décembre</option>
  </select>
</td>
<td><input type="number" name="a" class="input" id="a" min="2020" required></td>
<td><input type="number" name="nh" class="input" id="nh" min="1" required></td>
<td><input type="number"  class="input"  name="b" id="b"  readonly ><button type="submit" value="calculer" name="calculer"><i class="fa fa-calculator" class="calcul"></i></button></td>
<td><input type="submit" value="Ajouter" name="add" class="button"></td>
</form>
<?php
if(isset($_POST['calculer'])){
  $mat=htmlspecialchars($_POST['mat']);
  $m=htmlspecialchars($_POST['m']);
  $a=htmlspecialchars($_POST['a']);
  $nh=htmlspecialchars($_POST['nh']);
  $b=$nh*7000;
  // Check if the prime exists for the given month and year
if($crudd->exists($mat, $m, $a)){
  echo "<script>alert('La prime a déjà été calculée pour le mois $m et l\'année $a');</script>";
}else{
  //affecte la valeur de la variable $m à l'attribut value de l'élément HTML avec l'ID "m"
  echo "<script>document.getElementById('mat').value = '$mat'; document.getElementById('mat').hidden = true;</script>";
  echo "<script>document.getElementById('m').value = '$m';</script>";
  echo "<script>document.getElementById('a').value = '$a';</script>";
  echo "<script>document.getElementById('nh').value = '$nh';</script>";
  echo "<script>document.getElementById('b').value = '$b';</script>";
}
}
if(isset($_POST['add'])){
  /*extrait la valeur du champ de formulaire avec le nom "mat". La fonction htmlspecialchars() est appliquée pour 
  sécuriser la valeur avant de la stocker dans la variable $mat.*/
    $mat=htmlspecialchars($_POST['mat']);
    $m=htmlspecialchars($_POST['m']);
    $a=htmlspecialchars($_POST['a']);
    $nh=htmlspecialchars($_POST['nh']);
    $b=htmlspecialchars($_POST['b']);

    // Vérifier si le prime existe pour le mois et l'année donnés
    if($crudd->exists($mat, $m, $a)){
        echo "<script>alert('La prime a déjà été calculée pour le mois $m et l\'année $a');</script>";
    }else{
        // ajouter prime
        $heure = new primes_nuit(
            $mat,
            $m,
            $a,
            $nh,
            $b
        );
        $crudd->add($heure);
        header("location:formulairefindp.php");
        echo '<script>alert("ajouter avec succes");</script>';
    }
}

?>

<!--<td><a onclick="return confirm('Êtes-Vous Sûr De Vouloir supprimer!!')" class="icon" href="deleteheures_nuit.php?mat=<?php echo $postier[0]?>"><i class='fa fa-trash'></i></a>
  </td>-->
</tr></tbody></table>
<header class="header2"><h4><b>Primes <span>Ancienne </span></b></h4></header>
<button onclick="toggleTable()" class="Affichage">
  <i class="bi bi-caret-down-fill"></i>
</button>
<script>
function toggleTable() {
  var table = document.querySelector(".table2");
  if (table.style.display === "none") {
    table.style.display = "table";
  } else {
    table.style.display = "none";
  }
}

</script> 
<form action="" method="post">
<table class="table2">
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
            <th>Actions</th>
        </tr>  
</thead>
        <tbody>
        <?php
        foreach ($primes as $prime) {
            echo "<tr>";
            foreach ($prime as $key => $value) {
                echo "<td>$value</td>";
            }
            ?>
  </td>
  <td><a onclick="return confirm('Êtes-Vous Sûr De Vouloir supprimer!!')" class="icon" href="deleteheures_nuit.php?mat=<?php echo $prime[1]?>&id=<?php echo $prime[0]?>"><i class='fa fa-trash' style="color:#18022f"></i></a> 
<?php            
echo "</tr>";
        }
        echo " </tbody></table></form>";
       ?>
<?php
 $container =ob_get_clean();
    include "layout.php";
    ?>
    
    
</body>
</html>



