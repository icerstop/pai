<?php
/**
 * Funkcja oczyszcza i zabezpiecza wejście przed wstrzyknięciami
 * @param string $data
 * @return string
 */
function test_input(string $data): string {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}

// Definicja klasy użytkownika
class Osoba {
    public string $login;
    public string $haslo;
    public string $imieNazwisko;

    public function __construct(string $login, string $haslo, string $imieNazwisko) {
        $this->login = $login;
        $this->haslo = $haslo;
        $this->imieNazwisko = $imieNazwisko;
    }
}

// Tworzenie dwóch przykładowych użytkowników
$osoba1 = new Osoba('adam', 'adam2020', 'Adam Kowalski');
$osoba2 = new Osoba('agata', '2020agata', 'Agata Nowak');
?>