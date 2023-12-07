<?php

require "../classes/Database.php";
require "../classes/Url.php";
require "../classes/Card.php";
require "../classes/Auth.php";

session_start();

if (!Auth::isLoggedIn()) {
    die("Nepovolený prístup");
}

$first_language = null;
$second_language = null;


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $first_language = $_POST["first_language"];
    $second_language = $_POST["second_language"];

    $database = new Database();
    $connection = $database->connectionDB();

    $id = Card::createCard($connection, $first_language, $second_language);

    if ($id) {
        Url::redirectUrl("/words/admin/cards.php?id=$id");
    } else {
        echo "Karta nebola vytvorená";
    }
}

?>

<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../query/header-query.css">
    <link rel="stylesheet" href="../css/footer.css">
    <script src="https://kit.fontawesome.com/0fe3234472.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../css/admin-add-card.css">
    <link rel="stylesheet" href="../query/admin-add-card-query.css">

    <title>Kartičky</title>
</head>

<body>
    <?php require "../assets/admin-header.php"; ?>

    <main>
        <section class="add-form">

            <?php require "../assets/form-card.php"; ?>

        </section>
    </main>

    <?php require "../assets/footer.php"; ?>
    <script src="../js/header.js"></script>
</body>

</html>