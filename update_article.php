<?php
$id = $_GET['id'];
$status = $_GET['status'];
$filename = 'BDD/articles.csv';

$rows = array_map('str_getcsv', file($filename));
$header = array_shift($rows);

foreach ($rows as &$row) {
    if ($row[0] == $id) {
        $row[7] = $status;
        break;
    }
}

$fp = fopen($filename, 'w');
fputcsv($fp, $header);
foreach ($rows as $row) {
    fputcsv($fp, $row);
}
fclose($fp);

echo 'success';
?>