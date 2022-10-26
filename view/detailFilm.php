<!-- "view" = l'ensemble des vues affichant les résultats de nos requêtes-->

<?php ob_start(); 



$film = $requetefilm->fetch();
echo "<h3>Réalisé par</h3>".$film["realisateur"];
echo "<h3>Durée du film </h3>".$film["duree"];
echo "<h3>Année de sortie </h3>".$film["annee"];
echo "<h3>Note </h3>".$film["note"];

$castings = $requetecasting->fetchAll();

foreach ($castings AS $casting) {
    echo "<h3>L'acteur </h3>".$casting["acteur"]."<h3>A joué dans le rôle de  </h3>".$casting["role"];
}
?>
<?php

function mon_image(){
  return '<img src="aff2.jpg" alt="mon image" />';
}

?>
<?php

$titre = "Détail du film".$film["titre"];
$titre_secondaire = $film["titre"];
$contenu = ob_get_clean();
require "view/template.php";

?>