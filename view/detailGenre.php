<!--"view"=affiche les résultats de nos requêtes.

<?php ob_start(); //démarre la temporisation de sortie

$genre = $requetegenre->fetch();
echo $genre["nom_genre"]."<br>";


$filmgenres = $requetefilmgenre->fetchAll();

foreach ($filmgenres AS $filmgenre) {
    echo $filmgenre["titre"]."<br>";
}
?>

<?php

$titre = "Détail des genres".$genre["nom_genre"];
$titre_secondaire = $genre["nom_genre"];
$contenu = ob_get_clean();//Retourne le contenu du tampon de sortie 
//et termine la session de temporisation. Si la temporisation n'est pas activée, 
//alors false sera retourné.
require "view/template.php";

?>