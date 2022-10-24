<!-- "view" = l'ensemble des vues affichant les résultats de nos requêtes-->

<?php ob_start(); ?>

<p>Il y a <?= $requete->rowCount()  ?> acteurs </p>

<table>
    <thead>
        <tr>
            <th>NOM</th>
            <th>PRENOM</th>
            <th>DETAIL DE L'ACTEUR</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($requete->fetchAll() as $acteur) { ?>
                <tr>
                    <td><?= $acteur["nom"] ?></td>
                    <td><?=$acteur["prenom"] ?></td>
                    <td> <a href="index.php?action=detailActeur&id=<?php echo $acteur["id_acteur"] ?>">+</a></td> 
                </tr>
            <?php } ?>
        </tbody>
</table>

<?php

$titre = "Liste des acteurs";
$titre_secondaire = "Liste des acteurs";
$contenu = ob_get_clean();
require "view/template.php";

?>