<!-- "view" = l'ensemble des vues affichant les résultats de nos requêtes-->

<?php ob_start(); 

$acteur = $requeteacteur->fetch();
echo $acteur["acteur"]."<br>";
echo $acteur["sexe"]."<br>";
echo $acteur["date"]."<br>";

$filmographies = $requetefilmographie->fetchAll();

foreach ($filmographies AS $filmographie) {
    echo $filmographie["titre"]."<br>";
    echo $filmographie["annee"]."<br>";
    echo $filmographie["duree"]."<br>";
    echo $filmographie["realisateur"]."<br>";
    echo $filmographie["note"]."<br>";

}
?>

<?php

$titre = "Détail de l'acteur".$acteur["acteur"];
$titre_secondaire = $acteur["acteur"];
$contenu = ob_get_clean();
require "view/template.php";

?>