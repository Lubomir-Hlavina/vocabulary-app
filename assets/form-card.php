<form method="POST">
    <input type="text" name="first_language" placeholder="Názov primárny jazyk"
        value="<?= htmlspecialchars($first_language) ?>" required>

    <input type="text" name="second_language" placeholder="Názov sekundárny jazyk"
        value="<?= htmlspecialchars($second_language) ?>" required>

    <input type="submit" value="Uložiť">
</form>