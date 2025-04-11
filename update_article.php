<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $status = $_POST['status'] ?? null;

    if (!$id || !$status) {
        echo 'error_missing_data';
        exit;
    }

    $file = 'BDD/articles.csv';
    if (!file_exists($file)) {
        echo 'error_file_missing';
        exit;
    }

    $lines = file($file, FILE_IGNORE_NEW_LINES);
    $updated = false;

    foreach ($lines as &$line) {
        // Ajout explicite du paramètre $escape
        $data = str_getcsv($line, ',', '"', '\\');
        if ($data[0] == $id) {
            $data[7] = $status; // Mise à jour du statut
            $line = implode(',', $data);
            $updated = true;
            break;
        }
    }

    if ($updated) {
        file_put_contents($file, implode(PHP_EOL, $lines));
        echo 'success';
    } else {
        echo 'error_not_found';
    }
    exit;
}