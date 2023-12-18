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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <title>Document</title>
        <style>
    table {font-family:Georgia, serif;
            width:1200px;

			color: #333;
			border: 1px solid #ccc;
			border-radius: 10px;
			box-shadow: 0 3px 3px rgba(0, 0, 0, 0.1);
			background-color: #fff;
			overflow: hidden;
            position:absolute;
            left:80px;
			top:800px;
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
			/*text-transform: uppercase;*/
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
		header h4{
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
.cherche{position:absolute;
left:700px;
top:-120px;}
#input{position:absolute;
    top:120px;
    left:580px;
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

	</style>

</head>
<body style="background-color: #eaf0f2">

    <?php

$title="<header><h4><b>Liste Des <span>Demande de Congés</b></span></h4></header>";

require_once "connexion.php";
$cnx = new cnx();
$dbh = $cnx->getConnexion();

// Vérifier si les variables 'id_conge' et 'action' existent dans la chaîne de requête (query string)
if(isset($_GET['id_conge']) && isset($_GET['action'])){
    // Récupérer la valeur de 'id_conge' et 'action' et les assigner à des variables locales
    $id_conge = $_GET['id_conge'];
    $action = $_GET['action'];
    
    // Vérifier si 'action' est égal à 'accepter'
    if($action == 'accepter'){
        // Préparer la requête SQL pour mettre à jour le statut du congé sélectionné
        $stmt = $dbh->prepare("
        UPDATE conges
        SET statut = \'accepté\'
        WHERE id_conge = :id_conge
        ");
   
        // Lier le paramètre 'id_conge' à la variable locale correspondante
        $stmt->bindParam(':id_conge', $id_conge);
        // Exécuter la requête préparée
        $stmt->execute();
    }
    // Vérifier si 'action' est égal à 'refuser'
    elseif($action == 'refuser'){
        // Préparer la requête SQL pour mettre à jour le statut du congé sélectionné
        $stmt = $dbh->prepare("
        UPDATE conges
        SET statut = '\refusé\'
        WHERE id_conge = :id_conge
        ");
        // Lier le paramètre 'id_conge' à la variable locale correspondante
        $stmt->bindParam(':id_conge', $id_conge);
        // Exécuter la requête préparée
        $stmt->execute();
    }
}

// Préparer la requête SQL pour récupérer toutes les demandes de congé avec des informations sur l'utilisateur associé
$stmt = $dbh->prepare("
SELECT c.id_conge, u.matricule, u.nom, u.prenom, u.grade, u.direction, c.date_debut,c.date_fin, c.raison,c.nb_conges_max, c.statut
FROM conges c
JOIN user u ON c.matricule = u.matricule
");
// Exécuter la requête préparée
$stmt->execute();
// Récupérer toutes les lignes de résultats de la requête sous forme d'array associatif
$demandes_conge = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Commencer le buffer de sortie pour stocker le contenu HTML généré
ob_start();
?>
<?php
// Afficher le tableau HTML pour afficher toutes les demandes de congé
echo "<table style='position:absolute;top:200px;left:20px;width:1500px;font-family:Georgia, serif'>";
echo "<tr>
<th>Matricule</th>
<th>Nom</th><th>Prénom</th>
<th>Grade</th>
<th>Direction</th>
<th>Date de début</th>
<th>Date de fin</th>
<th>Raison</th>
<th>Jours restantes</th>
<th>Actions</th>
<th>Statut</th>
</tr>";
foreach ($demandes_conge as $demande) {
    echo "<tr style='font-weight:300px'>";
    $tdCode = "<td>" . $demande['id_conge'] . "</td>";
    echo "<td>" . $demande['matricule'] . "</td>";
    echo "<td>" . $demande['nom'] . "</td>";
    echo "<td>" . $demande['prenom'] . "</td>";
    echo "<td>" . $demande['grade'] . "</td>";
    echo "<td>" . $demande['direction'] . "</td>";
    echo "<td>" . $demande['date_debut'] . "</td>";
    echo "<td>" . $demande['date_fin'] . "</td>";
    echo "<td>" . $demande['raison'] . "</td>";
    echo "<td>" . $demande['nb_conges_max'] . "</td>";
    echo "<td><form method=\"post\"><input type=\"hidden\" name=\"id_conge\" value=\"" . $demande['id_conge'] . "\">
    <button class=\"accept-btn\" name=\"accepter\"  onclick=\"return confirm('Êtes-vous sûr de vouloir accepter cette demande de congé ?')\">
    <i class=\"fa fa-check\"></i> Accepter

    <button class=\"reject-btn\" name=\"refuser\"  onclick=\"return confirm('Êtes-vous sûr de vouloir réfuser cette demande de congé ?')\">
    <i class=\"fa fa-times\"></i>Refuser/

     
     
     
     </form>
     </td>";
    if(isset($_POST["accepter"]) && $_POST["id_conge"] == $demande['id_conge']){
        $stmt = $dbh->prepare("
            UPDATE conges SET statut='Accepté' WHERE id_conge=:id_conge
        ");
        $stmt->bindParam(':id_conge', $_POST["id_conge"]);
        if($stmt->execute()){
            echo "<td>Accepté</td>";
        }
        else{
            echo "<td>En attente</td>";
        }
    }
    elseif(isset($_POST["refuser"]) && $_POST["id_conge"] == $demande['id_conge']){
        $stmt = $dbh->prepare("
            UPDATE conges SET statut='Refusé' WHERE id_conge=:id_conge
        ");
        $stmt->bindParam(':id_conge', $_POST["id_conge"]);
        if($stmt->execute()){
            echo "<td>Refusé</td>";
        }
        else{
            echo "<td>En attente</td>";
        }
    }
    else{
        echo "<td>" . $demande['statut'] . "</td>";
    }
    echo "</tr>";
}
echo "</table>";
?>
<form action="" method="post"></form>
<div class="cherche">
        <input class="form-control" name="mat" id="input" type="number" placeholder="Entrer Matricule" >
        <input type="submit" value="Rechercher" name="ok"  id="ok"></div></form>

        <?php
        if(isset($_GET['ok'])){

// Récupération de la valeur entrée dans le champ d'entrée de matricule en utilisant la fonction htmlspecialchars pour empêcher les attaques XSS
$mat=htmlspecialchars($_GET['mat']);

// Vérification si le champ matricule n'est pas vide
if(!empty($mat)){

    // Appel de la fonction find du CRUD en utilisant la valeur de matricule comme argument
    $user = $crud->finddconge($mat);

    // Si la fonction find ne renvoie aucun résultat, afficher un message d'alerte
    if ($user == null) {
        echo "<script>alert('Matricule Introuvable!!!');</script>";
    } 
    // Si la fonction find renvoie un résultat, rediriger vers la page trouvercongéparmatricule.php en incluant la valeur de matricule dans l'URL
    else {
        header("location:trouvercongéparmatricule.php?mat=".$mat);
    }
}
}
?>
<?php
$container = ob_get_clean();
include "layout.php";
echo "<a href='accueilRRh.php' class='retour'><i class='fa fa-chevron-left'></i> Retour</a>";

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
</body></html>