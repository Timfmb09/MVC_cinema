<!--"view"=affiche les résultats de nos requêtes.

<?php ob_start(); //démarre la temporisation de sortie

$role = $requeterole->fetch();


echo " <h3>Description </h3></br>".$role["descrip_role"]."<br>";

$filmroles = $requetefilmrole->fetchAll();

foreach ($filmroles AS $filmrole) {
    echo " <h3>Nom du film </h3></br>".$filmrole["titre"]."<br>";
    echo " <h3>Liste des acteurs </h3></br>".$filmrole["acteur"]."<br>";
 }
?>

<?php

$titre = "Détail des roles".$filmrole["titre"];
$titre_secondaire = $role["nom_role"];
$contenu = ob_get_clean();//Retourne le contenu du tampon de sortie 
//et termine la session de temporisation. Si la temporisation n'est pas activée, 
//alors false sera retourné.
require "view/template.php";

?>