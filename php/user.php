<?php
session_start();
require_once 'funkcje.php';
if (empty($_SESSION['zalogowany'])) {
    header('Location: index.php');
    exit;
}

$imieNazwisko = $_SESSION['zalogowanyImie'] ?? 'Użytkownik';
$komunikat = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['plik'])) {
    $uploadDir = __DIR__ . '/uploads/';
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
    $ext = strtolower(pathinfo($_FILES['plik']['name'], PATHINFO_EXTENSION));
    $targetFile = $uploadDir . 'obrazek.' . $ext;

    if (!in_array($ext, ['png','jpg','jpeg'])) {
        $komunikat = 'Dozwolone tylko PNG i JPG.';
    } elseif (move_uploaded_file($_FILES['plik']['tmp_name'], $targetFile)) {
        $komunikat = 'Plik został przesłany poprawnie.';
    } else {
        $komunikat = 'Problem podczas zapisu pliku.';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Panel użytkownika</title>
    <meta charset="UTF-8" />
    <style>
      fieldset { margin-bottom: 1.5em; padding: 1em; }
      legend { font-weight: bold; }
    </style>
</head>
<body>
    <h1>Witaj, <?= htmlspecialchars($imieNazwisko) ?>!</h1>

    <fieldset>
        <legend>Dostępne akcje</legend>
        <p><a href="cookie.php">Obsługa ciasteczek</a></p>
        <form action="wyloguj.php" method="POST" style="display:inline;">
        <input type="submit" name="wyloguj" value="Wyloguj">
        </form>
    </fieldset>

    <fieldset>
      <legend>Prześlij obrazek</legend>
      <form action="user.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="plik" accept=".png,.jpg,.jpeg" required><br><br>
        <input type="submit" value="Wyślij">
      </form>
      <?php if ($komunikat): ?>
        <p><?= htmlspecialchars($komunikat) ?></p>
      <?php endif; ?>
    </fieldset>

    <fieldset>
      <legend>Twoje zdjęcie</legend>
      <?php
      $files = glob(__DIR__ . '/uploads/obrazek.*');
      if ($files && file_exists($files[0])): 
          $rel = 'uploads/' . basename($files[0]);
      ?>
        <img src="<?= $rel ?>" alt="Przesłane zdjęcie">
      <?php else: ?>
        <p>Brak przesłanego zdjęcia.</p>
      <?php endif; ?>
    </fieldset>
</body>
</html>
