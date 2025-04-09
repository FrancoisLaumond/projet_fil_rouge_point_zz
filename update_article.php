<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $status = $_POST['status'];

    $file = 'BDD/articles.csv';
    $lines = file($file, FILE_IGNORE_NEW_LINES);
    $updated = false;

    foreach ($lines as &$line) {
        $data = str_getcsv($line);
        if ($data[0] == $id) {
            $data[7] = $status; // Mise à jour du statut (8ème élément)
            $line = implode(',', $data);
            $updated = true;
            break;
        }
    }

    // Si l'article a été trouvé et mis à jour, on sauvegarde les modifications
    if ($updated) {
        file_put_contents($file, implode(PHP_EOL, $lines));
    }

    // Redirection vers la page d'administration, peu importe le résultat
    header("Location: admin.php");
    exit;
}
?>