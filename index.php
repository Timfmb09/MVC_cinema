<?php
/**index.php=porte d’entrée qui va assembler les vues nécessaires 
à la demande du visiteur, tout en disposant du layout du site, 
c’est-à-dire des éléments communs à toutes les pages pouvant être 
visitées : logo, menu, pied de page, etc..
"index.php"=va servir à accueillir l'action transmise par l'URL en GET
On aura toujours une URL de la forme :
index.php?action=listFilms
index.php?action=listActeurs
Dans index.php =
- On "use" le controller Cinema
- On autocharge les classes du projet
- On instancie le controller Cinema
Et en fonction de l'action détectée dans l'URL via la propriété "action" 
on interagit avec la bonne méthode du controller*/ 

use Controller\CinemaController;

spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

$ctrlCinema_v2 = new CinemaController();
// $ctrlCinema_V2=nouvelle objet de la class cinema controler

$id = (isset($_GET["id"])) ? $_GET["id"] : null;

if(isset($_GET["action"])){
    switch ($_GET["action"]) {

        case "listFilms" : $ctrlCinema_v2->listFilms(); break;
        case "listActeurs" : $ctrlCinema_v2->listActeurs(); break;
        case "listRealisateurs" : $ctrlCinema_v2->listRealisateurs(); break;
        case "listGenres" : $ctrlCinema_v2->listGenres(); break;
        case "listRoles" : $ctrlCinema_v2->listRoles(); break;
        case "detailFilm" : $ctrlCinema_v2->detailFilm($id); break;
        case "detailActeur" : $ctrlCinema_v2->detailActeur($id); break;
        case "detailRealisateur" : $ctrlCinema_v2->detailRealisateur($id); break;
        case "detailGenre" : $ctrlCinema_v2->detailGenre($id); break;
        case "detailRole" : $ctrlCinema_v2->detailRole($id); break;

    }
}

?>

