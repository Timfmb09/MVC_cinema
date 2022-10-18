<?php
/**Va demander les données au model (qui cherche les infos à la BDD)
 * et va les afficher dans VIEW.
 * "Controller"=Contiendra l'ensemble des requêtes dans les fonctions en relation avec les vues */

namespace Controller;
use Model\Connect;
/**un namespace permettant de catégoriser virtuellement 
 * (dans un espace de nom la classe en question). 
 * Ainsi on pourra "use" la classe sans connaître son emplacement physique. 
 * On a juste besoin de savoir dans quel namespace elle se trouve */
class CinemaController {

    /**
     * Lister les films
     * Pour chaque demande de liste une nouvelle 'public function'
     */
    public function listFilms() {

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT titre, annee_sortie
            FROM film
        ");

        require "view/listFilms.php";
    }
}

?>