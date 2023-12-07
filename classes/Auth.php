<?php

class Auth {

    public static function isLoggedIn() {
        // Zistuje, či je session k dispozícii a či je užívateľ prihlásený
        return isset($_SESSION["is_logged_in"]) and $_SESSION["is_logged_in"];
    }

}