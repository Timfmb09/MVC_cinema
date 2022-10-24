<?php
/*CONTROLLER via des requêtes va demander les données au MODEL/Connect qui récupère les infos de la BDD et va les afficher dans VIEW.*/

namespace Controller; // namespace, permet de dire "je travaille dans ce dossier".

use Model\Connect; // use, permet d'importer une class d'un autre "dossier"
 
class CinemaController {

/*Pour chaque demande de liste une nouvelle 'public function'*/

// Pour LIST on fait un QUERY
    public function listFilms() {
// $pdo appelle la fonction "se connecter" dans la class Connect.
        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT titre, annee_sortie_france, id_film
            FROM film
            ORDER BY titre ASC  
        ");
        
// REQUIRE indique le chemin pour visualiser la requête
        require "view/listFilms.php";
    }

    public function listActeurs() {

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
                SELECT nom, prenom, id_acteur
                FROM personne 
                INNER JOIN acteur 
                ON personne.id_personne=acteur.id_personne 
                ORDER BY nom ASC  
        ");

        require "view/listActeurs.php";
        
    }

    public function listRealisateurs() {

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
                SELECT id_realisateur,nom, prenom
                FROM personne 
                INNER JOIN realisateur 
                ON personne.id_personne=realisateur.id_personne    
                ORDER BY nom ASC      
        ");

        require "view/listRealisateurs.php";
        
    }
    public function listGenres() {

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
                SELECT nom_genre, id_genre
                FROM genre
                ORDER BY nom_genre ASC  
        ");

        require "view/listGenres.php";
        
    }

    public function listRoles() {

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
                SELECT id_role, role.nom_role
                FROM role
                ORDER BY nom_role ASC  
        ");

        require "view/listRoles.php";
        
    }

// Pour DETAIL on fait un PREPARE
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
                SELECT DISTINCT CONCAT(prenom, ' ', nom) AS acteur, sexe, CONCAT(date_naissance) AS date
                FROM jouer j
                INNER JOIN acteur a ON a.id_acteur = j.id_acteur
                INNER JOIN film f ON f.id_film = j.id_film
                INNER JOIN personne p ON p.id_personne = a.id_personne
                WHERE a.id_acteur= :id                
        ");
        $requeteacteur->execute(["id" =>$id]);      
  
        $requetefilmographie = $pdo->prepare("
                SELECT DISTINCT film.id_film, titre, annee_sortie_france AS annee, TIMEDIFF(duree_minutes, 'HH:MM') AS duree, CONCAT(prenom,' ',nom) AS realisateur, note
                FROM jouer
                INNER JOIN film ON film.id_film=jouer.id_film
                INNER JOIN realisateur ON realisateur.id_realisateur=film.id_realisateur 
                INNER JOIN personne ON personne.id_personne=realisateur.id_personne
                INNER JOIN acteur ON acteur.id_acteur=jouer.id_acteur
                WHERE acteur.id_acteur=:id                
        ");
        $requetefilmographie ->execute(["id" =>$id]);      
        require "view/detailActeur.php";
        
    }
    public function detailRealisateur($id) {
        $pdo = Connect::seConnecter();
        $requeterealisateur = $pdo->prepare("
                SELECT id_realisateur, nom, prenom
                FROM personne 
                INNER JOIN realisateur 
                ON personne.id_personne=realisateur.id_personne
                WHERE id_realisateur=:id   

        ");
        $requeterealisateur->execute(["id" =>$id]);   
        
        $requetefilmographie = $pdo->prepare("
                SELECT DISTINCT film.id_film, titre, annee_sortie_france AS annee, TIMEDIFF(duree_minutes, 'HH:MM') AS duree, CONCAT(prenom,' ',nom) AS realisateur, note
                FROM jouer
                INNER JOIN film ON film.id_film=jouer.id_film
                INNER JOIN realisateur ON realisateur.id_realisateur=film.id_realisateur 
                INNER JOIN personne ON personne.id_personne=realisateur.id_personne
                INNER JOIN acteur ON acteur.id_acteur=jouer.id_acteur
                WHERE acteur.id_acteur=:id
        ");  

        $requetefilmographie ->execute(["id" =>$id]);
        require "view/detailRealisateur.php";
        
    }
    public function detailGenre($id) {
        $pdo = Connect::seConnecter();
        $requetegenre = $pdo->prepare("
                SELECT nom_genre, id_genre
                FROM genre
                WHERE id_genre = :id
                
        ");
        $requetegenre->execute(["id" =>$id]);  

        $requetefilmgenre = $pdo->prepare("
                SELECT film.titre, GROUP_CONCAT(genre.nom_genre) as genre
                FROM film
                INNER JOIN associer_genre ON film.id_film=associer_genre.id_film
                INNER JOIN genre ON associer_genre.id_genre=genre.id_genre
                GROUP BY film.id_film
            
              
         ");        
        $requetefilmgenre->execute(["id" =>$id]); 
        require "view/detailGenre.php";
        
    }
    public function detailRole($id) {
        $pdo = Connect::seConnecter();
        $requeterole = $pdo->prepare("
                SELECT id_role, role.nom_role, descrip_role
                FROM role
                WHERE role.id_role=:id
                ORDER BY nom_role ASC  
                
        ");
        $requeterole->execute(["id" =>$id]);   
        
        
        $requetefilmrole = $pdo->prepare("
                SELECT film.titre, role.id_role, role.nom_role, CONCAT (nom, ' ' ,prenom ) AS acteur
                FROM film
                INNER JOIN jouer ON film.id_film=jouer.id_film
                INNER JOIN role ON jouer.id_role = role.id_role
                INNER JOIN acteur ON acteur.id_acteur=jouer.id_acteur
                INNER JOIN personne ON acteur.id_personne=personne.id_personne
                WHERE role.id_role=:id
                ORDER BY nom_role ASC 
                          
        ");
        $requetefilmrole->execute(["id" =>$id]);  
        require "view/detailRole.php";
        
    }
}

?>

