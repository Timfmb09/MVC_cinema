<!--"view"=affiche les résultats de nos requêtes.

<?php ob_start(); //démarre la temporisation de sortie

$realisateur = $requeterealisateur->fetch();
echo $realisateur["nom"]."<br>";
echo $realisateur["prenom"]."<br>";

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

$titre = "Détail du réalisateur".$realisateur["nom"];
$titre_secondaire = $realisateur["prenom"];
$contenu = ob_get_clean();//Retourne le contenu du tampon de sortie 
//et termine la session de temporisation. Si la temporisation n'est pas activée, 
//alors false sera retourné.
require "view/template.php";

?>