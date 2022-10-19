<!-- "view" = l'ensemble des vues affichant les résultats de nos requêtes-->

<?php ob_start(); ?>
<!--démarre la temporisation de sortie. Tant qu'elle est enclenchée, aucune donnée, 
hormis les en-têtes, n'est envoyée au navigateur, mais temporairement mise en tampon.-->


<p class="uk-label uk-label-warning">Il y a <?= $requete->rowCount()  ?> genres</p>

<table class="uk-label uk-label-striped">
    <thead>
        <tr>
            <th>TITRE</th>
            <th>GENRE</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($requete->fetchAll() as $genre) { ?>
                <tr>
                    <td><?= $genre["titre"] ?></td>
                    <td><?=$genre["genre"] ?></td>
                </tr>
            <?php } ?>
        </tbody>
</table>

<?php

$titre = "Liste des genres";
$titre_secondaire = "Liste des genres";
$contenu = ob_get_clean();
require "view/template.php";

?>