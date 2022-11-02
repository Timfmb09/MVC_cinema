<?php ob_start(); ?>

<html>
  <head>
    <title>add</title>
  </head>
<body>
  <form name="add" action="index.php?action=addFilm" method="POST">
      <input type="text" name="nom">
      <input type="text" name="prenom">
      <input type="text" name="sexe">
       <input type="date" name="date_naissance">
  <tr align="center">
      <td colspan="2"><input type="submit" name="submit" class="btn" value="Ajouter"></td>
  </tr>
  </table>
  </form>
</body>
</html>
<?php

$titre = "Ajout Acteur";
$titre_secondaire = "Ajout Acteur";
$contenu = ob_get_clean();
require "view/template.php";

?>