<?php
session_start();
if(!isset($_SESSION['matricule'])|| !isset($_SESSION['password']) ){
    header("location:login.php");exit;
}
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="login.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"><style>
body {
    background-color: #f2f2f2;
    font-family:Georgia, serif;
}
.container {
			display: flex;
			flex-wrap: wrap;
            position:absolute;
            top:100px;
		}


		label {
			display: block;
			margin-bottom: 5px;
			font-weight: bold;
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
top:400px;
  left:-280px;
}

.button:hover {
  background-color: #e0ac1c;
}
header {
    text-align: center;
    margin-bottom: 20px;
    font-family:Georgia, serif;
    position:absolute;
    left:550px;
    top:-50px;

}

header h3 {
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
  color: white;
  font-size: 12px;
  text-decoration: none;
  border-radius: 7px;
  transition: background-color 0.3s ease;
  position:absolute;
  top:-100px;
  left:-5px;
}

.retour i {
  margin-right: 10px;
}

.retour:hover {
  background-color:#e0ac1c ;
}
.div1{position:absolute;
left:140px;
top:-110px;}
.div2{position:absolute;
right:10px;
top:-20px;
}

</style>
</head>
<body  style="background-color: #eaf0f2;font-family:Georgia, serif">
<?php
$title = "<header><h3><b>Modification <span><b>Infos Employé</b></span></b></h3></header>";
ob_start();
require_once "cruduser.php";
$crud = new cruduser();
if (isset($_GET['mat'])) {
    $mat = $_GET['mat'];
    $postier = $crud->find($mat); 
?>
<a href="findallpostier.php" class="retour"><i class="fa fa-chevron-left"></i> Retour</a>  
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" >
    <div class="container">
        <div class="div1"><br><br><br><br>
	<label for="mat">Matricule :</label><input type="number"  class="form-control" readonly name="mat" value=<?= $postier[0] ?> id="">
    <label for="n">Nom :</label><input type="text"  class="form-control" name="n" readonly value=<?= $postier[1] ?> id="">
    <label for="p">Prénom :</label><input type="text"  class="form-control"  name="p" readonly value=<?= $postier[2] ?> id="">
    <label for="tel">Tel : </label><input type="tel"  class="form-control"  value=<?= $postier[6] ?>  name="tel" style="width:500px;padding: 10px;margin-bottom: 10px;border-radius: 5pxborder: none;box-shadow: 1px 1px 5px rgba(0,0,0,0.2);font-size: 16px">
    </div>
    
<div class="div2">
<label for="dde">DDE : </label> <input type="text"  class="form-control" readonly value=<?= $postier[5] ?> name="ddt" style="width:500px;padding: 10px;margin-bottom: 10px;border-radius: 5pxborder: none;box-shadow: 1px 1px 5px rgba(0,0,0,0.2);font-size: 16px">

<label for="d">Direction : </label><select name="d"   class="form-control" style="width:500px;padding: 10px;margin-bottom: 10px;border-radius: 5pxborder: none;box-shadow: 1px 1px 5px rgba(0,0,0,0.2);font-size: 16px">
<option value=""></option>
<option value="Direction centrale des produits postaux" <?php if ($postier[4] == 'Direction centrale des produits postaux') echo 'selected="selected"'; ?>>Direction centrale des produits postaux</option>
<option value="Direction centrale des affaires financières" <?php if ($postier[4] == 'Direction centrale des affaires financières') echo 'selected="selected"'; ?>>Direction centrale des affaires financières</option>
<option value="Direction centrale des produits financiers" <?php if ($postier[4] == 'Direction centrale des produits financiers') echo 'selected="selected"'; ?>>Direction centrale des produits financiers</option>
<option value="Direction centrale du patrimoine" <?php if ($postier[4] == 'Direction centrale du patrimoine') echo 'selected="selected"'; ?>>Direction centrale du patrimoine</option>
</select>
<label for="g">Grade :</label><select  class="form-control" name="g"  style="width:500px;padding: 10px;margin-bottom: 10px;border-radius: 5pxborder: none;box-shadow: 1px 1px 5px rgba(0,0,0,0.2);font-size: 16px">
<option value=""></option>
<option value="Agent non qualifié 1ère cie" <?php if ($postier[3] == 'Agent non qualifié 1ère cie') echo 'selected'; ?>>Agent non qualifié 1ère cie</option>
<option value="Agent non qualifié 2ème cie" <?php if ($postier[3] == 'Agent non qualifié 2ème cie') echo 'selected="selected"'; ?>>Agent non qualifié 2ème cie</option>
<option value="Agent non qualifié 3ème cie" <?php if ($postier[3] == 'Agent non qualifié 3ème cie') echo 'selected="selected"'; ?>>Agent non qualifié 3ème cie</option>
<option value="Agent d'Acceuil" <?php if ($postier[3] == 'Agent d\'Acceuil') echo 'selected="selected"'; ?>>Agent d'Acceuil</option>
<option value="Agent de métier" <?php if ($postier[3] == 'Agent de métier') echo 'selected="selected"'; ?>>Agent de métier</option>
<option value="Agent des postes" <?php if ($postier[3] == 'Agent des postes') echo 'selected="selected"'; ?>>Agent des postes</option>
<option value="Agent de guichet" <?php if ($postier[3] == 'Agent de guichet') echo 'selected="selected"'; ?>>Agent de guichet</option>
<option value="Agent de Distribution" <?php if ($postier[3] == 'Agent de Distribution') echo 'selected="selected"'; ?>>Agent de Distribution</option>
<option value="Agent Administratif Adjoint" <?php if ($postier[3] == 'Agent Administratif Adjoint') echo 'selected="selected"'; ?>>Agent Administratif Adjoint</option>
<option value="Agent technique" <?php if ($postier[3] == 'Agent de guichet') echo 'selected="selected"'; ?>>Agent technique</option>
<option value="Agent qualifié 1er degré" <?php if ($postier[3] == 'Agent qualifié 1er degré') echo 'selected="selected"'; ?>>Agent qualifié 1er degré</option>
<option value="Agent Administratif" <?php if ($postier[3] == 'Agent Administratif') echo 'selected="selected"'; ?>>Agent Administratif</option>
<option value="Agent Bureautique" <?php if ($postier[3] == 'Agent Bureautique') echo 'selected="selected"'; ?>>Agent Bureautique</option>
<option value="Agent PrincipaL des postes" <?php if ($postier[3] == 'Agent PrincipaL des postes') echo 'selected="selected"'; ?>>Agent PrincipaL des postes</option>
<option value="Agent PrincipaL de guichet" <?php if ($postier[3] == 'Agent PrincipaL de guichet') echo 'selected="selected"'; ?>>Agent PrincipaL de guichet</option>
<option value="Agent de Comptabilité" <?php if ($postier[3] == 'Agent de Comptabilité') echo 'selected="selected"'; ?>>Agent de Comptabilité</option>
<option value="Agent financier" <?php if ($postier[3] == 'Agent financier') echo 'selected="selected"'; ?>>Agent financier</option>
<option value="Agent Commercial" <?php if ($postier[3] == 'Agent Commercial') echo 'selected="selected"'; ?>>Agent Commercial</option>
<option value="Technicien Adjoint" <?php if ($postier[3] == 'Technicien Adjoint') echo 'selected="selected"'; ?>>Technicien Adjoint</option>
<option value="Technicien de Laboratoire Informatique" <?php if ($postier[3] == 'Technicien de Laboratoire Informatique') echo 'selected="selected"'; ?>>Technicien de Laboratoire Informatique</option>
<option value="Agent qualifié 2ème degré" <?php if ($postier[3] == 'Agent qualifié 2ème degré') echo 'selected="selected"'; ?>>Agent qualifié 2ème degré</option>
<option value="Gestionnaire Adjoint" <?php if ($postier[3] == 'Gestionnaire Adjoint') echo 'selected="selected"'; ?>>Gestionnaire Adjoint</option>

  </select>

<label for="s">Salaire :</label><input type="float"  class="form-control"  value=<?= $postier[7] ?> name="s" style="width:500px;padding: 10px;margin-bottom: 10px;border-radius: 5pxborder: none;box-shadow: 1px 1px 5px rgba(0,0,0,0.2);font-size: 16px">
<input type="submit" onclick="return confirm('Êtes-Vous Sûr De Vouloir Modifier!!')" value="Modifier" class="button"  name="button">
</div></div> 
</form>
<?php
}
if (isset($_POST['button'])) {
    $pos = new user(
        htmlspecialchars($_POST['mat']),
        htmlspecialchars($_POST['n']),
        htmlspecialchars($_POST['p']),
        htmlspecialchars($_POST['g']),
        htmlspecialchars($_POST['d']),
        htmlspecialchars($_POST['ddt']),
        htmlspecialchars($_POST['tel']),
        htmlspecialchars($_POST['s']),
    );
    $res = $crud->update($pos);
    if ($res == 1)
        header("location:findallpostier.php");
    else
        echo "$res";
}
$container = ob_get_clean();
include "layout.php";
?>