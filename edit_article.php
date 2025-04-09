<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author = $_POST['author'];
    $text = $_POST['text'];
    $category = $_POST['category'];
    $tags = $_POST['tags'];
    $status = $_POST['status'];

    $file = 'BDD/articles.csv';
    $lines = file($file, FILE_IGNORE_NEW_LINES);
    $updated = false;

    foreach ($lines as &$line) {
        $data = str_getcsv($line);
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
    }

    // Redirection vers la page d'administration
    header("Location: admin.php");
    exit;
}
?>