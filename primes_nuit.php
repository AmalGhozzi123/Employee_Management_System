<?php
class primes_nuit	

{   private $id_prime;
    private $matricule;
    private $mois;
    private $annee;
    private	$nbr_heures;
    private $brut;	
    public function __construct($mat,$m,$a,$nh,$b) {
        $this->matricule = $mat;
        $this->mois = $m;
        $this->brut = $b;
        $this->annee = $a;
        $this->nbr_heures=$nh;
        $this->brut = $b;
      }
/**
 * Get the value of id_prime
 */ 
public function getId_prime()
{
return $this->id_prime;
}

/**
 * Set the value of id_prime
 *
 * @return  self
 */ 
public function setId_prime($id_prime)
{
$this->id_prime = $id_prime;

return $this;
}
    /**
     * Get the value of nbr_heure
     */ 
    public function getNbr_heures()
    {
        return $this->nbr_heures;
    }

    /**
     * Set the value of nbr_heure
     *
     * @return  self
     */ 
    public function setNbr_heures($nbr_heures)
    {
        $this->nbr_heures = $nbr_heures;

        return $this;
    }

    /**
     * Get the value of brut
     */ 
    public function getBrut()
    {
        return $this->brut;
    }

    /**
     * Set the value of brut
     *
     * @return  self
     */ 
    public function setBrut($brut)
    {
        $this->brut = $brut;

        return $this;
    }

    /**
     * Get the value of mois
     */ 
    public function getMois()
    {
        return $this->mois;
    }

    /**
     * Set the value of mois
     *
     * @return  self
     */ 
    public function setMois($mois)
    {
        $this->mois = $mois;

        return $this;
    }

    /**
     * Get the value of annee
     */ 
    public function getAnnee()
    {
        return $this->annee;
    }

    /**
     * Set the value of annee
     *
     * @return  self
     */ 
    public function setAnnee($annee)
    {
        $this->annee = $annee;

        return $this;
}

/**
 * Get the value of matricule
 */ 
public function getMatricule()
{
return $this->matricule;
}

/**
 * Set the value of matricule
 *
 * @return  self
 */ 
public function setMatricule($matricule)
{
$this->matricule = $matricule;

return $this;
}

}