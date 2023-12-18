<?php
session_start(); // Démarre la session
require_once 'connexion.php'; // Inclut le fichier connexion.php qui contient la classe "cnx"
$pdo = (new cnx())->getConnexion(); // Crée un objet PDO en appelant la méthode "getConnexion" de la classe "cnx"
if(isset($_POST['connecter'])){ // Vérifie si le bouton "Envoyer" a été cliqué
    $matricule=$_POST['matricule']; // Récupère la valeur du champ "matricule" dans le formulaire
    $password	=$_POST['password']; // Récupère la valeur du champ "pw" dans le formulaire
    $_SESSION['matricule']=$matricule; // Stocke la valeur du matricule dans la variable de session "matricule"
    $_SESSION['password']=$password	; // Stocke la valeur du mot de passe dans la variable de session "pw"
    $sql="SELECT * FROM user WHERE matricule='$matricule' AND password='$password'"; 
    //Le champ matricule de la table user doit être égal à la valeur $matricule .
//Le champ pw de la table user doit être égal à la valeur $pw .
    $reponse=$pdo->query($sql); // Exécute la requête SQL en utilisant l'objet PDO et stocke le résultat dans la variable "reponse"
    if($reponse->rowCount() > 0){ // Vérifie si la requête a renvoyé au moins une ligne
        $donnees=$reponse->fetch(); // Récupère la première ligne de résultat sous forme de tableau associatif et la stocke dans la variable "donnees"
        $_SESSION['nom'] = $donnees['nom']; // Stocke la valeur de la colonne "nom" dans la variable de session "nom"
        $_SESSION['prenom'] = $donnees['prenom']; // Stocke la valeur de la colonne "prenom" dans la variable de session "prenom"
        
        $_SESSION['grade'] = $donnees['grade']; // Stocke la valeur de la colonne "grade" dans la variable de session "grade"
        if ($_SESSION['grade'] === 'Responsable RH') { // Si le grade est "Responsable RH"
            header('Location: accueilRRh.php'); // Redirige l'utilisateur vers la page d'accueil
            exit; // Arrête l'exécution du script
        } else { // Sinon
            header('Location: Accueilemployé.php'); // Redirige l'utilisateur vers une autre page
            exit; // Arrête l'exécution du script
        }
    } else { // Si la requête n'a renvoyé aucune ligne
        $erreur = "Matricule et/ou mot de passe sont incorrect"; // Stocke un message d'erreur dans la variable "erreur"
    }
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
<title>Page de Connexion</title>
<style>
body{font-family:Georgia, serif;
background-color: #eaf0f2;}
.login{
  background-color: #f1f1f1;
  padding: 30px;
  height: 360px;
  border-radius: 10px;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
  position:absolute;
  top:200px;
  left:610px;
  width:360px;}
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
  bottom:90px;
  left:30px;}
.button:hover {
  background-color: #e0ac1c;}
.input {
  width: 100%;
  padding: 10px;
  margin-bottom: 20px;
  border: none;
  border-radius: 5px;
  box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);}
#a{
color:black;
position:absolute;
bottom:70px;
font-size:14px;}
#userr{position:absolute;
right:40px;
top:89px;
width:25px;
height:25px;}
#pw{position:absolute;
right:40px;
top:153px;}
header h4 {
    color: #e0ac1c;
    text-align: center;
  margin-bottom: 20px;}
header span {
    color: #031b62;}
header{text-align:center;
    font-family:Georgia, serif;}
    </style>

</head>
<body>  
<div class="login">
    <form method="post" >
      <header><h4><b>Conn<span>exion</span></b></h4></header>
<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" id="userr">
  <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm-9 8c0 1 1 1 1 1h5v-1a1.9 1.9 0 0 1 .01-.2 4.49 4.49 0 0 1 1.534-3.693C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Zm7 0a1 1 0 0 1 1-1v-1a2 2 0 1 1 4 0v1a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1v-2Zm3-3a1 1 0 0 0-1 1v1h2v-1a1 1 0 0 0-1-1Z"/>
</svg>
      <input type="text" name="matricule" class="input" placeholder=" Entrer Votre Matricule"  autocomplete ="off" required></br>
        <i class="fa fa-key" id="pw"></i><input  class="input" type="password" name="password" autocomplete ="off"   placeholder=" Entrer votre Mot De Passe" required>
        <input type="submit" name="connecter"  value=" Se Connecter" class="button">
<h6><a href="créercompte.php" id="a" style="color:black">  vous n'avez pas de compte ?créer un compte</a></b></h6>
<?php 
if(isset($erreur)){ 
    // Si une erreur est présente, on affiche l'alerte 
    ?>
    <div id="alerte" style="background-color: #F8D7DA; color: #721C24; padding: 10px; font-weight: bold; border: 1px solid #F5C6CB;position:absolute;top:-50px;left:-10px;width:410px">
        <?php echo $erreur; ?>
        <!-- Bouton de fermeture de l'alerte -->
        <svg  id="fermer" xmlns="http://www.w3.org/2000/svg" width="16" height="16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
</svg>
    </div>
    <?php
}
?>
<!-- Script pour fermer l'alerte -->
<script>
  //méthode addEventListener() pour ajouter un événement de type click au bouton de fermeture, qui déclenche une fonction anonyme.
    document.getElementById("fermer").addEventListener("click", function() {
        // Récupération de l'élément contenant l'alerte et stocke l'élément dans une variable element
        var element = document.getElementById("alerte");
        // Suppression de l'élément de la page
        element.parentNode.removeChild(element);
    });
</script>
</form>
</div>
<?php
include "footer.php";
?>
</body>
</html>