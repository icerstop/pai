<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Dodaj pracownika</title>
</head>
<body>
    <h2>Dodaj nowego pracownika</h2>
    
    <?php
    // Wyświetlanie komunikatu o błędzie, jeśli istnieje
    if (isset($_SESSION['error'])) {
        echo '<p style="color: red;">' . htmlspecialchars($_SESSION['error']) . '</p>';
        unset($_SESSION['error']); // Usuń komunikat po wyświetleniu
    }
    ?>
    
    <form action="form06_redirect.php" method="POST">
        id_prac <input type="text" name="id_prac" required>
        nazwisko <input type="text" name="nazwisko" required>
        <input type="submit" value="Wstaw">
        <input type="reset" value="Wyczysc">
    </form>
    
    <p><a href="form06_get.php">Zobacz listę pracowników</a></p>
</body>
</html>