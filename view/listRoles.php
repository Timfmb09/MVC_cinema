<!-- "view" = l'ensemble des vues affichant les résultats de nos requêtes-->

<?php ob_start(); ?>
<!--démarre la temporisation de sortie. Tant qu'elle est enclenchée, aucune donnée, 
hormis les en-têtes, n'est envoyée au navigateur, mais temporairement mise en tampon.-->


<p>Il y a <?= $requete->rowCount()  ?> roles</p>

<table>
    <thead>
        <tr>
            <th>ROLE</th>
            <th>DETAIL DU ROLE</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($requete->fetchAll() as $role) { ?>
                <tr>
                    <td><?=$role["nom_role"] ?></td>
                    <td> <a href="index.php?action=detailRole&id=<?php echo $role["id_role"] ?>">+</a></td> 
                </tr>
            <?php } ?>
        </tbody>
</table>

<html>
  <head>
    <title>insertion de données en PHP :: partie 1</title>
  </head>
<body>
<form name="insertion" action="insertion2.php" method="POST">
  <table border="0" align="left" cellspacing="2" cellpadding="2">
    <tr align="left">
      <td>Ajouter un nouveau rôle</td>
      <td><input type="text" name="role"></td>
    </tr>
     
    <tr align="left">
      <td colspan="2"><input type="submit" value="Insérer"></td>
    </tr>
  </table>
</form>
</body>
</html>

<?php

$titre = "Liste des roles";
$titre_secondaire = "Liste des roles";
$contenu = ob_get_clean();
require "view/template.php";

?>