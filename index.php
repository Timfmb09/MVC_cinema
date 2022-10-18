<?php
/**index.php=porte d’entrée qui va assembler les vues nécessaires 
à la demande du visiteur, tout en disposant du layout du site, 
c’est-à-dire des éléments communs à toutes les pages pouvant être 
visitées (logo, menu, pied de page, etc.).
"index.php"=va servir à accueillir l'action transmise par l'URL (en GET)
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

$ctrlCinema = new CinemaController();

if(isset($_GET["action"])){
    switch ($_GET["action"]) {

        case "listFilms" : $ctrlCinema->listFilms(); break;
        case "detailFilms" : $ctrlCinema->detailFilms($id); break;
        case "listActeurs" : $ctrlCinema->listActeurs(); break;

    }
}

?>

