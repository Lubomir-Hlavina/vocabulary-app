<?php

require "../classes/Database.php";
require "../classes/Url.php";
require "../classes/Card.php";
require "../classes/Auth.php";

session_start();

if(!Auth::isLoggedIn()) {
    die("Nepovolený přístup");
}

$database = new Database();
$connection = $database->connectionDB();

if($_SERVER["REQUEST_METHOD"] === "POST") {
    if(card::deleteCard($connection, $_GET["id"])) {
        Url::redirectUrl("/words/admin/cards.php");
    }
    ;
}

?>

<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../query/header-query.css">
    <link rel="stylesheet" href="../css/footer.css">
    <script src="https://kit.fontawesome.com/0fe3234472.js" crossorigin="anonymous"></script>


    <link rel="stylesheet" href="../css/admin-delete-card.css">

    <title>Kartičky</title>
</head>

<body>
    <?php require "../assets/admin-header.php"; ?>

    <main>
        <?php ?>
        <section class="delete-form">
            <form method="POST">
                <p>Naozaj chcete túto kartu zmazať??</p>
                <div class="btns">
                    <button>Zmazať</button>
                    <a href="one-card.php?id=<?= $_GET['id'] ?>">Zrušiť</a>
                </div>

            </form>
        </section>
    </main>

    <?php require "../assets/footer.php"; ?>
    <script src="../js/header.js"></script>
</body>

</html>