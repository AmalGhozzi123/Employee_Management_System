<?php
class user
{
    private $matricule;
    private $nom;
    private $prenom;
    private $grade;
    private $direction;
    private $date_debut_travail	;
    private $tel;
    private $salaire;
    private $password;
    private $password_confirm;
    function __construct($mat,$n,$p,$g,$d,$ddt,$tel,$s)
    {
        $this->matricule=$mat;
        $this->nom = $n;
        $this->prenom=$p;
        $this->grade=$g;
        $this->direction=$d;
        $this->date_debut_travail=$ddt;
        $this->tel=$tel;
        $this->salaire=$s;
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
     * Get the value of nom
     */ 
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @return  self
     */ 
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of prenom
     */ 
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set the value of prenom
     *
     * @return  self
     */ 
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get the value of grade
     */ 
    public function getGrade()
    {
        return $this->grade;
    }

    /**
     * Set the value of grade
     *
     * @return  self
     */ 
    public function setGrade($grade)
    {
        $this->grade = $grade;

        return $this;
    }

    /**
     * Get the value of direction
     */ 
    public function getDirection()
    {
        return $this->direction;
    }

    /**
     * Set the value of direction
     *
     * @return  self
     */ 
    public function setDirection($direction)
    {
        $this->direction = $direction;

        return $this;
    }

    /**
     * Get the value of date_debut_travail
     */ 
    public function getDate_debut_travail()
    {
        return $this->date_debut_travail;
    }

    /**
     * Set the value of date_debut_travail
     *
     * @return  self
     */ 
    public function setDate_debut_travail($date_debut_travail)
    {
        $this->date_debut_travail = $date_debut_travail;

        return $this;
    }

    /**
     * Get the value of tel
     */ 
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set the value of tel
     *
     * @return  self
     */ 
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }


    /**
     * Get the value of salaire
     */ 
    public function getSalaire()
    {
        return $this->salaire;
    }

    /**
     * Set the value of salaire
     *
     * @return  self
     */ 
    public function setSalaire($salaire)
    {
        $this->salaire = $salaire;

        return $this;
    }

    function __construct2($mat,$pw)
    {
        $this->matricule=$mat;
        $this->pw=$pw;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of password_confirm
     */ 
    public function getPassword_confirm()
    {
        return $this->password_confirm;
    }

    /**
     * Set the value of password_confirm
     *
     * @return  self
     */ 
    public function setPassword_confirm($password_confirm)
    {
        $this->password_confirm = $password_confirm;

        return $this;
    }
}
?>
