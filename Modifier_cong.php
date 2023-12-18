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
            top:200px;
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
  width: 380px;
  padding: 10px;
  margin-bottom: 20px;
  border: none;
  border-radius: 5px;
  box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
  transition: background-color 0.3s ease;
  position:absolute;
top:120px;
left:560px;
  
}

.button:hover {
  background-color: #e0ac1c;
}
header {
    text-align: center;
    margin-bottom: 20px;
    font-family:Georgia, serif;
    position:absolute;
    left:560px;
    top:-130px;

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
  top:-200px;
  left:0px;
}

.retour i {
  margin-right: 10px;
}

.retour:hover {
  background-color:#e0ac1c ;
}
.div1{position:absolute;
left:500px;
top:-180px;}


</style>
</head>
<body  style="background-color: #eaf0f2;font-family:Georgia, serif">

<?php
$title = "<header><h3><b>Modification <span><b>Infos Employé</b></span></b></h3></header>";
require_once "crudconge.php";
$crud=new crudconge();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $conge = $crud->findconge($id);
?>
  <a href="Accueilemployé.php" class="retour"><i class="fa fa-chevron-left"></i> Retour</a>  
    <form method="post" >
    <div class="container">
    <div class="div1">
        <label for="id"></label><input type="number"  class="form-control" name="id" value=<?= $conge[0] ?> hidden  readonly >
        <label for="mat"></label><input type="number"  class="form-control" name="mat" value=<?= $conge[1] ?> hidden  readonly >

    <label for="dd">Date_Début:</label><input type="date"  class="form-control" name="dd"  value=<?= $conge[2] ?> >
    <label for="df">Date_Fin:</label><input type="date"  class="form-control"  name="df"  value=<?= $conge[3] ?> >
    <label for="raison">Raison :</label><br>
    <select  name="r" >
        <option value="">-- Sélectionner une raison --</option>
        <option value="Congé annuel" <?php if ($conge[4] == 'Congé annuel') echo 'selected="selected"'; ?>>Congé annuel</option>
        <option value="Congé de maladie" <?php if ($conge[4] == 'Congé de maladie') echo 'selected="selected"'; ?>>Congé de maladie</option>
        <option value="Congé pour événement familial" <?php if ($conge[4] == 'Congé pour événement familial') echo 'selected="selected"'; ?>>Congé pour événement familial </option>
        <option value=" Congé de maternité" <?php if ($conge[4] == 'Congé de maternité') echo 'selected="selected"'; ?>> Congé de maternité </option>
        <option value="Congé de paternité" <?php if ($conge[4] == 'Congé de paternité') echo 'selected="selected"'; ?>>Congé de paternité</option>
        <option value="Congé sabbatique" <?php if ($conge[4] == 'Congé sabbatique') echo 'selected="selected"'; ?>>Congé sabbatique</option>
        <option value="Autre" <?php if ($conge[4] == 'Autre') echo 'selected="selected"'; ?>>Autre</option>
    </select>
    <label for="s"></label><input type="text"  class="form-control" name="s" value=<?= $conge[5] ?> hidden readonly>
    <br>
    </div>
    <input type="submit" onclick="return confirm('Êtes-Vous Sûr De Vouloir Modifier!!')" value="Modifier" class="button"  name="modifier">
</div> 
</form>
<?php
}
if (isset($_POST['modifier'])) {
    $cong = new conges(
        htmlspecialchars($_POST['id']),
        htmlspecialchars($_POST['mat']),
        htmlspecialchars($_POST['dd']),
        htmlspecialchars($_POST['df']),
        htmlspecialchars($_POST['r']),
        htmlspecialchars($_POST['s']),
    );
    $res = $crud->update($cong);
    if ($res == 1)
        header("location:congepre.php");
    else
        echo "$res";
}

$container = ob_get_clean();
include "layout.php";
?>
</body>
</html>