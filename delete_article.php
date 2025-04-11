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
            unset($lines[$key]); // Supprime la ligne
            $found = true;
            break;
        }
    }

    if ($found) {
        // Si la ligne supprimée était la dernière, ajoute un saut de ligne vide
        if (empty($lines)) {
            file_put_contents($file, PHP_EOL); // Fichier vide avec une ligne sautée
        } else {
            file_put_contents($file, implode(PHP_EOL, $lines) . PHP_EOL); // Réécrit le fichier avec un saut de ligne final
        }
        echo 'success';
    } else {
        echo 'error_not_found';
    }
    exit;
}