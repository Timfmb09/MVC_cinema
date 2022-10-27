<!-- "view" = l'ensemble des vues affichant les résultats de nos requêtes-->

<?php ob_start(); 

$acteur = $requeteacteur->fetch();
echo " <h3>L'acteur</h3>".$acteur["acteur"];
echo " <h3>Né le</h3>".$acteur["date"];

$filmographies = $requetefilmographie->fetchAll();
echo " <h3>A joué dans les films suivants :</h3>";
foreach ($filmographies AS $filmographie) {
    echo $filmographie["titre"]."<br>";
    
}
?>

<?php

$titre = "Détail de l'acteur".$acteur["acteur"];
$titre_secondaire = $acteur["acteur"];
$contenu = ob_get_clean();
require "view/template.php";

?>