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
                INNER JOIN realisateur 
                ON personne.id_personne=realisateur.id_personne        
        ");

        require "view/listRealisateurs.php";
        
    }
    public function listGenres() {

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
                SELECT film.titre, GROUP_CONCAT(genre.nom_genre) as genre
                FROM film
                INNER JOIN associer_genre ON film.id_film=associer_genre.id_film
                INNER JOIN genre ON associer_genre.id_genre=genre.id_genre
                GROUP BY film.id_film
        ");

        require "view/listGenres.php";
        
    }

    public function listRoles() {

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
                SELECT film.titre, role.nom_role
                FROM film
                INNER JOIN jouer ON film.id_film=jouer.id_film
                INNER JOIN role ON jouer.id_role = role.id_role
        ");

        require "view/listRoles.php";
        
    }
    public function detFilm($id) {

        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare("SELECT titre FROM film = :id");
        $requete->execute(["id" =>$id]);      
        require "view/film/detailFilm.php";
        
    }

}

?>