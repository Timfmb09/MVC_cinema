<?php ob_start(); ?>

<html>
  <head>
    <title>add</title>
  </head>
<body>
<form name="add" action="" method="POST">
    <input type="text" name="nom_role">
    <textarea name="descrip_role" id="" cols="30" rows="10">
    </textarea>
    <tr align="left">
      <td colspan="2"><input type="submit" name="submit" class="btn" value="Ajouter"></td>
    </tr>
  </table>
</form>
</body>
</html>
<?php

$titre = "Ajout Role";
$titre_secondaire = "Ajout Role";
$contenu = ob_get_clean();
require "view/template.php";

?>