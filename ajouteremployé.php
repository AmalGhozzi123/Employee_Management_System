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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {
    background-color: #f2f2f2;
    font-family:Georgia, serif;
}
.container {
			display: flex;
			flex-wrap: wrap;
            position:absolute;
            top:80px;
		}


		label {
			display: block;
			margin-bottom: 5px;
			font-weight: bold;
      font-family:Georgia, serif;
		}

		input[type=text], input[type=number], select{
			width:500px;;
			padding: 10px;
			margin-bottom: 10px;
			border-radius: 5px;
			border: none;
			box-shadow: 1px 1px 5px rgba(0,0,0,0.2);
			font-size: 16px;
		}
.button {
  background-color:#18022f;
  color: white;
  width: 70%;
  padding: 10px;
  margin-bottom: 20px;
  border: none;
  border-radius: 5px;
  box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
  transition: background-color 0.3s ease;
  position:absolute;
top:370px;
  left:-280px;
  font-family:Georgia, serif;
}

.button:hover {
  background-color: #e0ac1c;
}
header {
    text-align: center;
    margin-bottom: 20px;
    font-family:Georgia, serif;
    position:absolute;
    left:610px;
    top:-30px;

}

header h2 {
    font-size: 28px;
    font-weight: bold;
    color: #333;
    margin: 0;
    color:#e0ac1c;
    
}

header span {
    font-size: 16px;
    font-weight: normal;
    color: #031b62;
}


select{ appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'%3E%3Cpath fill='%23888' d='M7 10l5 5 5-5z'/%3E%3C/svg%3E");
    background-position: right center;
    background-repeat: no-repeat;


}
    .retour {
  display: inline-block;
  padding: 10px 10px;
  background-color:#18022f ;
  color: green;
  font-size: 12px;
  text-decoration: none;
  border-radius: 7px;
  transition: background-color 0.3s ease;
  position:absolute;
  top:70px;
  left:30px;
}

.retour i {
  margin-right: 10px;
}

.retour:hover {
  background-color:#e0ac1c ;
}
.div1{position:absolute;
left:140px;
top:-110px;
font-family:Georgia, serif;}
.div2{position:absolute;
right:10px;
top:-20px;
font-family:Georgia, serif;
}
.alert{position:absolute;
bottom:400px;
left:-260px;
text-align:center;}
footer {
  background-color: #18022f;
  width: 100%;
  height: 70px;
  position: fixed;
  bottom: 0;
  left: 0;
}

      .fond-jaune {
        background-color:#f7c12b;
        width:170px;
        height: 12px;
        position:absolute;
        bottom:59px;
        left:0px;
      }
      .fond-jjaune {
        background-color:#f7c12b;
        width:1270px;
        height: 12px;
        position:absolute;
        bottom:59px;
        right:0px;
      }
      .img{height:110px;
      width:110px;position:absolute;top:-50px;left:160px;}
</style>
</head>
<body  style="background-color: #eaf0f2">
<?php
ob_start();
require_once "cruduser.php";
$crud = new cruduser();
$title = "<header><h2><b>Ajouter<span><b> Un Nouvel Employé</b></span></b></h2></header><br>";

?>
<a href="findallpostier.php" class="retour"><i class="fa fa-chevron-left"></i> Retour</a>  
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" id="f" >
<div class="container">
        <div class="div1"><br><br><br><br>
        <label for="mat">Matricule : </label><input class="form-control"  type="number" name="m" placeholder="*Entrer Matricule" >
        <label for="mat">Nom : </label><input class="form-control" type="text" name="n" required placeholder="*Entrer Nom de famille">
        <label for="mat">Prénom : </label><input class="form-control" type="text" name="p" required placeholder="*Entrer Prénom">
        <label for="mat">Numéro téléphone : </label><input class="form-control" type="tel" name="tel"  required style="width:500px;padding: 10px;margin-bottom: 10px;border-radius: 5pxborder: none;box-shadow: 1px 1px 5px rgba(0,0,0,0.2);font-size: 16px" placeholder="*Numéro de téléphone">
        
</div>
<div class="div2">
<label for="mat">Date début d'embauchement : </label><input class="form-control" type="date" name="ddt" required placeholder="Sélectionnez une date" style="width:500px;padding: 10px;margin-bottom: 10px;border-radius: 5px;border: none;box-shadow: 1px 1px 5px rgba(0,0,0,0.2);font-size: 16px">
    <input type="submit"  onclick="return confirm('Êtes-Vous Sûr De Vouloir Ajouter!!')" value="Ajouter" name="ok" class="button">
