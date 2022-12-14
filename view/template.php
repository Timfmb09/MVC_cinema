<!--"template.php"=servira de base/squelette à l'ensemble des vues.
Déclaration du doctype, links css, js etc qu'une seule fois.-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title><?= $titre ?></title>
</head>
<body>


    <nav class="uk-navbar-container uk-navbar uk-stripos"  >
        <ul>
            <li><a href="index.php?action=listFilms">Films</a></li>
            <li><a href="index.php?action=listActeurs">Acteurs</a></li>
            <li><a href="index.php?action=listRealisateurs">Realisateurs</a></li>
            <li><a href="index.php?action=listGenres">Genres</a></li>
            <li><a href="index.php?action=listRoles">Roles</a></li>
            <li><a href="index.php?action=addRole">Add Role</a></li>
            <li><a href="index.php?action=addGenre">Add Genre</a></li>
            <li><a href="index.php?action=addActeur">Add Acteur</a></li>
            <li><a href="index.php?action=addRealisateur">Add Realisateur</a></li>
            <li><a href="index.php?action=addFilm">Add Film</a></li>
                        
        </ul>
    </nav>
    <div id="wrapper" class="uk-container uk-container-expand" >
        <main>
            <div id="contenu">
                <h1 class="uk-heading-devider">Cinema</h1>
                <h2 class="uk-heading-bullet"><?= $titre_secondaire ?></h2>
                <?= $contenu ?>
            </div>
        </main>
    </div>
</body>
</html>

