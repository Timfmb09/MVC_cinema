<!-- "view" = l'ensemble des vues affichant les résultats de nos requêtes-->

<?php ob_start(); 

$film = $requete->fetch();
echo $film["realisateur"]."\n";
echo $film["duree"]."\n";
echo $film["annee"]."\n";
echo $film["note"]."\n";
?>

<?php

$titre = "Détail du film".$film["titre"];
$titre_secondaire = $film["titre"];
$contenu = ob_get_clean();
require "view/template.php";

?>