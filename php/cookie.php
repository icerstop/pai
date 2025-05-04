<?php
session_start();
require_once 'funkcje.php';

$wiadomosc = 'Brak działania – podaj czas życia ciasteczka na stronie logowania.';

if (isset($_GET['utworzCookie']) && isset($_GET['czas'])) {
    // Pobierz i zabezpiecz wartość z GET
    $czas = max(0, intval($_GET['czas']));

    // Nazwa i wartość ciasteczka
    $nazwa  = 'mojeCookie';
    $wartosc = date('c'); // ISO 8601 aktualny czas

    // Ustaw ciasteczko przez $czas sekund w całej domenie
    setcookie($nazwa, $wartosc, time() + $czas, '/');

    $wiadomosc = "Ustawiono ciasteczko „{$nazwa}” z wartością „{$wartosc}” na {$czas} sekund.";
} elseif (isset($_COOKIE['mojeCookie'])) {
    $wiadomosc = 'Odczytane ciasteczko „mojeCookie”: ' . htmlspecialchars($_COOKIE['mojeCookie']);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Obsługa ciasteczek</title>
    <meta charset="UTF-8" />
</head>
<body>
    <h1>Cookie</h1>
    <p><?= htmlspecialchars($wiadomosc) ?></p>

    <p>
      <a href="index.php">Wstecz</a>
    </p>
</body>
</html>

