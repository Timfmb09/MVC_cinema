<!--"view"=affiche les résultats de nos requêtes.

<?php ob_start(); //démarre la temporisation de sortie

$role = $requeterole->fetch();
echo $role["nom_role"]."<br>";


$filmroles = $requetefilmrole->fetchAll();

foreach ($filmroles AS $filmrole) {
    echo $filmrole["titre"]."<br>";
    echo $filmrole["nom_role"]."<br>";
}
?>

<?php

$titre = "Détail des roles".$role["nom_role"];
$titre_secondaire = $role["nom_role"];
$contenu = ob_get_clean();//Retourne le contenu du tampon de sortie 
//et termine la session de temporisation. Si la temporisation n'est pas activée, 
//alors false sera retourné.
require "view/template.php";

?>