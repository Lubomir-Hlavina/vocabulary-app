<?php

require "../classes/Database.php";
require "../classes/Auth.php";
require "../classes/Card.php";

session_start();

// Pokiaľ nie je prihláseny, tak die
if (!Auth::isLoggedIn()) {
    die("Nepovolený prístup");
}

$database = new Database();
$connection = $database->connectionDB();


$cards = Card::getAllCards($connection, "id, first_language, second_language");

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

    <link rel="stylesheet" href="../css/admin-cards.css">

    <title>Kartičky</title>
</head>

<body>

    <?php require "../assets/admin-header.php"; ?>

    <main>
        <section class="main-heading">
            <h1>Zoznam kartičiek</h1>
        </section>

        <section class="filter">
            <input type="text" class="filter-input">
        </section>

        <section class="cards-list">
            <?php if (empty($cards)): ?>
                <p>Kartičky neboli nájdené</p>
            <?php else: ?>
                <div class="all-cards">

                    <?php foreach ($cards as $one_card): ?>
                        <div class="one-card">
                            <a href=" one-card.php?id=<?= $one_card['id'] ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                            <div class="names">
                                <h2>
                                    <?php echo htmlspecialchars($one_card["first_language"]) ?>
                                </h2>
                                <h2>
                                    <?php echo htmlspecialchars($one_card["second_language"]) ?>
                                </h2>
                            </div>
                        </div>
                    <?php endforeach ?>

                </div>

            <?php endif ?>
        </section>
    </main>

    <?php require "../assets/footer.php"; ?>
</body>

<script src="../js/header.js"></script>
<script src="../js/filter.js"></script>

</html>