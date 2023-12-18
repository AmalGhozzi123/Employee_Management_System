<?php
//Classe cnx pour la connexion à la base de données MySQL.
class cnx 
{
    //Fonction getConnexion pour récupérer la connexion à la base de données.
     //@return PDO Objet PDO représentant la connexion à la base de données.
     
    function getConnexion()
    {
        $dsn = "mysql:host=localhost;dbname=gestion_poste"; // DSN pour la base de données
        $user = "root"; // Nom d'utilisateur pour la base de données
        $pw = ""; // Mot de passe pour la base de données
        $cnx = new PDO($dsn, $user, $pw); // Création de l'objet PDO pour la connexion à la base de données
        return $cnx; // Retourne l'objet PDO représentant la connexion à la base de données
    }
}

?>
