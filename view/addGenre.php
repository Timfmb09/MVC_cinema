<?php ob_start(); ?>

<html>
  <head>
    <title>add</title>
  </head>
<body>
<form name="add" action="" method="POST">
    <input type="text" name="nom_genre">
    <tr align="left">
      <td colspan="2"><input type="submit" name="submit" class="btn" value="Ajouter"></td>
    </tr>
  </table>
</form>
</body>
</html>
<?php

$titre = "Ajout Genre";
$titre_secondaire = "Ajout Genre";
$contenu = ob_get_clean();
require "view/template.php";

?>