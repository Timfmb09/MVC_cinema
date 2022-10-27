<!-- "view" = l'ensemble des vues affichant les résultats de nos requêtes-->

<?php ob_start(); 


$film = $requetefilm->fetch();
echo "<h3>Réalisé par</h3>".$film["realisateur"];
echo "<h3>Durée du film </h3>".$film["duree"];
echo "<h3>Année de sortie </h3>".$film["annee"];
echo "<h3>Note </h3>".$film["note"]."<br>";
?>
<img src="<?php echo $film['affiche']?>" alt="affiche">
<?php 
$castings = $requetecasting->fetchAll();

echo "<h2>Casting </h2>";
foreach ($castings AS $casting) {
    echo "- ".$casting["acteur"]."(".$casting["role"].")<br>";
}
?>

<?php

$titre = "Détail du film".$film["titre"];
$titre_secondaire = $film["titre"];
$contenu = ob_get_clean();
require "view/template.php";

?>