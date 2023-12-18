
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" type="text/css" href="css/k.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>

h3 {
            text-align: center;
            position: absolute;
            top: 45px;
            left: 580px;
			
        }
img{
            height:100px;
            width: 100px;
            border-radius:20px;
        }
.affiche{   position:absolute;
            left:340px;
            bottom:320px;}
.cherche{   position:absolute;
            bottom:320px;
            right:360px;}

.footer {
            text-align: center;
			position:absolute;
			top:5px;

    
}

.footer h2 {
            color: #e0ac1c;
  
}

.footer span {
            color: #031b62;

}
.heure {
            text-align: center;
            font-size: 15px;
            color: #333;
            position:absolute;
            right:20px;
            top:290px;
            }
.conges{position:absolute;
            left:730px;
            bottom:320px}
            
header {
	background-color: #232d4b;
	color: #fff;
	padding: 20px;
	text-align: center;
}

.container {
	display: flex;
	flex-wrap: wrap;
	justify-content: center;
	align-items: center;
	padding:10px;
	position:absolute;
	left:70px;
	top:100px;

}

.box {
	width: 230px;
	height: 230px;
	margin: 17px;
	background-color: #fff;
	background-size: cover;
	background-position: center;
	border: 5px solid #18022f;
	display: flex;
	flex-direction: column;
	justify-content: space-between;
	overflow: hidden;
	position: relative;
	cursor: pointer;
	transition: transform 0.3s ease;
	border-radius:15px;
}

.box:hover {
	transform: scale(1.05);
}

.box .content {
	padding: 20px;
	text-align: center;
	color: #333;
	background-color: rgba(255, 255, 255, 0.8);
}

.box h2 {
	font-size: 18px;
	margin-bottom: 10px;
}

.box p {
	font-size: 16px;
	line-height: 1.5;
	margin-bottom: 0;
}

.box a {
	display: block;
	width: 300px;
	height: 300px;
	text-decoration: none;
	color: inherit;
}


footer {
	background-color: #232d4b;
	color: #fff;
	padding: 20px;
	text-align: center;
}
.info {
			font-size: 18px;
			color: #4d4d4d;
			text-align: center;
			font-family:Georgia, serif;
		}
#aaa{position:absolute;
left:5px;
top:10px;}

#bell{position:absolute;
top:-80px;
color:white;
font-size:16px;
right:-70px;}
.badge-primary{position:absolute;
right:-85px;
top:-95px;
color:red;}
 </style>
</head>
<body style="background-color: #eaf0f2;font-family:Georgia, serif">
<?php
$title="";
 ?>
 <?php
session_start(); // démarrage de la session pour récupérer les variables de session
// Vérification que les variables de session existent, sinon redirection vers la page de connexion
if(!isset($_SESSION['matricule'])|| !isset($_SESSION['pw']) ){
    header("location:login.php");exit;
}
try {
    $bdd = new PDO('mysql:host=localhost;dbname=gestion_poste', 'root', '');
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}

// récupère le nombre de notifications actuel de l'admin depuis la table conges
$req = $bdd->prepare("SELECT notifications FROM conges WHERE matricule = ?");
$req->execute(array($_SESSION['matricule']));
$donnees = $req->fetch();

// Vérifie si les variables de session 'nom' et 'prenom' existent
if(isset($_SESSION['nom']) && isset($_SESSION['prenom'])) {
	
	// Stocke les valeurs des variables de session 'nom' et 'prenom' dans des variables plus courtes
	$nom = $_SESSION['nom'];
	$prenom = $_SESSION['prenom'];
	
	// Vérifie si la variable de session 'message_affiche' n'existe pas
	if(!isset($_SESSION['message_affiche'])) {
		
		// Affiche un message de bienvenue avec le nom et le prénom de l'utilisateur
		echo "<script>alert('Bienvenue $prenom $nom');</script>";
		
		// Définit la variable de session 'message_affiche' comme vraie pour ne plus afficher le message de bienvenue
		$_SESSION['message_affiche'] = true;
	}
}

// Affiche l'icône de notification avec le nombre actuel de notifications
echo "<i class='fa fa-bell' id='bell'></i><span class='badge badge-primary'>".$donnees['notifications']."</span>";



?>
      

    <section class="container">
	<a href="profiladmin.php" class="box" style="background-image: url('images/pppp.png')">
			<div class="content">
				<h2><b>Consulter Profil</b></h2>
			</div>
		</a>
		<a href="findallpostier.php" class="box" style="background-image: url('images/ge.png')">
			<div class="content">
				<h2><b>Gestion Employés</b></h2>
			</div>
		</a>
		<a href="formulairefindp.php" class="box" style="background-image: url('images/nuit.jpg')">
			<div class="content">
				<h2><b>Gestion Primes De Nuit</b></h2>
			</div>
		</a>
		<a href="admincongés.php" class="box" style="background-image: url('images/conge.png')">
			<div class="content">
				<h2><b>Gestion Congés</b></h2>
			</div>
		</a>
	</section>
</div>
</body>
</html>
	
<?php
    $container = ob_get_clean();
    include "button.php";
    ?>

