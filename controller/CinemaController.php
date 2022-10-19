<?php
/**Va demander les données au model (qui cherche les infos à la BDD) et va les afficher dans VIEW.
 * "Controller"=Contiendra l'ensemble des requêtes dans les fonctions en relation avec les vues */

namespace Controller;
use Model\Connect;
/**un namespace permettant de catégoriser virtuellement 
 * (dans un espace de nom la classe en question). 
 * Ainsi on pourra "use" la classe sans connaître son emplacement physique. 
 * On a juste besoin de savoir dans quel namespace elle se trouve */
class CinemaController {

    /**
     * Lister les films, les acteurs...
     * Pour chaque demande de liste une nouvelle 'public function'
     */
    public function listFilms() {

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT titre, annee_sortie_france
            FROM film
        ");

        require "view/listFilms.php";
    }

    public function listActeurs() {

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT nom, prenom
            FROM film
            INNER JOIN personne
        ");

        require "view/listActeurs.php";
        
    }

    public function listRealisateurs() {

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT nom, prenom
            FROM personne            
        ");

        require "view/listRealisateurs.php";
        
    }


}

?>