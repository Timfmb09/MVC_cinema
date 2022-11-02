<?php ob_start(); ?>

<html>
  <head>
    <title>add</title>
  </head>
<body>
<form name="add" action="" method="POST">
      <input type="text" name="nom">
      <input type="text" name="prenom">
      <input type="text" name="sexe">
      <input type="date" name="date_naissance">     
        <tr align="left">
          <td colspan="2"><input type="submit" name="submit" class="btn" value="Ajouter"></td>
        </tr>
 </form>
</body>
</html>
<?php

$titre = "Ajout Realisateur";
$titre_secondaire = "Ajout Realisateur";
$contenu = ob_get_clean();
require "view/template.php";

?>