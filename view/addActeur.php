<?php ob_start(); ?>

<html>
  <head>
    <title>add</title>
  </head>
<body>
<form name="add" action="" method="POST">
  <table border="0" align="left" cellspacing="2" cellpadding="2">
    <tr align="left">
      <td>Acteur</td>
      <td><input type="text" name="nom"></td>
      <td><input type="text" name="prenom"></td>
      <td><input type="text" name="sexe"></td>
      <td><input type="date" name="date_naissance"></td>
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