<?php
// Inclure le fichier connexion.php
require_once "connexion.php";


class CRUD
{
    protected $table; // le nom de la table sur laquelle s'appliquent les opérations CRUD
    protected $cnx;   // un objet PDO qui représente la connexion à la base de données


    function __construct()
    {
        $pdo = new cnx();
        $this->cnx = $pdo->getConnexion();
    }

    /**
     * Fonction de recherche d'un enregistrement dans la table spécifiée par $this->table.
     * @param string $mat Le matricule de l'utilisateur à rechercher.
     * @return array|false Retourne un tableau contenant les champs de l'enregistrement trouvé, ou false si aucun enregistrement n'a été trouvé.
     */
    function find($mat)
    {
        // Préparer la requête SQL
        $sql = "SELECT matricule, nom, prenom, grade, direction, date_debut_travail, tel, CONCAT(salaire, ' DT') as salaire_tnd 
                FROM user WHERE matricule='$mat'";
        
        // Exécuter la requête SQL
        $res = $this->cnx->query($sql);

        // Récupérer le premier enregistrement trouvé (s'il y en a un)
        return $res->fetch(PDO::FETCH_NUM);
    }


    function findprime($mat)
    {
        $sql = "SELECT matricule, nom, prenom, grade, direction 
                FROM user 
                WHERE matricule = '$mat'";
        $res = $this->cnx->query($sql);
        return $res->fetch(PDO::FETCH_NUM);
    }
    function finddprime($a)
{
    $sql = "SELECT user.matricule, user.nom, user.prenom, user.grade, user.direction, primes_nuit.mois, primes_nuit.annee, primes_nuit.nbr_heures, primes_nuit.brut 
            FROM user, primes_nuit
            WHERE user.matricule=primes_nuit.matricule AND annee='$annee'";
    $res = $this->cnx->query($sql);
    return $res->fetchAll(PDO::FETCH_NUM);
}

    
    function conge($mat)
    {
        $sql = "SELECT user.matricule, user.nom, user.prenom, user.grade,user.direction,conges.date_debut,conges.date_fin,conges.raison,conges.statut
                FROM user ,conges where user.matricule = conges.matricule";
         $res=$this->cnx->query($sql);
         return ($res->fetch(PDO::FETCH_NUM));
    }
    
    
    function delete($mat)
    {
        $sql = "delete from " . $this->table . " where matricule=$mat";
        $res = $this->cnx->exec($sql);
        return ($res);
    }

    
    function exists($mat, $m, $a){
        /*verification de l'exitance d'une ligne dans le table prime_nuiten utilisant les valeurs de trois variables 
        comme critères de recherche*/
        $sql = "SELECT * FROM primes_nuit WHERE matricule = ? AND mois = ? AND annee = ?";
        $stmt = $this->cnx->prepare($sql);
        $stmt->execute([$mat, $m, $a]);
        return $stmt->rowCount() > 0;
    }
    

    function findAllprime() {
        $sql = "SELECT user.matricule, user.nom, user.prenom,user.grade, user.direction,
        primes_nuit.mois, primes_nuit.annee, primes_nuit.nbr_heures, primes_nuit.brut
 FROM user, primes_nuit
 WHERE user.matricule=primes_nuit.matricule
 GROUP BY user.matricule, primes_nuit.mois, primes_nuit.annee
 ORDER BY primes_nuit.annee DESC";
        $res = $this->cnx->query($sql);
        return $res->fetchAll(PDO::FETCH_NUM);
    }
    function findAllconges($mat) {
        $sql = "SELECT conges.id_conge,user.matricule, user.nom, user.prenom, conges.date_debut, conges.date_fin, conges.raison, conges.statut
                FROM user, conges
                WHERE user.matricule = conges.matricule AND user.matricule=:matricule
                ORDER BY conges.id_conge DESC";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(':matricule', $mat, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_NUM);
    }
    
    
    function findAllprimemat($mat) {
        $sql = "SELECT user.matricule, user.nom, user.prenom,user.grade, user.direction, primes_nuit.mois, primes_nuit.annee, primes_nuit.nbr_heures, primes_nuit.brut 
        FROM user
        INNER JOIN primes_nuit ON user.matricule = primes_nuit.matricule 
        WHERE user.matricule = '$mat'";
        $res = $this->cnx->query($sql);
        return $res->fetchAll(PDO::FETCH_NUM);
    }
    function findpprime($mat) {
        $sql = "SELECT COUNT(*) AS nombre_primes
        FROM user
        INNER JOIN primes_nuit ON user.matricule = primes_nuit.matricule 
        WHERE user.matricule = :matricule";
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(':matricule', $matricule, PDO::PARAM_STR);
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        return $res['nombre_primes'];
    }
    
    function findconge($id)
    {
        $sql = "SELECT conges.id_conge, user.matricule,conges.date_debut, conges.date_fin, conges.raison, conges.statut
                FROM user, conges
                WHERE user.matricule = conges.matricule
                AND conges.id_conge = '$id'";
        $res = $this->cnx->query($sql);
        return ($res->fetch(PDO::FETCH_NUM));
    }
 
    function finddconge($mat)
    {
        $sql = "SELECT user.matricule, user.nom, user.prenom, user.grade, user.direction, conges.date_debut, conges.date_fin, conges.raison, conges.statut
                FROM user, conges
                WHERE user.matricule = conges.matricule
                AND user.matricule = :mat"; // Utilisation d'un paramètre lié :mat
        $stmt = $this->cnx->prepare($sql);
        $stmt->bindParam(':mat', $mat, PDO::PARAM_INT); // Lier le paramètre :mat à la variable $mat
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    
    
    
    function deleteconge($id, $mat)
{
    $sql = "delete from conges where matricule='" . $mat . "' and id_conge=" . $id;
    $res = $this->cnx->exec($sql);
    return $res;
}

    
 function deleteprime($id, $mat) {
        $stmt = $this->cnx->prepare("DELETE FROM primes_nuit WHERE id_prime = :id AND matricule = :mat");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':mat', $mat);
        $res = $stmt->execute();
        return $res;
    }
    function findAll()
    {
        $sql="select matricule, nom, prenom, grade, direction, date_debut_travail, tel, CONCAT(salaire, ' DT') as salaire_tnd from user order by matricule desc";
        $res= $this->cnx->query($sql);
        return ($res->fetchAll(PDO::FETCH_ASSOC));
    }
    function somme(){
        $sql = "SELECT COUNT(*) FROM user";
        $res=$this->cnx->query($sql);// exécuter la requêt
        return ($res->fetch(PDO::FETCH_NUM));//retourner le résultat 
        }
}
