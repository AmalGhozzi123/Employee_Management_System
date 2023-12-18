<?php
session_start();
if(!isset($_SESSION['matricule'])|| !isset($_SESSION['password']) ){
    header("location:login.php");exit;
}
if(isset($_SESSION['nom']) && isset($_SESSION['prenom'])) {
	$nom = $_SESSION['nom'];
	$prenom = $_SESSION['prenom'];
	if(!isset($_SESSION['message_affiche'])) {
	  echo "<script>alert('Bienvenue $prenom $nom');</script>";
	  $_SESSION['message_affiche'] = true;
	}
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
	padding: 10px;
	position:absolute;
	top:100px;
	left:40px;
}

.box {
	width: 230px;
	height: 230px;
	margin: 20px;
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

/* Ajout de styles pour les liens */
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


    </style>
</head>
<body  style="background-color: #eaf0f2">
<?php
 
$title="";
    ?>

	<?php if(isset($_SESSION['nom'])) { ?>
		<!--<p class="info">Bienvenue <?php echo $_SESSION['prenom']." ".$_SESSION['nom']; ?><br>-->
		<!--Votre numéro d'enregistrement est : <?php echo $_SESSION['matricule']; ?><br> 
		Votre grade est : <?php echo $_SESSION['grade']; ?></p>-->
	<?php } ?>
	<br><br><br>
<section class="container" >
		<a href="profil.php" class="box" style="background-image: url('images/pppp.png')">
			<div class="content">
				<h2><b>Consulter Profil</b></h2>
			</div>
		</a>
		<a href="demande_conge.php" class="box" style="background-image: url('images/CC.png')">
			<div class="content">
				<h2><b>Demande Congé</b></h2>
			
			</div>
		</a>
		<a href="congepre.php" class="box" style="background-image: url('images/ccc.jpg')">
			<div class="content">
				<h2><b>Précédent Congés</b></h2>
			
			</div>
			</a>
			<a href="primeemployé.php" class="box" style="background-image: url('images/prime.jpg')">
			<div class="content">
				<h2><b>Consulter Primes</b></h2>
			
			</div>
			</a>
		</a>
	</section>


	<script src="script.js"></script>
    <?php
    $container = ob_get_clean();
    include "button.php";
    ?>  
</body>
</html>