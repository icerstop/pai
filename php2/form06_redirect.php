<?php
session_start();

// Sprawdź czy otrzymano dane POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: form06_post.php');
    exit;
}

// Połączenie z bazą danych
$link = mysqli_connect("127.0.0.1:3307", "scott", "tiger", "instytut");
if (!$link) {
    $_SESSION['error'] = "Błąd połączenia z bazą danych: " . mysqli_connect_error();
    header('Location: form06_post.php');
    exit;
}

// Walidacja danych
if (isset($_POST['id_prac']) && is_numeric($_POST['id_prac']) && isset($_POST['nazwisko']) && is_string($_POST['nazwisko'])) {
    
    $sql = "INSERT INTO pracownicy(id_prac, nazwisko) VALUES(?, ?)";
    $stmt = $link->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("is", $_POST['id_prac'], $_POST['nazwisko']);
        
        if ($stmt->execute()) {
            $_SESSION['success'] = "Pracownik został dodany pomyślnie!";
            $stmt->close();
            $link->close();
            header('Location: form06_get.php');
            exit;
        } else {
            $_SESSION['error'] = "Błąd podczas dodawania: " . mysqli_error($link);
        }
        
        $stmt->close();
    } else {
        $_SESSION['error'] = "Błąd przygotowania zapytania: " . mysqli_error($link);
    }
} else {
    $_SESSION['error'] = "Nieprawidłowe dane wejściowe!";
}

$link->close();
header('Location: form06_post.php');
exit;
?>