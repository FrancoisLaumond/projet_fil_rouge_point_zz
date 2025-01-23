<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $status = $_POST['status'];

    $file = 'BDD/articles.csv';
    $lines = file($file, FILE_IGNORE_NEW_LINES);
    foreach ($lines as &$line) {
        $data = str_getcsv($line);
        if ($data[0] == $id) {
            $data[7] = $status;
            $line = implode(',', $data);
            break;
        }
    }
    file_put_contents($file, implode(PHP_EOL, $lines));
    echo 'success';
}
?>