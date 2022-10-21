<!-- "view" = l'ensemble des vues affichant les résultats de nos requêtes-->

<?php ob_start(); ?>
<!--démarre la temporisation de sortie. Tant qu'elle est enclenchée, aucune donnée, 
hormis les en-têtes, n'est envoyée au navigateur, mais temporairement mise en tampon.-->


<p>Il y a <?= $requete->rowCount()  ?> roles</p>

<table>
    <thead>
        <tr>
            <th>TITRE</th>
            <th>ROLE</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($requete->fetchAll() as $role) { ?>
                <tr>
                    <td><?= $role["titre"] ?></td>
                    <td><?=$role["nom_role"] ?></td>
                </tr>
            <?php } ?>
        </tbody>
</table>

<?php

$titre = "Liste des roles";
$titre_secondaire = "Liste des roles";
$contenu = ob_get_clean();
require "view/template.php";

?>