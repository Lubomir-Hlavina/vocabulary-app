<?php

require "../classes/Database.php";
require "../classes/Card.php";
require "../classes/Auth.php";

session_start();

if (!Auth::isLoggedIn()) {
    die("Nepovolený přístup");
}


// $connection = connectionDB();
$database = new Database();
$connection = $database->connectionDB();

if (isset($_GET["id"]) and is_numeric($_GET["id"])) {
    $cards = Card::getCard($connection, $_GET["id"]);
} else {
    $cards = null;
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

    <link rel="stylesheet" href="../css/admin-one-card.css">
    <title>Kartičky</title>
</head>

<body>

    <?php require "../assets/admin-header.php"; ?>

    <main>

        <section class="one-card">
            <?php if ($cards === null): ?>
                <p>Karta nebola nájdená</p>
            <?php else: ?>
                <div class="one-card-box">



                    <div class="names">
                        <h2>
                            <?= htmlspecialchars($cards["first_language"]) ?>
                        </h2>
                        <h2>
                            <?= htmlspecialchars($cards["second_language"]) ?>
                        </h2>
                    </div>
                </div>


                <div class="one-card-buttons">
                    <a class="edit-one-card" href="edit-card.php?id=<?= $cards['id'] ?>">Upraviť</a>
                    <a class="delete-one-card" href="delete-card.php?id=<?= $cards['id'] ?>">Odstrániť</a>
                </div>



            <?php endif ?>
        </section>

        <section class="buttons">

        </section>

    </main>

    <?php require "../assets/footer.php"; ?>
    <script src="../js/header.js"></script>
</body>

</html>