<?php

class Database
{

    public function connectionDB()
    {
        $db_host = "127.0.0.1";
        $db_name = "words";
        $db_user = "lubomirhlavina";
        $db_password = "admin12345";

        $connection = "mysql:host=" . $db_host . ";dbname=" . $db_name . ";charset=utf8";

        try {
            // PDO - OOP spôsob pripojenia sa do databázy
            // vytvárame konstruktor (new) a objekt $db
            // v $connection už mám (hore) $db_host a $db_name, takže už len dole pridám $db_user a $db_password
            $db = new PDO($connection, $db_user, $db_password);
            // Akým spôsobom sa má vysporriadať s chybami (stačí skopírovať)
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }

    }

}
