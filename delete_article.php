<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    $file = 'BDD/articles.csv';
    $lines = file($file, FILE_IGNORE_NEW_LINES);
    foreach ($lines as $key => $line) {
        $data = str_getcsv($line);
        if ($data[0] == $id) {
            unset($lines[$key]);
            break;
        }
    }
    file_put_contents($file, implode(PHP_EOL, $lines));
    echo 'success';
}
?>