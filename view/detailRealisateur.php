<!--"view"=affiche les résultats de nos requêtes.

<?php ob_start(); //démarre la temporisation de sortie

$realisateur = $requeterealisateur->fetch();
echo " <h3>Le réalisateur</h3>".$realisateur["prenom"];
echo $realisateur["nom"]."<br>";

$filmographies = $requetefilmographie->fetchAll();

foreach ($filmographies AS $filmographie) {
    echo " <h3>A joué dans le film</h3>".$filmographie["titre"]."<br>";
    echo " <h3>En</h3>".$filmographie["annee"]."<br>";


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