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
            SELECT titre, annee_sortie_france, id_film
            FROM film
        ");

        require "view/listFilms.php";
    }

    public function listActeurs() {

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
                SELECT nom, prenom, id_acteur
                FROM personne 
                INNER JOIN acteur 
                ON personne.id_personne=acteur.id_personne 
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
    public function detailFilm($id) {
        $pdo = Connect::seConnecter();
        $requetefilm = $pdo->prepare("
                SELECT film.id_film, titre, annee_sortie_france AS annee, TIMEDIFF(duree_minutes, 'HH:MM') AS duree, CONCAT(prenom,' ',nom) AS realisateur, note
                FROM film 
                INNER JOIN realisateur 
                ON realisateur.id_realisateur=film.id_realisateur 
                INNER JOIN personne
                ON personne.id_personne=realisateur.id_personne
                WHERE film.id_film = :id
        ");
        $requetefilm->execute(["id" =>$id]);

        $requetecasting = $pdo->prepare("
                SELECT CONCAT(prenom, ' ', nom) AS acteur, nom_role AS role
                FROM jouer  
                INNER JOIN acteur
                ON jouer.id_acteur=acteur.id_acteur
                INNER JOIN personne
                ON personne.id_personne = acteur.id_personne
                INNER JOIN film 
                ON film.id_film=jouer.id_film
                INNER JOIN role
                ON role.id_role=jouer.id_role
                WHERE film.id_film = :id
        ");
        $requetecasting->execute(["id" =>$id]);
        
        require "view/detailFilm.php";
        
    }
    public function detailActeur($id) {
        $pdo = Connect::seConnecter();
        $requeteacteur = $pdo->prepare("
                SELECT DISTINCT CONCAT(prenom, ' ', nom) AS acteur, sexe, CONCAT(date_naissance) AS DATE
                FROM jouer j
                INNER JOIN acteur a ON a.id_acteur = j.id_acteur
                INNER JOIN film f ON f.id_film = j.id_film
                INNER JOIN acteur ON a.id_acteur = j.id_acteur
                INNER JOIN personne p ON p.id_personne = a.id_personne
                WHERE id_acteur= :id                
        ");
        $requeteacteur->execute(["id" =>$id]);      
  
        $requetefilmographie = $pdo->prepare("
                SELECT DISTINCT film.id_film, titre, annee_sortie_france AS annee, TIMEDIFF(duree_minutes, 'HH:MM') AS duree, CONCAT(prenom,' ',nom) AS realisateur, note
                FROM jouer
                INNER JOIN film
                ON film.id_film=jouer.id_film
                INNER JOIN realisateur 
                ON realisateur.id_realisateur=film.id_realisateur 
                INNER JOIN personne
                ON personne.id_personne=realisateur.id_personne
                WHERE id_acteur= :id                
        ");
        $requetefilmographie ->execute(["id" =>$id]);      
        require "view/detailActeur.php";
        
    }
    public function detailRealisateur($id) {
        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare("
                SELECT 
        ");
        $requete->execute(["id" =>$id]);      
        require "view/detailActeur.php";
        
    }
    public function detailGenre($id) {
        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare("
                SELECT 
        ");
        $requete->execute(["id" =>$id]);      
        require "view/detailFilm.php";
        
    }
    public function detailRole($id) {
        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare("
                SELECT 
        ");
        $requete->execute(["id" =>$id]);      
        require "view/detailFilm.php";
        
    }
}
// SELECT titre, CONCAT(prenom, ' ', nom) AS acteur
// FROM jouer j
// INNER JOIN acteur a ON a.id_acteur = j.id_acteur
// INNER JOIN film f ON f.id_film = j.id_film
// INNER JOIN acteur ON a.id_acteur = j.id_acteur
// INNER JOIN personne p ON p.id_personne = a.id_personne



?>

