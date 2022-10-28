<?php ob_start(); ?>

<html>
  <head>
    <title>add</title>
  </head>
<body>
<form name="add" action="" method="POST">   
      <input type="text" name="titre">
      <input type="date" name="annee_sortie_france">
      <input type="number" name="duree_minutes">
      <input type="text" name="synopsis">
      <input type="number" name="note">
      <input type="text" name="affiche">
      
        <select name="id_realisateur">
          <option value="default">Par défaut</option>
          <?php
            foreach ($requeteReal->fetchAll() AS $realisateur){
            echo "<option value=".$realisateur ['id_realisateur'].">".$realisateur ['realisateur']."</option>";
            }
          ?>
        </select>
     
        <select name="id_genre">
          <option value="default">Par défaut</option>
          <?php
            foreach ($reqGenres->fetchAll() AS $genre){
            echo "<option value=".$genre ['id_genre'].">".$genre ['genre']."</option>";
            }
          ?>


        </select>    
      
      <td colspan="2"><input type="submit" name="submit" class="btn" value="Ajouter"></td>

    </form>
</body>
</html>
<?php

$titre = "Ajout Film";
$titre_secondaire = "Ajout Film";
$contenu = ob_get_clean();
require "view/template.php";

?>