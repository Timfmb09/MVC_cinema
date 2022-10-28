<?php
// CONNECT permet de se connecter à la BDD grâce à PDO (PHP Data Objects).
// ICI on déclare la connexion à la BDD.

namespace Model;// namespace, permet de dire "je travaille dans ce dossier".
// "Model"= va chercher les données auprès de la BDD.

abstract class Connect {

    const HOST = "localhost";
    const DB = "cinema_v2";
    const USER = "root";
    const PASS = "";

    public static function seConnecter() {//Indique le chemin de connection
        try {
            return new \PDO(
                "mysql:host=".self::HOST.";dbname=".self::DB.";charset=utf8", self::USER, self::PASS);
        } catch(\PDOException $ex) { //renvoi au message d'erreur si il n'arrive pas a se connecter.
            return $ex->getMessage();
        }

    }
}
?>