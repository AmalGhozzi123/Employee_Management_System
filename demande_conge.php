<?php
session_start();
if(!isset($_SESSION['matricule'])|| !isset($_SESSION['password']) ){
    header("location:login.php");exit;
}
?>

<?php
// Fonction de validation des entrées utilisateur
$title="";
function validate_input($input) {
  $input = trim($input);
  $input = stripslashes($input);
  $input = htmlspecialchars($input);
  return $input;
}


try {
    $dbh = new PDO('mysql:host=localhost;dbname=gestion_poste', 'root', '');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}

// Vérification de l'existence du matricule dans la table 'postier'

// Vérification de l'existence du matricule dans la table 'postier'
if(isset($_POST['matricule'])) {//vérifie si une variable POST appelée "matricule" est définie
    $matricule = validate_input($_POST['matricule']);
    /*récupère la valeur de "matricule" et la passe en paramètre à
     une fonction validate_input pour la sécuriser contre les injections de code malveillant*/
    $stmt = $dbh->prepare("SELECT user.nom, user.prenom,conges.nb_conges_max FROM conges,user WHERE user.matricule=conges.matricule And user.matricule = :matricule");
    $stmt->bindParam(':matricule', $matricule);
    //:matricule à la valeur de la variable $matricule
    $stmt->execute();
    
    $postier = $stmt->fetch();
    /*récupère la première ligne de résultat retournée par la requête SQL
     avec la méthode fetch() et stocke les valeurs dans un tableau associatif appelé $postier.*/ 
    $nb_conges = 0;
    /* initialise une variable $nb_conges à zéro pour compter le nombre de jours de congé déjà pris*/ 
   // Update the initial value of "nb_conges_max" to 50 when inserting a new employee in the table 'conges'
   if ($postier && isset($_POST['date_debut']) && isset($_POST['date_fin']) && isset($_POST['raison'])) {
    /*érifie si toutes les valeurs nécessaires pour l'insertion d'une nouvelle demande de congé 
    sont définies (date_debut, date_fin et raison) et si l'employé a encore des jours de congé disponibles ($postier n'est pas null). */
    $date_debut = validate_input($_POST['date_debut']);
    $date_fin = validate_input($_POST['date_fin']);
    $raison = validate_input($_POST['raison']);
    /*récupère les valeurs de date_debut, date_fin et raison soumises via le formulaire et les sécurise à l'aide de la fonction "validate_input */
    $stmt = $dbh->prepare("INSERT INTO conges (matricule, date_debut, date_fin, raison, nb_conges_max) VALUES (:matricule, :date_debut, :date_fin, :raison, :nb_conges_max)");
    /*insérer la nouvelle demande de congé dans la table "conges".*/
    $nb_conges_max = $postier['nb_conges_max'];
    $stmt->bindParam(':matricule', $matricule);
    $stmt->bindParam(':date_debut', $date_debut);
    $stmt->bindParam(':date_fin', $date_fin);
    $stmt->bindParam(':raison', $raison);
    $stmt->bindParam(':nb_conges_max', $nb_conges_max); // Bind the initial value of "nb_conges_max"
    $stmt->execute();
    $nb_conges++;
    $nb_conges_restants = $nb_conges_max - $nb_conges;
    $stmt = $dbh->prepare("UPDATE conges SET nb_conges_max = :nb_conges_restants WHERE matricule = :matricule");
    $stmt->bindParam(':matricule', $matricule);
    $stmt->bindParam(':nb_conges_restants', $nb_conges_restants);
    $stmt->execute();
    $message = "La demande de congé a été enregistrée pour " . $postier['nom'] . " " . $postier['prenom'] . ". Il vous reste " . $nb_conges_restants . " jours(s)";
  } else {
    echo "<script>alert('Vous avez atteint votre maximum des jours');</script>";
}
}

/*$req = $dbh->prepare("SELECT notifications FROM conges WHERE matricule = ?");
$req->execute(array($_SESSION['matricule']));
$donnees = $req->fetch();

if ($donnees !== false) {
    $notifications = $donnees['notifications'] + 1;
    $req = $dbh->prepare("UPDATE conges SET notifications = ? WHERE matricule = ?");
    $req->execute(array($notifications, $_SESSION['matricule']));
} else {
    // handle the error here
}*/
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Demande de congé</title>
    <style>
      body {
			background-color: #f5f5f5;
			font-size: 14px;
			line-height: 1.5;
			margin: 0;
			padding: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #eaf0f2;
		}


		form {
			background-color: #fff;
			border: 1px solid #ccc;
			border-radius: 5px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
			margin: 30px auto;
			max-width: 500px;
			padding: 30px;
            height: 500px;
		}

		label {
			display: block;
			margin-bottom: 10px;
		}

		input[type="text"],
		input[type="date"],
		select {
			border: 1px solid #ccc;
			border-radius: 4px;
			box-sizing: border-box;
			margin-bottom: 20px;
			padding: 10px;
			width: 100%;
		}



        input[type="text"],
        input[type="date"],
        select {
            border: 1px solid #ccc;
            border-radius: 5px;
        font-size: 16px;
        margin-bottom: 20px;
        padding: 10px;
        width: 100%;
        box-sizing: border-box;
    }

    .button {
  background-color:#18022f  ;
  color: white;
  border: none;
  border-radius: 5px;
  padding: 10px;
  width:300px;
  cursor: pointer;
  transition: background-color 0.3s ease;
  position:absolute;
  left:600px;
  top:540px;
}

.button:hover {
  background-color: #e0ac1c;
}
        header h4 {
    color: #e0ac1c;
  
}

header span {
    color: #031b62;

}
header{text-align:center;
    font-family:Georgia, serif;
	position:absolute;
	top:50px;
	left:600px;

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
  top:-3px;
  left:0px;
}

.retour i {
  margin-right: 10px;
}

.retour:hover {
  background-color:#e0ac1c ;
}

</style>
</head>
<body>

<a href="Accueilemployé.php" class="retour"><i class="fa fa-chevron-left"></i> Retour</a>
<?php if(isset($message)) { ?>
    <script>
        alert("<?php echo $message; ?>");
    </script>
<?php } ?>


<?php
$title="<br><header><h4><b>Formulaire <span>Demande de </span>congé</b></h4></header>";
?>
    <form method="POST" action="" style="font-family:Georgia, serif">
        <label for="matricule">Matricule :</label>
        <input type="text" id="matricule" name="matricule" placeholder="--Entrer votre Matricule--" required>
        <label for="date_debut">Date de début :</label>
    <input type="date" id="date_debut" name="date_debut" required>

    <label for="date_fin">Date de fin :</label>
    <input type="date" id="date_fin" name="date_fin" required>

    <label for="raison">Raison :</label>
    <select id="raison" name="raison" required>
        <option value="">-- Sélectionner une raison --</option>
        <option value="Vacances">Congé annuel</option>
        <option value="Congé de maladie">Congé de maladie</option>
        <option value="Congé pour événement familial ">Congé pour événement familial </option>
        <option value=" Congé de maternité"> Congé de maternité </option>
        <option value="Congé de paternité">Congé de paternité</option>
        <option value="Congé sabbatique">Congé sabbatique</option>
        <option value="Autre">Autre</option>
    </select>
    <input type="submit" value="Envoyer" class="button">
    </form>
    <?php
    $container = ob_get_clean();
    include "layout.php";
    ?>

</body>
</html>
















