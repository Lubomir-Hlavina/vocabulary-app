<?php
require "../classes/Database.php";
require "../classes/Url.php";
require "../classes/Card.php";
require "../classes/Auth.php";

session_start();

if (!Auth::isLoggedIn()) {
    die("Nepovolený prístup");
}

$database = new Database();
$connection = $database->connectionDB();

// Získa aktuálne ID karty z session alebo nastaví na nulu
$currentCardID = isset($_SESSION['currentCardID']) ? $_SESSION['currentCardID'] : 1;

if (isset($_GET["action"])) {
    if ($_GET["action"] == "next") {
        // Získa nasledujúce ID karty
        $currentCardID = Card::getNextCardID($connection, $currentCardID);
    } elseif ($_GET["action"] == "previous") {
        // Získa predchádzajúce ID karty
        $currentCardID = Card::getPreviousCardID($connection, $currentCardID);
    } elseif ($_GET["action"] == "random") {
        // Získa náhodné ID karty
        $currentCardID = Card::getRandomCard($connection)["id"];
    }
}

$currentCard = Card::getCard($connection, $currentCardID, "id, first_language, second_language");

// Uloží aktuálne ID karty do session
$_SESSION['currentCardID'] = $currentCardID;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../query/header-query.css">
    <link rel="stylesheet" href="../css/footer.css">
    <title>Kartičky</title>
    <link rel="stylesheet" href="../css/admin-training.css">
    <script src="https://kit.fontawesome.com/0fe3234472.js" crossorigin="anonymous"></script>
    <script src="../js/toggleCard.js"></script>

</head>

<body>

    <?php require "../assets/admin-header.php"; ?>

    <main class="training-main">
        <section>
            <div class="one-card-box">
                <?php if ($currentCard && is_array($currentCard)): ?>
                    <div class="names">
                        <h2 id="first-name">
                            <?= htmlspecialchars($currentCard["first_language"]) ?>
                        </h2>
                        <h2 id="second-name">
                            <?= htmlspecialchars($currentCard["second_language"]) ?>
                        </h2>
                    </div>
                    <a class="show-one-card" onclick="toggleClasses()">
                        <i class="fa-solid fa-retweet"></i>
                    </a>
                <?php else: ?>
                    <p>Nie sú dostupné žiadne karty.</p>

                    <?php
                    print_r($_SESSION);
                    ?>
                <?php endif; ?>
            </div>


            <div class="one-card-buttons">
                <a href="?action=previous" class="previous-one-card">Späť</a>
                <a href="?action=random" class="random-one-card">Náhodná karta</a>
                <a href="?action=next" class="next-one-card">Ďalej</a>
            </div>
        </section>
    </main>

    <?php require "../assets/footer.php"; ?>

</body>

</html>