<label for="mat">Direction: </label>
<select name="d" id="g"  class="form-control" required style="width:500px;padding: 10px;margin-bottom: 10px;border-radius: 5pxborder: none;box-shadow: 1px 1px 5px rgba(0,0,0,0.2);font-size: 16px;font-family:Georgia, serif;" placeholder="*Sélectionnez La Grade">
<option value="">*Sélectionnez La Direction</option>
 <option value="Direction centrale des produits postaux">Direction centrale des produits postaux</option>
<option value="Direction centrale des affaires financières">Direction centrale des affaires financières</option>
<option value="Direction centrale des produits financiers">Direction centrale des produits financiers</option>
<option value="Direction centrale du patrimoine">Direction centrale du patrimoine</option>
<option value="Adjoint administratif">Agent de métier</option></select>
<label for="mat">Grade : </label><select name="g" id="d" class="form-control" required style="width:500px;padding: 10px;margin-bottom: 10px;border-radius: 5pxborder: none;box-shadow: 1px 1px 5px rgba(0,0,0,0.2);font-size: 16px"  placeholder="*Sélectionnez La Direction">
<option value="Agent non qualifié 1ère cie">Agent non qualifié 1ère cie</option>
<option value="Responsable RH">Responsable RH</option>
<option value="Agent non qualifié 2ème cie">Agent non qualifié 2ème cie</option>
<option value="Agent non qualifié 3ème cie">Agent non qualifié 3ème cie</option>
<option value="Agent d'Acceuil">Agent d'Acceuil</option>
<option value="Agent de métier">Agent de métier</option>
<option value="Agent des postes">Agent des postes</option>
<option value="Agent  de guichet">Agent  de guichet</option>
<option value="Agent de Distribution">Agent de Distribution</option>
<option value="Agent Administratif Adjoint">Agent Administratif Adjoint</option>
<option value="Agent technique">Agent technique</option>
<option value="Agent qualifié 1er degré">Agent qualifié 1er degré</option>
<option value="Agent Administratif">Agent Administratif</option>
<option value="Agent Bureautique">Agent Bureautique</option>
<option value="Agent PrincipaL des postes">Agent PrincipaL des postes</option>
<option value="Agent PrincipaL de guichet">Agent PrincipaL de guichet</option>
<option value="Agent de Comptabilité">Agent de Comptabilité</option>
<option value="Agent financier">Agent financier</option>
<option value="Agent Commercial">Agent Commercial</option>
<option value="Technicien Adjoint">Technicien Adjoint</option>
<option value="Technicien de Laboratoire Informatique">Technicien de Laboratoire Informatique</option>
<option value="Agent qualifié 2ème degré">Agent qualifié 2ème degré</option>
<option value="Gestionnaire Adjoint">Gestionnaire Adjoint</option></select>
<label for="mat">Salaire : </label><input class="form-control" type="number" name="s" required style="width:500px;padding: 10px;margin-bottom: 10px;border-radius: 5pxborder: none;box-shadow: 1px 1px 5px rgba(0,0,0,0.2);font-size: 16px" placeholder="*Salaire">

   <div><div>
</form>
<footer style="background-color:#18022f">
      <img src="images/hhh.jpg" class="img" >
      <div class="fond-jaune"></div>
      <div class="fond-jjaune"></div>
    </footer> 
<?php
if (isset($_POST['ok'])) {
  // récupérer les données du formulaire
  $matricule = htmlspecialchars($_POST['m']);
  $nom = htmlspecialchars($_POST['n']);
  $prenom = htmlspecialchars($_POST['p']);
  $grade = htmlspecialchars($_POST['g']);
  $direction = htmlspecialchars($_POST['d']);
  $dateEmbauche = htmlspecialchars($_POST['ddt']);
  $tel = htmlspecialchars($_POST['tel']);
  $salaire = htmlspecialchars($_POST['s']);

  // vérifier si le matricule existe déjà
  $existePostier = $crud->find($matricule);
  if ($existePostier) {
      // afficher un message d'erreur et empêcher l'ajout
      echo "<div id='alerte' class='alert alert-danger' role='alert'>
      <b>Matricule déjà existant</b>
      <svg  id='fermer' xmlns='http://www.w3.org/2000/svg' width='16' height='16'>
      <path d='M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z'/>
    </svg>
       </div>
       <script>
       document.getElementById('fermer').addEventListener('click', function() {
           // Récupération de l'élément contenant l'alerte
           var element = document.getElementById('alerte');
           // Suppression de l'élément de la page
           element.parentNode.removeChild(element);
       });
   </script>";
  } else {
      // créer un nouveau postier et l'ajouter à la base de données
      $user= new user(
          $matricule,
          $nom,
          $prenom,
          $grade,
          $direction,
          $dateEmbauche,
          $tel,
          $salaire
      );
      $crud->add($user);
      header("location:findAllpostier.php");
  }
}
$container = ob_get_clean();
include "layout2.php";

?>



