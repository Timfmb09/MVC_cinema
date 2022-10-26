<?php ob_start(); ?>
<!--démarre la temporisation de sortie. Tant qu'elle est enclenchée, aucune donnée, 
hormis les en-têtes, n'est envoyée au navigateur, mais temporairement mise en tampon.-->

<table>
    <thead>  
        <tr>
            <th>TITRE</th>
            <th>ANNEE SORTIE</th>
            <th>DETAIL DU FILM</th>
        </tr>
    </thead>
    <tbody>
                <tr>
                    <td> <a href="index.php?action=Ajout nouveau role=<?php echo $film["id_film"] ?>">+</a></td> 
                </tr>
    </tbody>
</table>

<?php

$titre = "Liste des films";
$titre_secondaire = "Liste des films";
$contenu = ob_get_clean();
require "view/template.php";

?>