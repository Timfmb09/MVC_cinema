<!-- "view" = l'ensemble des vues affichant les résultats de nos requêtes-->

<?php ob_start(); ?>

<p class="uk-label uk-label-warning">Il y a <?= $requete->rowCount()  ?> acteurs </p>

<table class="uk-label uk-label-striped">
    <thead>
        <tr>
            <th>NOM</th>
            <th>PRENOM</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($requete->fetchAll() as $acteur) { ?>
                <tr>
                    <td><?= $acteur["nom"] ?></td>
                    <td><?=$acteur["prenom"] ?></td>
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