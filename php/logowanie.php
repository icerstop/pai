<?php
session_start();
require_once 'funkcje.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['zaloguj'])) {
    $login = test_input($_POST['login'] ?? '');
    $haslo = test_input($_POST['haslo'] ?? '');

    if ($login === $osoba1->login && $haslo === $osoba1->haslo) {
        $_SESSION['zalogowany'] = 1;
        $_SESSION['zalogowanyImie'] = $osoba1->imieNazwisko;
        header('Location: user.php');
        exit;
    } elseif ($login === $osoba2->login && $haslo === $osoba2->haslo) {
        $_SESSION['zalogowany'] = 1;
        $_SESSION['zalogowanyImie'] = $osoba2->imieNazwisko;
        header('Location: user.php');
        exit;
    } else {
        $_SESSION['blad'] = 'Nieprawidłowy login lub hasło.';
        header('Location: index.php');
        exit;
    }
}

// W każdym innym wypadku – wróć do formularza
header('Location: index.php');
exit;
