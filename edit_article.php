<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $title = htmlspecialchars(trim($_POST['title'] ?? ''));
    $content = htmlspecialchars(trim($_POST['content'] ?? ''));
    $author = htmlspecialchars(trim($_POST['author'] ?? ''));
    $text = htmlspecialchars(trim($_POST['text'] ?? ''));
    $category = htmlspecialchars(trim($_POST['category'] ?? ''));
    $tags = htmlspecialchars(trim($_POST['tags'] ?? ''));
    $status = htmlspecialchars(trim($_POST['status'] ?? ''));

    if (!$id || !$title || !$content || !$author || !$text || !$category || !$tags || !$status) {
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
            $data[1] = $title;
            $data[2] = $content;
            $data[3] = $author;
            $data[4] = $text;
            $data[5] = $category;
            $data[6] = $tags;
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