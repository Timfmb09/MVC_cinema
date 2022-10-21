<!-- "view" = l'ensemble des vues affichant les résultats de nos requêtes-->

<?php ob_start(); 

$film = $requetefilm->fetch();
echo $film["realisateur"]."<br>";
echo $film["duree"]."<br>";
echo $film["annee"]."<br>";
echo $film["note"]."<br>";

$castings = $requetecasting->fetchAll();

foreach ($castings AS $casting) {
    echo $casting["acteur"]."<br>"."<br>";
    echo $casting["role"]."<br>"."<br>";
}
?>

<?php

$titre = "Détail du film".$film["titre"];
$titre_secondaire = $film["titre"];
$contenu = ob_get_clean();
require "view/template.php";

?>