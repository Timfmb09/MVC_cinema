<?php ob_start(); ?>

<html>
  <head>
    <title>add</title>
  </head>
<body>
<form name="add" action="CinemaController.php" method="POST">
  <table border="0" align="center" cellspacing="2" cellpadding="2">
    <tr align="center">
      <td>role</td>
      <td><input type="text" name="role"></td>
    </tr>
    <tr align="center">
      <td>genre</td>
      <td><input type="text" name="genre"></td>
    </tr>
    <tr align="center">
      <td>acteur</td>
      <td><input type="text" name="acteur"></td>
    </tr>
    <tr align="center">
      <td>réalisateur</td>
      <td><input type="text" name="réalisateur"></td>
    </tr>
    <tr align="center">
      <td>film</td>
      <td><input type="text" name="film"></td>
    </tr>
 
    <tr align="center">
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