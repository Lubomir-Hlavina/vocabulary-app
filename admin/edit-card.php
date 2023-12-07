<?php

require "../classes/Database.php";
require "../classes/Url.php";
require "../classes/Card.php";
require "../classes/Auth.php";

session_start();

if (!Auth::isLoggedIn()) {
    die("Nepovolený přístup");
}

$database = new Database();
$connection = $database->connectionDB();

if (isset($_GET["id"])) {
    $one_card = Card::getCard($connection, $_GET["id"]);

    if ($one_card) {
        $first_language = $one_card["first_language"];
        $second_language = $one_card["second_language"];
        $id = $one_card["id"];

    } else {
        die("Karta nenájdená");
    }

} else {
    die("ID nie je zadané, karta nebola nájdená");
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_language = $_POST["first_language"];
    $second_language = $_POST["second_language"];


    if (Card::updateCard($connection, $first_language, $second_language, $id)) {
        // Url::redirectUrl("/words/admin/one-card.php?id=$id");
        Url::redirectUrl("/words/admin/cards.php");
    }
    ;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../query/header-query.css">
    <link rel="stylesheet" href="../css/footer.css">
    <script src="https://kit.fontawesome.com/0fe3234472.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../css/admin-edit-card.css">
    <link rel="stylesheet" href="../query/admin-edit-card-query.css">

    <title>Document</title>
</head>

<body>
    <?php require "../assets/admin-header.php"; ?>

    <main>
        <?php

        require "../assets/form-card.php";
        ?>
    </main>


    <?php require "../assets/footer.php"; ?>
    <script src="../js/header.js"></script>
</body>

</html>