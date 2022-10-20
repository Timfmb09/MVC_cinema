<!-- "view" = l'ensemble des vues affichant les résultats de nos requêtes-->

<?php ob_start(); 

$acteur = $requete->fetch();
echo $acteur["acteur"]."\n";


?>

<?php

$titre = "Détail de l'acteur".$acteur["nom"];
$titre_secondaire = $acteur["nom"];
$contenu = ob_get_clean();
require "view/template.php";

?>