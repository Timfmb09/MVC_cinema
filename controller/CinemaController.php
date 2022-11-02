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
                SELECT film.id_film, titre, annee_sortie_france AS annee, TIMEDIFF(duree_minutes, 'HH:MM') AS duree, CONCAT(prenom,' ',nom) AS realisateur, note, affiche
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
                INNER JOIN acteur ON jouer.id_acteur=acteur.id_acteur
                INNER JOIN personne ON personne.id_personne = acteur.id_personne
                INNER JOIN film ON film.id_film=jouer.id_film
                INNER JOIN role ON role.id_role=jouer.id_role
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

    public function addRole(){
        //si on détecte le submit ($_POST["submit])
        //alors on se connecte à  la base de données
        if(isset($_POST["submit"])) {
                //on filtre le champ role du formulaire (filter_input)
                $nomRole = filter_input(INPUT_POST, "nom_role", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $descRole = filter_input(INPUT_POST, "descrip_role", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                //si le filtre est valide, on prépare la requête d'insertion (INSERT INTO ... VALUES)
                //on exécute la requête en faisant passer le tableau d'arguments
                if($nomRole && $descRole) {
                        $pdo = Connect :: seConnecter();
                        $requeteRole = $pdo->prepare("
                                INSERT INTO role (nom_role, descrip_role)
                                VALUES (:nom_role, :descrip_role) 
                        ");
                        $requeteRole->execute([
                                "nom_role" => $nomRole,
                                "descrip_role" => $descRole
                        ]);  
                        //on fait la redirection vers la liste des rôles (header("Location: index.php..."))
                        header("Location: index.php?action=listRoles");
                        die;
                }
        }
        
        require "view/addRole.php";
    }

        public function addGenre(){
                //si on détecte le submit ($_POST["submit])
                //alors on se connecte à  la base de données
                if(isset($_POST["submit"])) {
                        //on filtre le champ Genre du formulaire (filter_input)
                        $nomgenre = filter_input(INPUT_POST, "nom_genre", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        //si le filtre est valide, on prépare la requête d'insertion (INSERT INTO ... VALUES)
                        //on exécute la requête en faisant passer le tableau d'arguments
                        if($nomgenre) {
                                $pdo = Connect :: seConnecter();
                                $requeteGenre = $pdo->prepare("
                                        INSERT INTO genre (nom_genre)
                                        VALUES (:nom_genre) 
                                ");
                                $requeteGenre->execute([
                                        "nom_genre" => $nomgenre,                                        
                                ]);  
                                //on fait la redirection vers la liste des rôles (header("Location: index.php..."))
                                header("Location: index.php?action=listGenres");
                                die;
                        }
                }
                
                require "view/addGenre.php";
        }
        
        public function addActeur(){
        //si on détecte le submit ($_POST["submit])
        //alors on se connecte à  la base de données
        if(isset($_POST["submit"])) {
                //on filtre le champ role du formulaire (filter_input)
                $nomActeur = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $prenomActeur = filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $sexeActeur = filter_input(INPUT_POST, "sexe", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $date_naissanceActeur = filter_input(INPUT_POST, "date_naissance", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                //si le filtre est valide, on prépare la requête d'insertion (INSERT INTO ... VALUES)
                //on exécute la requête en faisant passer le tableau d'arguments
                if($nomActeur && $prenomActeur && $sexeActeur && $date_naissanceActeur) {
                        $pdo = Connect :: seConnecter();
                        $requetePersonne = $pdo->prepare("
                                INSERT INTO personne (nom, prenom, sexe, date_naissance)
                                VALUES (:nom, :prenom, :sexe, :date_naissance) 
                        ");
                        $requetePersonne->execute([
                                "nom" => $nomActeur,
                                "prenom" => $prenomActeur,
                                "sexe" => $sexeActeur,
                                "date_naissance"=> $date_naissanceActeur
                        ]);
                        
                        $lastInsertActeur=$pdo->lastInsertId();
                        
                        $requeteActeur=$pdo->prepare("
                                INSERT INTO acteur ( id_personne)
                                VALUES ( :id_personne)
                                ");
                        $requeteActeur->execute([
                                "id_personne" => $lastInsertActeur
                        ]);
                        //on fait la redirection vers la liste des rôles (header("Location: index.php..."))
                        header("Location: index.php?action=listActeurs");
                        die;
                }
        }
        
        require "view/addActeur.php";
        }


        public function addRealisateur(){
        //si on détecte le submit ($_POST["submit])
        //alors on se connecte à  la base de données
        if(isset($_POST["submit"])) {
                //on filtre le champ role du formulaire (filter_input)
                $nomRealisateur = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $prenomRealisateur = filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $sexeRealisateur = filter_input(INPUT_POST, "sexe", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $date_naissanceRealisateur = filter_input(INPUT_POST, "date_naissance", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                //si le filtre est valide, on prépare la requête d'insertion (INSERT INTO ... VALUES)
                //on exécute la requête en faisant passer le tableau d'arguments
                if($nomRealisateur && $prenomRealisateur && $sexeRealisateur && $date_naissanceRealisateur ) {
                        $pdo = Connect :: seConnecter();
                        $requetePersonne = $pdo->prepare("
                                INSERT INTO personne (nom, prenom, sexe, date_naissance)
                                VALUES (:nom, :prenom, :sexe, :date_naissance) 
                        ");
                        $requetePersonne->execute([
                                "nom" => $nomRealisateur,
                                "prenom" => $prenomRealisateur,
                                "sexe" => $sexeRealisateur,
                                "date_naissance"=> $date_naissanceRealisateur
                        ]);  
                        //on fait la redirection vers la liste des rôles (header("Location: index.php..."))
                        
                        $lastInsertRealisateur=$pdo->lastInsertId();
                        
                        $requeteRealisateur=$pdo->prepare("
                                INSERT INTO realisateur ( id_personne)
                                VALUES ( :id_personne)
                                ");
                        $requeteRealisateur->execute([
                                "id_personne" => $lastInsertRealisateur
                        ]);
                                                                  
                        
                        header("Location: index.php?action=listRealisateurs");
                                                
                }
        }
        
        require "view/addRealisateur.php";
        }

        public function addFilm(){

                $pdo = Connect :: seConnecter();
                $requeteReal = $pdo->query("
                        SELECT id_realisateur, CONCAT(prenom, ' ', nom) AS realisateur
                        FROM personne p
                        INNER JOIN realisateur r ON p.id_personne = r.id_personne
                ");
        
                $reqGenres = $pdo->query("
                        SELECT *
                        FROM genre                          
                ");
        
        //si on détecte le submit ($_POST["submit])     
        //alors on se connecte à  la base de données
        if(isset($_POST["submit"])) {
                //on filtre le champ role du formulaire (filter_input)
                $titreFilm = filter_input(INPUT_POST, "titre", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $annee_sortie_franceFilm = filter_input(INPUT_POST, "annee_sortie_france", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $duree_minutesFilm = filter_input(INPUT_POST, "duree_minutes", FILTER_SANITIZE_NUMBER_INT);
                $synopsisFilm = filter_input(INPUT_POST, "synopsis", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $noteFilm = filter_input(INPUT_POST, "note", FILTER_SANITIZE_NUMBER_INT);
                $afficheFilm = filter_input(INPUT_POST, "affiche", FILTER_SANITIZE_URL);
                $id_realisateurFilm = filter_input(INPUT_POST, "id_realisateur", FILTER_SANITIZE_NUMBER_INT);
                $id_genreFilm = filter_input(INPUT_POST, "id_genre", FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
                //si le filtre est valide, on prépare la requête d'insertion (INSERT INTO ... VALUES)
                //on exécute la requête en faisant passer le tableau d'arguments
                if($titreFilm && $annee_sortie_franceFilm && $duree_minutesFilm && $synopsisFilm && $noteFilm && $afficheFilm && $id_realisateurFilm && $id_genreFilm) {
                        $pdo = Connect :: seConnecter();
                        $requeteFilm = $pdo->prepare("
                                INSERT INTO film (titre, annee_sortie_france, duree_minutes, synopsis, note, affiche, id_realisateur)
                                VALUES ($titreFilm, 2020, $duree_minutesFilm, $synopsisFilm, $noteFilm, $afficheFilm, $id_realisateurFilm) 
                        ");
                     
                        $requeteFilm->execute([
                                "titre" => $titreFilm,
                                "annee_sortie_france" =>$annee_sortie_franceFilm,
                                "duree_minutes" => $duree_minutesFilm,
                                "synopsis"=> $synopsisFilm,
                                "note"=> $noteFilm,
                                "affiche"=> $afficheFilm,
                                "id_realisateur"=>$id_realisateurFilm,  
                        
                        ]);  
                        var_dump($requeteFilm);
                        die;
                        $lastInsertFilm=$pdo->lastInsertId();
                        foreach($id_genreFilm as $genre){
                                $lastInsertFilmGenres = $pdo->prepare("
                                INSERT INTO associer_genre ( id_film, id_genre)
                                VALUES (:lastInsertFilm, :id_genre)
                                ");

                                $lastInsertFilmGenres->execute([
                                "lastInsertFilm"=>$lastInsertFilm,
                                "id_genre"=> $genre
                                ]);
                        }
                        $requeteFilm=$pdo->prepare("
                                INSERT INTO film ( id_film, id_realisateur)
                                VALUES (:id_film, :id_realisateur)
                                ");

                        $requeteFilm->execute([
                                "id_film" => $lastInsertFilm,
                                "id_realisateur"=> $lastInsertFilm,
                                
                        ]);
                                                
                        
                        //on fait la redirection vers la liste des rôles (header("Location: index.php..."))
                       
                        header("Location: index.php?action=listFilms");

                }
        }

        require "view/addFilm.php";
        }
        

        }

        ?>

