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
</head>

<body>

    <?php require "../assets/admin-header.php"; ?>


    <main>
        <section>


            <div class="one-card-box">



                <div class="names">
                    <h2>
                        <!-- <?= htmlspecialchars($cards["first_language"]) ?> -->
                        First language
                    </h2>
                    <h2>
                        <!-- <?= htmlspecialchars($cards["second_language"]) ?> -->
                        Second language
                    </h2>
                </div>
            </div>


            <div class="one-card-buttons">
                <button class="next-one-card">Ďalej</button>
                <button class="show-one-card">Otočiť</button>
                <button class="previous-one-card">Späť</button>
            </div>

        </section>
    </main>
</body>

</html>