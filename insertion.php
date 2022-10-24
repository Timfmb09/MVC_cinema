<?php
  //connection au serveur
  $cnx = mysql_connect( "localhost", "root", "root" ) ;
 
  //sélection de la base de données:
  $db  = mysql_select_db( "INFOS" ) ;
 
  //récupération des valeurs des champs:
  /
  $nom     = $_POST["nom"] ;

 
  //création de la requête SQL:
  $sql = "INSERT  INTO personnes (nom, prenom, adresse, cp, telephone)
            VALUES ( '$nom', '$prenom', '$adresse', '$cp', '$tel') " ;
 
  //exécution de la requête SQL:
  $requete = mysql_query($sql, $cnx) or die( mysql_error() ) ;
 
  //affichage des résultats, pour savoir si l'insertion a marchée:
  if($requete)
  {
    echo("L'insertion a été correctement effectuée") ;
  }
  else
  {
    echo("L'insertion à échouée") ;
  }
?>