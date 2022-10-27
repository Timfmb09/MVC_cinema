<?php ob_start(); ?>

<html>
  <head>
    <title>add</title>
  </head>
<body>
<form name="add" action="" method="POST">
  <table border="0" align="left" cellspacing="2" cellpadding="2">
    <tr align="left">
      <td>Film</td>
      <td><input type="text" name="titre"></td> 
      <td><input type="date" name="annee_sortie_france"></td>
      <td><input type="number" name="duree_minutes"></td>
      <td><input type="text" name="synopsis"></td>
      <td><input type="number" name="note"></td>
      <td><input type="text" name="affiche"></td>
      <td>
        <select name="id_realisateur">
          <option value="default">Par défaut</option>
          <?php
          // $realisateurs = $requeteRealisateur->fetchAll();
          //   foreach ($realisateurs AS $realisateur){
          //   echo "<option value=".$realisateur ['id_realisateur '].">".$realisateur ['nom']."</option>";
          //   }
          ?>
        </select>
      </td>
    </tr>
    <tr align="left">
      <td colspan="2"><input type="submit" name="submit" class="btn" value="Ajouter"></td>
    </tr>
  </table>
</form>
</body>
</html>
<?php

$titre = "Ajout";
$titre_secondaire = "Ajout";
$contenu = ob_get_clean();
require "view/template.php";

?>