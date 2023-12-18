<?php
session_start();
if(!isset($_SESSION['matricule'])|| !isset($_SESSION['password']) ){
    header("location:login.php");exit;
}
?>
<?php
require_once 'crud.php';

// récupérer le matricule du postier depuis la session
$matricule = $_SESSION['matricule'];

// créer une instance de la classe Postier
$postier = new CRUD();

// récupérer les informations du postier avec la fonction find()
$info_postier = $postier->find($matricule);

// afficher les informations du postier
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 0;
        }
        
        .header {

            color: blue;
            text-align: center;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        
        .avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background-color: #f1f1f1;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 17px;
        }
        
        .avatar img {
            max-width: 100%;
            max-height: 100%;
            border-radius: 50%;
        }
        
        .name {
            font-size: 24px;
            font-weight: bold;
            margin-bottom:-5px;
        }
        
        .info {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            margin-bottom: 18px;
        }
        
        .info div {
            margin: 10px;
            padding: 10px;
            border: 4px solid #ccc;
            border-radius: 10px;
            min-width: 200px;
            text-align: center;
        }
        
        .info div span {
            font-weight: bold;
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
    </style>
</head>
<body style="background-color: #eaf0f2;font-family:Georgia, serif">
<a href="accueilRRH.php" class="retour"><i class="fa fa-chevron-left"></i> Retour</a>  
<?php
 
 $title="";
     ?>
  <header><h4><b>Infomations <span>Personnelles</b></span></h4></header>
    <div class="container">
        <div class="avatar">
            <img src="images/persone.png" alt="Avatar">
        </div>
      
        <div class="info">
            <div>
                <span>Matricule:</span><br>
                <?php echo $info_postier[0]; ?><!--affiche la valeur de la septième colonne de la table "postier" stockée dans la variable "$info_postier-->
            </div>
            <div>
                <span>Nom:</span><br>
                <?php echo $info_postier[1]; ?>
            </div>
            <div>
                <span>Prénom:</span><br>
                <?php echo $info_postier[2]; ?>
            </div>
            <div>
                <span>Grade:</span><br>
<?php echo $info_postier[3]; ?>
</div>
<div>
<span>Direction:</span><br>
<?php echo $info_postier[4]; ?>
</div>
<div>
<span>Date Début Embauchement:</span><br>
<?php echo $info_postier[5]; ?>
</div>
<div>
<span>Téléphone:</span><br>
<?php echo $info_postier[6]; ?>
</div>
<div>
<span>Salaire:</span><br>
<?php echo $info_postier[7]; ?>
</div>
</div>
</div>

</body>
</html>
<?php
    $container = ob_get_clean();
    include "layout.php";
    ?>  
