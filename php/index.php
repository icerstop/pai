<?php
session_start();

// Obsługa wylogowania
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['wyloguj'])) {
    $_SESSION = [];
    session_destroy();
    header('Location: index.php');
    exit;
}

require_once 'funkcje.php';

// Komunikat błędu logowania
$blad = $_SESSION['blad'] ?? '';
unset($_SESSION['blad']);

// Status ciasteczka
$cookieInfo = isset($_COOKIE['mojeCookie'])
    ? 'Wartość ciasteczka mojeCookie: ' . htmlspecialchars($_COOKIE['mojeCookie'])
    : 'Ciasteczko mojeCookie nie istnieje lub wygasło.';
?>
<!DOCTYPE html>
<html>
<head>
    <title>PHP – Logowanie i ciasteczka</title>
    <meta charset="UTF-8" />
    <style>
      fieldset { margin-bottom: 1.5em; padding: 1em; }
      legend { font-weight: bold; }
    </style>
</head>
<body>
    <h1>Nasz system</h1>

    <fieldset>
      <legend>Logowanie</legend>
      <form action="logowanie.php" method="POST">
        <label for="login">Login:</label>
        <input type="text" id="login" name="login" required><br><br>

        <label for="haslo">Hasło:</label>
        <input type="password" id="haslo" name="haslo" required><br><br>

        <input type="submit" name="zaloguj" value="Zaloguj">
      </form>
      <?php if ($blad): ?>
        <p style="color:red;"><?= htmlspecialchars($blad) ?></p>
      <?php endif; ?>
    </fieldset>

    <fieldset>
      <legend>Utwórz ciasteczko</legend>
      <form action="cookie.php" method="GET">
        <label for="czas">Czas życia (sekundy):</label>
        <input type="number" id="czas" name="czas" min="0" required>
        <input type="submit" name="utworzCookie" value="Utwórz ciasteczko">
      </form>
    </fieldset>

    <fieldset>
      <legend>Status ciasteczka</legend>
      <p><?= $cookieInfo ?></p>
    </fieldset>
</body>
</html>
