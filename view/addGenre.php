<?php ob_start(); ?>

<html>
  <head>
    <title>add</title>
  </head>
<body>
<form name="add" action="" method="POST">
  <table border="0" align="left" cellspacing="2" cellpadding="2">
    <tr align="left">
      <td>Genre</td>
      <td><input type="text" name="nom_genre"></td>
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