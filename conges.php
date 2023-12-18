<?php
class conges{
    private $id_conge;
    private $matricule;
    private $date_debut;
    private $date_fin;
    private $raison;
    private $statut;
    private $nb_conges_max;
    private $notifications;
    function __construct($id,$mat,$dd,$df,$r,$s){
        $this->id_conge=$id;
        $this->matricule=$mat;
        $this->date_debut=$dd;
        $this->date_fin=$df;
        $this->raison=$r;
        $this->statut=$s;
 

    }
    
/**
     * Get the value of id_conge
     */ 
    public function getId_conge()
    {
        return $this->id_conge;
    }

    /**
     * Set the value of id_conge
     *
     * @return  self
     */ 
    public function setId_conge($id_conge)
    {
        $this->id_conge = $id_conge;

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

    /**
     * Get the value of date_debut
     */ 
    public function getDate_debut()
    {
        return $this->date_debut;
    }

    /**
     * Set the value of date_debut
     *
     * @return  self
     */ 
    public function setDate_debut($date_debut)
    {
        $this->date_debut = $date_debut;

        return $this;
    }

    /**
     * Get the value of date_fin
     */ 
    public function getDate_fin()
    {
        return $this->date_fin;
    }

    /**
     * Set the value of date_fin
     *
     * @return  self
     */ 
    public function setDate_fin($date_fin)
    {
        $this->date_fin = $date_fin;

        return $this;
    }

    /**
     * Get the value of raison
     */ 
    public function getRaison()
    {
        return $this->raison;
    }

    /**
     * Set the value of raison
     *
     * @return  self
     */ 
    public function setRaison($raison)
    {
        $this->raison = $raison;

        return $this;
    }


        /**
     * Get the value of statut
     */ 
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set the value of statut
     *
     * @return  self
     */ 
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get the value of nb_conges_max
     */ 
    public function getNb_conges_max()
    {
        return $this->nb_conges_max;
    }

    /**
     * Set the value of nb_conges_max
     *
     * @return  self
     */ 
    public function setNb_conges_max($nb_conges_max)
    {
        $this->nb_conges_max = $nb_conges_max;

        return $this;
    }

    /**
     * Get the value of notifications
     */ 
    public function getNotifications()
    {
        return $this->notifications;
    }

    /**
     * Set the value of notifications
     *
     * @return  self
     */ 
    public function setNotifications($notifications)
    {
        $this->notifications = $notifications;

        return $this;
    }
}