<!-- "view" = l'ensemble des vues affichant les résultats de nos requêtes-->

<?php ob_start(); ?>
<!--démarre la temporisation de sortie. Tant qu'elle est enclenchée, aucune donnée, 
hormis les en-têtes, n'est envoyée au navigateur, mais temporairement mise en tampon.-->


<p>Il y a <?= $requete->rowCount()  ?> realisateurs</p>

<table>
    <thead>
        <tr>
            <th>NOM</th>
            <th>PRENOM</th>
            <th>DETAIL DU REALISATEUR</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($requete->fetchAll() as $realisateur) { ?>
                <tr>
                    <td><?= $realisateur["nom"] ?></td>
                    <td><?=$realisateur["prenom"] ?></td>
                    <td> <a href="index.php?action=detailRealisateur&id=<?php echo $realisateur["id_realisateur"] ?>">+</a></td> 
                </tr>
            <?php } ?>
        </tbody>
</table>

<?php

$titre = "Liste des realisateurs";
$titre_secondaire = "Liste des realisateurs";
$contenu = ob_get_clean();
require "view/template.php";

?>