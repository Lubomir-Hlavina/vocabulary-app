<?php

class User {

    public static function createUser($connection, $first_name, $second_name, $email, $password) {

        $sql = "INSERT INTO user (first_name, second_name, email, password) 
        VALUES (:first_name, :second_name, :email, :password)";

        $stmt = $connection->prepare($sql);

        $stmt->bindValue(":first_name", $first_name, PDO::PARAM_STR);
        $stmt->bindValue(":second_name", $second_name, PDO::PARAM_STR);
        $stmt->bindValue(":email", $email, PDO::PARAM_STR);
        $stmt->bindValue(":password", $password, PDO::PARAM_STR);

        try {
            if($stmt->execute()) {
                $id = $connection->lastInsertId();
                return $id;
            } else {
                throw new Exception("vytvorenie užívateľa zlyhalo");
            }
        } catch (Exception $e) {
            // To prvé nám dá automaticky do toho priečinka error, kde smerujeme. Táto 3 znamená, že chyby bude ukladať do kódu a potom je tam cesta kde budú
            error_log("Chyba vo funkcii createUser\n", 3, "../errors/error.log");
            echo "Typ chyby: ".$e->getMessage();
        }
    }


    public static function authentication($connection, $log_email, $log_password) {
        $sql = "SELECT password
                FROM user
                WHERE email = :email";

        $stmt = $connection->prepare($sql);


        $stmt->bindValue(":email", $log_email, PDO::PARAM_STR);

        try {
            if($stmt->execute()) {
                if($user = $stmt->fetch()) {
                    return password_verify($log_password, $user[0]);
                }
            } else {
                throw new Exception("Autentikácia se nepodarila");
            }
        } catch (Exception $e) {
            error_log("Chyba vo funkcii authentication\n", 3, "../errors/error.log");
            echo "Typ chyby: ".$e->getMessage();
        }
    }


    public static function getUserId($connection, $email) {
        $sql = "SELECT id FROM user
                WHERE email = :email";

        $stmt = $connection->prepare($sql);
        $stmt->bindValue(":email", $email, PDO::PARAM_STR);

        try {
            if($stmt->execute()) {
                $result = $stmt->fetch();
                $user_id = $result[0];
                return $user_id;
            } else {
                throw new Exception("Získanie ID užívateľa sa nepodarilo");
            }
        } catch (Exception $e) {
            error_log("Chyba vo funkcii getUserId\n", 3, "../errors/error.log");
            echo "Typ chyby: ".$e->getMessage();
        }
    }

}



