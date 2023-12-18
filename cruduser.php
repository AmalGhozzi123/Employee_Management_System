<?php
// Inclusion des fichiers nécessaires
require_once "crud.php";
require_once "user.php";

// Définition de la classe cruduser qui hérite de la classe CRUD
class cruduser extends CRUD
{
    // Définition de la propriété $table qui spécifie la table sur laquelle les opérations CRUD doivent être effectuées
    protected $table = "user";
    

    //Définition de la fonction "add" qui prend en paramètre un objet de la classe "user".
    function add(user $obj)
    {
        //Récupération des valeurs des propriétés de l'objet "user" et stockage dans des variables.
        $mat = $obj->getMatricule();
        $n = $obj->getNom();
        $p = $obj->getPrenom();
        $g = $obj->getGrade();
        $d = $obj->getDirection();
        $ddt = $obj->getDate_debut_travail();
        $tel = $obj->getTel();
        $s = $obj->getSalaire();
        
        // Vérification de l'existence du matricule en exécutant une requête
        // SQL qui compte le nombre de fois où le matricule apparaît dans la table "user" et stockage du résultat dans la variable "$count".
        $sql = "SELECT COUNT(*) FROM user WHERE matricule = $mat";
        $count = $this->cnx->query($sql)->fetchColumn();
        if ($count > 0) {
            // Matricule existe déjà, afficher une alerte et arrêter l'exécution de la fonction
            echo "<script>alert('Le matricule existe déjà');</script>";
            return false;
        }
        
        // Construction de la requête SQL pour insérer les données dans la table user
        $sql = "insert into user (matricule, nom, prenom, grade, direction, date_debut_travail, tel, salaire) values ($mat, '$n', '$p', '$g', '$d', '$ddt', '$tel', $s)";
        
        // Exécution de la requête SQL et retour du résultat
        $res = $this->cnx->exec($sql);
        return $res;
    }
    
 
        
    
    // Définition de la méthode update qui met à jour un enregistrement existant dans la table postier à partir d'un objet postier donné en paramètre
    function update(user $obj)
    {
        // Récupération des valeurs des propriétés de l'objet postier
        $mat = $obj->getMatricule();
        $n = $obj->getNom();
        $p = $obj->getPrenom();
        $g = $obj->getGrade();
        $d = $obj->getDirection();
        $ddt = $obj->getDate_debut_travail();
        $tel = $obj->getTel();
        $s = $obj->getSalaire();
        
        // Construction de la requête SQL pour mettre à jour les données dans la table postier
        $sql = "update user set
                    nom='$n',
                    prenom='$p',
                    grade='$g',
                    direction='$d',
                    date_debut_travail='$ddt',
                    tel='$tel',
                    salaire=$s where matricule=$mat";
        
        try {
            // Exécution de la requête SQL et retour du résultat
            $res = $this->cnx->exec($sql);
            return ($res);
        } catch (PDOException $e) {
            // Gestion d'erreur en cas d'exception de type PDOException
            $res = "Problème De Mise à Jour" . $e->getMessage();
            return ($res);
        }
    }
    function updatePassword($matricule, $password)
    {
        // Construction de la requête SQL pour mettre à jour le mot de passe de l'utilisateur avec le matricule donné
        $sql = "update user set password ='$password' where matricule=$matricule";
        
        try {
            // Exécution de la requête SQL et retour du résultat
            $res = $this->cnx->exec($sql);
            return ($res);
        } catch (PDOException $e) {
            // Gestion d'erreur en cas d'exception de type PDOException
            $res = "Problème De Mise à Jour du mot de passe" . $e->getMessage();
            return ($res);
        }
    }
    public function checkPassword($matricule, $password)
{
    // Construction de la requête SQL pour récupérer le mot de passe de l'utilisateur avec le matricule donné
    $sql = "select password from user where matricule=$matricule";

    try {
        // Exécution de la requête SQL et récupération du mot de passe dans le résultat
        $res = $this->cnx->query($sql);
        $row = $res->fetch(PDO::FETCH_ASSOC);
        $stored_password = $row['password'];

        // Vérification si le mot de passe entré correspond à celui stocké en base de données
        if ($password == $stored_password) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        // Gestion d'erreur en cas d'exception de type PDOException
        $res = "Problème De Vérification Du mot de passe" . $e->getMessage();
        return false;
    }
}

}
?>
