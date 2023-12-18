<?php

// Inclusion des fichiers nécessaires
require_once "crud.php";
require_once "conges.php";

// Définition de la classe CRUD Congé, qui hérite de la classe CRUD
class crudconge extends CRUD
{
    // Nom de la table liée à la classe Congé
    protected $table = "conges";

    // Fonction pour mettre à jour un objet Congé
   // Fonction pour mettre à jour un objet Congé
function update(conges $obj)
{   
    // Récupération des données de l'objet Congé
    $dd = $obj->getDate_debut();
    $df = $obj->getDate_fin();
    $r = $obj->getRaison();
    $id = $obj->getId_conge();
    $mat = $obj->getMatricule();
    $statut = $obj->getStatut();
   
    // Vérifier si le statut est "en attente" avant de permettre la modification
    if ($statut == "en attente") {
        // Requête SQL pour mettre à jour les données dans la base de données
        $sql = "UPDATE conges SET date_debut='$dd', date_fin='$df', raison='$r' WHERE id_conge='$id' AND matricule='$mat'
        AND statut =$statut";

        try {
            // Exécution de la requête SQL
            $res = $this->cnx->exec($sql);
            return true;
        } catch (PDOException $e) {
            // En cas d'erreur lors de l'exécution de la requête, retourner un message d'erreur
            $res = "problème de mise à jour" . $e->getMessage();
            return $res;
        }
    } else {
        // Si le statut n'est pas "en attente", retourner un message d'erreur
        $res = "<script>alert('Impossible de modifier la demande, le statut est actuellement " . $statut . "');</script>";
        return $res;
    }
}


    // Fonction pour supprimer un congé 
    function deleteconge($id, $mat)
    {
        $sql= "delete from conges where matricule=$mat and id_conge=$id";
        $res = $this->cnx->exec($sql);
        return ($res);
    }
}
