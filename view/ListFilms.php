<!-- "view" = l'ensemble des vues affichant les résultats de nos requêtes-->
<?php ob_start(); ?>
<!--démarre la temporisation de sortie. Tant qu'elle est enclenchée, aucune donnée, 
hormis les en-têtes, n'est envoyée au navigateur, mais temporairement mise en tampon.-->

<p>Il y a <?= $requete->rowCount()  ?> films</p>

<table>
    <thead>
        <tr>
            <th>TITRE</th>
            <th>ANNEE SORTIE</th>
            <th>DETAIL DU FILM</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($requete->fetchAll() as $film) { ?>
                <tr>
                    <td><?= $film["titre"] ?></td>
                    <td><?=$film["annee_sortie_france"] ?></td>
                    <td> <a href="index.php?action=detailFilm&id=<?php echo $film["id_film"] ?>">+</a></td> 
                </tr>
            <?php } ?>
        </tbody>
</table>

<?php

$titre = "Liste des films";
$titre_secondaire = "Liste des films";
$contenu = ob_get_clean();
require "view/template.php";

?>