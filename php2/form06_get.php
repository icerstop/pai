<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Lista pracowników</title>
</head>
<body>
    <h2>Lista pracowników</h2>
    
    <?php
    // Wyświetlanie komunikatu o sukcesie, jeśli istnieje
    if (isset($_SESSION['success'])) {
        echo '<p style="color: green;">' . htmlspecialchars($_SESSION['success']) . '</p>';
        unset($_SESSION['success']); // Usuń komunikat po wyświetleniu
    }
    
    // Połączenie z bazą danych
    $link = mysqli_connect("127.0.0.1:3307", "scott", "tiger", "instytut");
    
    if (!$link) {
        echo "<p style='color: red;'>Błąd połączenia z bazą danych: " . mysqli_connect_error() . "</p>";
    } else {
        $sql = "SELECT * FROM pracownicy ORDER BY id_prac";
        $result = $link->query($sql);
        
        if ($result) {
            echo "<table border='1'>";
            echo "<tr><th>ID</th><th>Nazwisko</th></tr>";
            
            foreach ($result as $v) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($v["ID_PRAC"]) . "</td>";
                echo "<td>" . htmlspecialchars($v["NAZWISKO"]) . "</td>";
                echo "</tr>";
            }
            
            echo "</table>";
            $result->free();
        } else {
            echo "<p style='color: red;'>Błąd podczas pobierania danych: " . mysqli_error($link) . "</p>";
        }
        
        $link->close();
    }
    ?>
    
    <p><a href="form06_post.php">Dodaj nowego pracownika</a></p>
</body>
</html>