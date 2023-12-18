<?php
require_once "crud.php";
require_once "primes_nuit.php";
class crudprime extends CRUD
{   protected $table = "primes_nuit";
    function add(primes_nuit $obj)
    {   
        $mat = $obj->getMatricule();
        $m = $obj->getMois();
        $a = $obj->getAnnee();
        $nh = $obj->getNbr_heures();
    
        // Vérifier si une prime de nuit existe déjà pour ce mois et cette année
        /*compter le nombre de lignes dans la table "primes_nuit" qui ont les mêmes valeurs de "matricule", 
        "mois" et "annee" que l'objet "primes_nuit" en entrée.*/
        $sql = "select count(*) as count from primes_nuit where matricule=$mat and mois=$m and annee=$a";
        $res = $this->cnx->query($sql);
        $row = $res->fetch();
        $count = $row['count'];
    
        // Si une prime de nuit existe déjà pour ce mois et cette année, mettre à jour le nombre d'heures travaillées
        if ($count > 0) {
            $sql = "update primes_nuit set nbr_heures=nbr_heures+$nh where matricule=$mat and mois=$m and annee=$a";
            $res = $this->cnx->exec($sql);
            return ($res);
        } else {
            // Sinon, calculer le brut et insérer une nouvelle ligne dans la table
            $b = $obj->getBrut();
            $sql = "insert into primes_nuit (matricule,mois,annee,nbr_heures,brut) values ($mat, $m, $a, $nh, $b)";
            $res = $this->cnx->exec($sql);
            return ($res);
        }
    }
    
    function update(primes_nuit $obj)
    {   $nh = $obj->getNbr_heures();
        $b = $obj->getBrut();
        $m = $obj-> getMois();
        $a = $obj->getAnnee();
        $sql = "update heures_nuit set
                      mois=$m,
                      annee=$a,
                      nbr_heures=$nb,
                      brut=$b,
                     where matricule=$mat";
        try {
            $res = $this->cnx->exec($sql); //$res est entier
            return ($res);
        } catch (PDOException $e) {
            $res = "problème de mise à jour" . $e->getMessage();
            return ($res);
        }
    }}
