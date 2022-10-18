<?php
/**"Connect.php" on se contente de déclarer la connexion à la base de données */
/**Model va chercher les données auprès de la BDD.
 * "Connect.php"=permettant de se connecter à la BDD (grâce à PDO)*/ 
namespace Model;
/**un namespace permettant de catégoriser virtuellement 
 * (dans un espace de nom la classe en question). 
 * Ainsi on pourra "use" la classe sans connaître son emplacement physique. 
 * On a juste besoin de savoir dans quel namespace elle se trouve */

abstract class Connect {

    const HOST = "localhost";
    const DB = "cinema";
    const USER = "root";
    const PASS = "root";

    public static function seConnecter() {
        try {
            return new \PDO(
                "mysql:host=".self::HOST.";dbname=".self::DB.";charset=utf8", self::USER, self::PASS);
        } catch(\PDOException $ex) {
            return $ex->getMessage();
        }

    }
}
?>