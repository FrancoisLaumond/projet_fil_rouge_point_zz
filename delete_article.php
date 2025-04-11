<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;

    if (!$id) {
        echo 'error_id_missing';
        exit;
    }

    $file = 'BDD/articles.csv';
    if (!file_exists($file)) {
        echo 'error_file_missing';
        exit;
    }

    $lines = file($file, FILE_IGNORE_NEW_LINES);
    $found = false;

    foreach ($lines as $key => $line) {
        $data = str_getcsv($line, ',', '"', '\\');
        if ($data[0] == $id) {
            // Remplace la ligne par une chaîne vide
            $lines[$key] = '';
            $found = true;
            break;
        }
    }

    if ($found) {
        file_put_contents($file, implode(PHP_EOL, $lines) . PHP_EOL);
        echo 'success';
    } else {
        echo 'error_not_found';
    }
    exit;
}