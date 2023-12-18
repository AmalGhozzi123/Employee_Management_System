<?php
session_start();
// Inclusion du fichier connexion.php
require_once  "connexion.php";
// crée une nouvelle instance de la classe cnx, qui est utilisée pour établir la connexion à la base de données
$cnx = new cnx();
$conn = $cnx->getConnexion();
// Vérifier si le formulaire a été soumis
if (isset($_POST['inscrire'])) {

    // Récupérer les valeurs du formulaire
    $matricule = $_POST["matricule"];
    $password	 = $_POST["password"];
    $password_confirm=$_POST["password_confirm"];
    // Vérifier si le matricule existe dans la base de données
    $stmt = $conn->prepare("SELECT * FROM user WHERE matricule = ?");
    $stmt->execute([$matricule]); // Exécution de la requête préparée avec le matricule comme paramètre
    $row = $stmt->fetch(); // Récupération du premier enregistrement

    if ($row) {
        // Le matricule existe dans la base de données, vérifier s'il a déjà un mot de passe
        if ($row['password']) {
            // Le compte existe déjà avec un mot de passe, afficher un message d'erreur
            $error = "Compte déjà existant!!!";
        } else {
            // Le compte existe mais n'a pas encore de mot de passe, continuer le traitement
            if ($password == $password_confirm) {
                // Mise à jour de la table "user" avec le mot de passe fourni pour le matricule correspondant
                $stmt = $conn->prepare("UPDATE user SET password = ? WHERE matricule = ?");
                $stmt->execute([$password, $matricule]); // Exécution de la requête préparée avec le mot de passe et le matricule comme paramètres
                $success = "Inscription avec succès";


            } else {
                // Les mots de passe ne correspondent pas
                $error = "Les mots de passe ne correspondent pas!!!";
            }
        }
    } else {
        // Le matricule n'existe pas dans la base de données
        $error = "Matricule Introuvable!!!";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inscription des employés</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <style>
body{font-family:Georgia,serif;
background-color: #eaf0f2;
}
.inscrire{
  background-color: #f1f1f1;
  padding: 30px;
  height: 380px;
  border-radius: 10px;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
  position:absolute;
  top:200px;
  left:610px;
  width:360px;
}
.button {
  background-color:#18022f;
  color: white;
  width: 83%;
  padding: 10px;
  margin-bottom: 20px;
  border: none;
  border-radius: 5px;
  box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
  transition: background-color 0.3s ease;
  position:absolute;
  bottom: 25px;
  left:30px;
}
.button:hover {
  background-color: #e0ac1c;
}
.input {
  width: 300px;
  padding: 10px;
  margin-bottom: 20px;
  border: none;
  border-radius: 5px;
  box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
  height:45px;
  font-family:Georgia, serif;

}
header h2 {
    color: #e0ac1c;
    text-align: center;
  margin-bottom: 20px;


  
}
header span {
    color: #031b62;

}
header{text-align:center;
    font-family:Georgia, serif;
    }
    #user{
      position:absolute;
      bottom:250px;
      right:40px;
    }
    #pw1{position:absolute;
right:49px;
top:170px;}
#pw2{position:absolute;
right:49px;
top:230px;}
.img{height: 140px;
width: 140px;
position:absolute;
top:12px;
right:700px;}
.right {
  position: absolute;

  left: 1320px;
  font: normal 36px 'Cookie', cursive;
  word-spacing: 10px; 
}


    .footer{height:50px;
    position:absolute;
bottom:-150px;}
.footer {
    position: fixed;
    bottom:0px;
    left:0px;
    right: 0px;
    width:100%;
   
}
#footer{ background-color: #18022f;

    width: 100%;
    text-align: left;
    font: bold 16px sans-serif;
    height: 300px;}
    #footer p{color:white;
    position:absolute;
