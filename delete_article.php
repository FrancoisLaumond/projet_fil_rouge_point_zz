<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? $_POST['id'] : null;

    if (!$id) {
        // Redirection même si l'ID est manquant
        header("Location: admin.php?status=error_id_missing");
        exit;
    }

    $file = 'BDD/articles.csv';
    if (!file_exists($file)) {
        // Redirection même si le fichier est introuvable
        header("Location: admin.php?status=error_file_missing");
        exit;
    }

    $lines = file($file, FILE_IGNORE_NEW_LINES);
    $found = false;

    foreach ($lines as $key => $line) {
        $data = str_getcsv($line);
        if ($data[0] == $id) {
            unset($lines[$key]); // Suppression de la ligne correspondante
            $found = true;
            break;
        }
    }

    if ($found) {
        file_put_contents($file, implode(PHP_EOL, $lines));
        // Redirection après suppression réussie
        header("Location: admin.php?status=success");
    } else {
        // Redirection si l'article n'a pas été trouvé
        header("Location: admin.php?status=error_not_found");
    }
    exit;
}
?>