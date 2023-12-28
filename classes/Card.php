<?php

class Card
{

    public static function getCard($connection, $id, $columns = "*")
    {
        $sql = "SELECT $columns
                FROM card
                WHERE id = :id";

        $stmt = $connection->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        try {
            if ($stmt->execute()) {
                return $stmt->fetch();
            } else {
                throw new Exception("Získanie dát o karte zlyhalo");
            }
        } catch (Exception $e) {
            error_log("Chyba vo funkii getCard, získanie dát zlyhalo\n", 3, "../errors/error.log");
            echo "Typ chyby: " . $e->getMessage();
        }

    }


    public static function updateCard($connection, $first_language, $second_language, $id)
    {

        $sql = "UPDATE card
                    SET first_language = :first_language,
                        second_language = :second_language
                    WHERE id = :id";

        $stmt = $connection->prepare($sql);

        $stmt->bindValue(":first_language", $first_language, PDO::PARAM_STR);
        $stmt->bindValue(":second_language", $second_language, PDO::PARAM_STR);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        try {
            if ($stmt->execute()) {
                return true;
            } else {
                throw new Exception("Update karty se neuskutočnil");
            }
        } catch (Exception $e) {
            error_log("Chyba vo funkcii updateCard\n", 3, "../errors/error.log");
            echo "Typ chyby: " . $e->getMessage();
        }
    }


    public static function deleteCard($connection, $id)
    {
        $sql = "DELETE
                FROM card
                WHERE id = :id";

        $stmt = $connection->prepare($sql);

        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        try {
            if ($stmt->execute()) {
                return true;
            } else {
                throw new Exception("Vymazanie karty zlyhalo");
            }
        } catch (Exception $e) {
            error_log("Chyba vo funkcii deleteCard\n", 3, "../errors/error.log");
            echo "Typ chyby: " . $e->getMessage();
        }
    }


    public static function getUserCards($connection, $columns = "*")
    {
        $sql = "SELECT $columns FROM user_card u JOIN card c ON c.id = u.card_id AND u.user_id=" . $_SESSION['logged_in_user_id'];

        $stmt = $connection->prepare($sql);

        try {
            if ($stmt->execute()) {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                throw new Exception("Získanie vašich kariet zlyhalo");
            }
        } catch (Exception $e) {
            error_log("Chyba vo funkcii getUserCards\n", 3, "../errors/error.log");
            echo "Typ chyby: " . $e->getMessage();
        }
    }


    public static function createCard($connection, $first_language, $second_language)
    {

        $sql = "INSERT INTO card (first_language, second_language) 
        VALUES (:first_language, :second_language)";

        $stmt = $connection->prepare($sql);


        $stmt->bindValue(":first_language", $first_language, PDO::PARAM_STR);
        $stmt->bindValue(":second_language", $second_language, PDO::PARAM_STR);

        try {
            if ($stmt->execute()) {
                $id = $connection->lastInsertId();
                self::insertIntoUserCard($connection, $id);
                return $id;
            } else {
                throw new Exception("Vytvorenie karty zlyhalo");
            }
        } catch (Exception $e) {
            error_log("Chyba vo funkcii createCard\n", 3, "../errors/error.log");
            echo "Typ chyby: " . $e->getMessage();
        }
    }

    public static function insertIntoUserCard($connection, $cardId)
    {

        $sql = "INSERT INTO user_card VALUES(:1, :2)";
        $stmt = $connection->prepare($sql);

        $stmt->bindValue(":1", $_SESSION['logged_in_user_id'], PDO::PARAM_INT);
        $stmt->bindValue(":2", $cardId, PDO::PARAM_INT);

        try {
            if ($stmt->execute()) {

            } else {
                throw new Exception("Vloženie karty zlyhalo");
            }
        } catch (Exception $e) {
            error_log("Chyba vo funkcii insertIntoCardCard\n", 3, "../errors/error.log");
            echo "Typ chyby: " . $e->getMessage();
        }
    }

    public static function getRandomCard($connection, $columns = "*")
    {
        $sql = "SELECT $columns FROM user_card u JOIN card c ON c.id = u.card_id AND u.user_id=" . $_SESSION['logged_in_user_id'] . " ORDER BY RAND() LIMIT 1";

        $stmt = $connection->prepare($sql);

        try {
            if ($stmt->execute()) {
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                throw new Exception("Získanie náhodnej karty zlyhalo");
            }
        } catch (Exception $e) {
            error_log("Chyba vo funkcii getRandomCard\n", 3, "../errors/error.log");
            echo "Typ chyby: " . $e->getMessage();
        }
    }

    public static function getNextCardID($connection, $currentCardID)
    {
        $sql = "SELECT c.id
                FROM user_card u
                JOIN card c ON c.id = u.card_id
                WHERE c.id > :currentCardID
                AND u.user_id = :user_id
                ORDER BY c.id ASC
                LIMIT 1";
    
        return self::getAdjacentCardID($connection, $sql, $currentCardID);
    }

    public static function getPreviousCardID($connection, $currentCardID)
    {
        $sql = "SELECT c.id
                FROM user_card u
                JOIN card c ON c.id = u.card_id
                WHERE c.id < :currentCardID
                AND u.user_id = :user_id
                ORDER BY c.id DESC
                LIMIT 1";
    
        return self::getAdjacentCardID($connection, $sql, $currentCardID);
    }

    private static function getAdjacentCardID($connection, $sql, $currentCardID)
    {
        $stmt = $connection->prepare($sql);
        $stmt->bindValue(":currentCardID", $currentCardID, PDO::PARAM_INT);
        $stmt->bindValue(":user_id", $_SESSION['logged_in_user_id'], PDO::PARAM_INT);
    
        try {
            if ($stmt->execute()) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result ? $result['id'] : $currentCardID;
            } else {
                throw new Exception("Získanie ID susednej karty zlyhalo");
            }
        } catch (Exception $e) {
            error_log("Chyba vo funkcii getAdjacentCardID\n", 3, "../errors/error.log");
            echo "Typ chyby: " . $e->getMessage();
        }
    }
    

}