right:15px;
bottom:0px;
font-size:10px;}
.fond-jaune {
  background-color:#f7c12b;
  width: 717px;
  height: 16px;
  position:absolute;
  bottom:625px;
  left:0px;
}
.fond-jjaune {
  background-color:#f7c12b;
  width: 719px;
  height: 16px;
  position:absolute;
  bottom:625px;
  right:0px;
}
  </style>
</head>
<body>
<div class="inscrire">
  <form method="post" >
  <header><h2><b>Insc<span>rire</span></b></h2></header>
  <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" id="user">
  <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm-9 8c0 1 1 1 1 1h5v-1a1.9 1.9 0 0 1 .01-.2 4.49 4.49 0 0 1 1.534-3.693C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Zm7 0a1 1 0 0 1 1-1v-1a2 2 0 1 1 4 0v1a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1v-2Zm3-3a1 1 0 0 0-1 1v1h2v-1a1 1 0 0 0-1-1Z"/>
</svg>
    <input type="text" name="matricule" class="input"  placeholder="*Entrer Matricule" required>
    <i class="fa fa-key" id="pw1"></i>
    <input type="password" name="password" placeholder="*Entrer Mot de passe" class="input" required>
    <i class="fa fa-key" id="pw2"></i>
    <input type="password" name="password_confirm"  placeholder="*Confirmer le mot de passe" class="input"  required>
 
    <input type="submit" value="S'inscrire" class="button" name="inscrire">
  </form></div>
  <?php if (isset($error)): ?>
  <div id="alerte" class="alert alert-danger" style="position:absolute;bottom:500px;left:680px"><?php echo $error; ?>
 
        <svg  id="fermer" xmlns="http://www.w3.org/2000/svg" width="16" height="16" >
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
</svg>
</div>
<?php endif; ?>
<script>
    document.getElementById("fermer").addEventListener("click", function() {
        // Récupération de l'élément contenant l'alerte
        var element = document.getElementById("alerte");
        // Suppression de l'élément de la page
        element.parentNode.removeChild(element);
    });
</script>
<?php if (isset($success)): ?>
  <div id="alerte" class="alert alert-success" style="position:absolute;bottom:500px;left:680px"><?php echo $success; ?></div>
        <svg  id="fermer" xmlns="http://www.w3.org/2000/svg" width="16" height="16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
</svg>
<?php endif; ?>
<script>
    document.getElementById("fermer").addEventListener("click", function() {
        // Récupération de l'élément contenant l'alerte
        var element = document.getElementById("alerte");
        // Suppression de l'élément de la page
        element.parentNode.removeChild(element);
    });
</script>

  <div class="ft" style="background-color:#18022f;height:80px;position:absolute;top:0px;left:0px;right:0px">
</div>
<div class="footer-left" style="font-family:Georgia,serif">
            <img src="images/hhh.jpg" class="img" style="height: 138px;width: 138px;position:absolute;top:12px;left:700px">
            <div class="fond-jaune"></div>
<div class="fond-jjaune" style="font-family:Georgia,serif"></div>
            <h3 style="color:#e0ac1c;font-size:20px;
            font-family:Georgia,serif;
    position:absolute;
    left:130px;
    bottom:10px;
    position:absolute;
    top:12px;
    left:10px">La Poste<span style="color:white;font-family:Georgia,serif"> Tunisienne</span></h3>
       
        <div class="right">
            <h3  style="line-height: 1.1em;font-family:Georgia,serif;position:absolute;top:10px;color:#e0ac1c">البريد&nbsp;<span style="color:white;font-family:Georgia,serif" >التونسي<span></h3>
        </div>
        </div>
</header>
            <footer class="footer">
    <div id="footer">
<p>
<strong style="font-family:Georgia,serif">Développé par Amal Ghozzi<br></strong> 


            </p></div>

<p style="position:absolute;bottom:-5px;left:5px;font-size:12px;color:white">
<strong>Droits D'auteur ONP©2023 Tous Droits Réservés</br></strong> 
                      

            </p>
</footer>
</body>

</html>