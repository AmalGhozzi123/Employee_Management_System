<?php
// Inclusion du fichier contenant la classe "crudpostier"
require_once "cruduser.php";

// Vérification si le formulaire a été soumis
if(isset($_POST['modifier'])){

    // Création d'un nouvel objet "crudpostier"
    $crud = new cruduser();

    // Récupération des données du formulaire
    $matricule = $_POST['matricule'];
    $password= $_POST['pw'];
    $new_password = $_POST['pw_modif'];

    // Vérification si l'ancien mot de passe est correct
    if($crud->checkPassword($matricule, $password)) {

        // Mise à jour du mot de passe
        $res = $crud->updatePassword($matricule,$new_password);

        // Affichage du résultat
        if ($res) {

            echo '<div id="alerte"   class="alert alert-success" role="alert">Le mot de passe a été modifié avec succès
            
            <svg  id="fermer" xmlns="http://www.w3.org/2000/svg" width="16" height="16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
</svg></div>';


        } else {
            echo '<div id="alerte"  class="alert alert-danger" role="alert">Une erreur s\'est produite lors de la modification du mot de passe.
            
            <svg  id="fermer" xmlns="http://www.w3.org/2000/svg" width="16" height="16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
          </svg></div>';
        }
    } else {
        echo '<div id="alerte"  class="alert alert-danger" role="alert">Matricule et/ou Mot de passe incorrect!!!
        <svg  id="fermer" xmlns="http://www.w3.org/2000/svg" width="16" height="16">
        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
      </svg></div>';
    }
}
?>
<script>
  //méthode addEventListener() pour ajouter un événement de type click au bouton de fermeture, qui déclenche une fonction anonyme.
    document.getElementById("fermer").addEventListener("click", function() {
        // Récupération de l'élément contenant l'alerte et stocke l'élément dans une variable element
        var element = document.getElementById("alerte");
        // Suppression de l'élément de la page
        element.parentNode.removeChild(element);
    });
</script>
<!DOCTYPE html>
<html>
<head>
    <title>Modifier le mot de passe d'un Employé</title>
    <style>
        .alert {
          text-align:center;
width: 400px;
height: 60px;
position:absolute;
left:590px;
top:70px;
}
        body{font-family:Georgia, serif;
background-color: #eaf0f2;}
.form{
  background-color: #f1f1f1;
  padding: 30px;
  height: 360px;
  border-radius: 10px;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
  position:absolute;
  top:150px;
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
  bottom:-5px;
  left:30px;}
.button:hover {
  background-color: #e0ac1c;}
.input {
  width: 100%;
  padding: 10px;
  margin-bottom:2px;
  border: none;
  border-radius: 5px;
  box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);}
#userr{position:absolute;
right:40px;
top:89px;}
#pw{position:absolute;
right:40px;
top:153px;}
header h5{
    color: #e0ac1c;
    text-align: center;
  margin-bottom: 20px;}
header span {
    color: #031b62;}
header{text-align:center;
    font-family:Georgia, serif;
font-size:5px;}
    </style>
</head>
<body>
    <?php
    $title="";
    ?>
    <form method="post" class="form">
    <header><h5><b>Modifier <span>mot de passe</span></b></h5></header>
        <input type="text" id="matricule" name="matricule" class="input" placeholder="*Entrer votre Matricule"><br><br>
        <input type="password" id="password" name="pw"  class="input"  placeholder="*Entrer Ancien mot de passe "><br><br>
        <input type="password" id="password_modif" name="pw_modif"  class="input" placeholder="*Choisir Nouveau mot de passe "><br><br>
        <input type="submit" value="Modifier" name="modifier" class="button">
    </form>
</body>
<?php
 $container =ob_get_clean();
    include "button.php";
    ?>
    
</html>
