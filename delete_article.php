<?php
$id = $_GET['id'];
$filename = 'BDD/articles.csv';

$rows = array_map('str_getcsv', file($filename));
$header = array_shift($rows);

$rows = array_filter($rows, function($row) use ($id) {
    return $row[0] != $id;
});

$fp = fopen($filename, 'w');
fputcsv($fp, $header);
foreach ($rows as $row) {
    fputcsv($fp, $row);
}
fclose($fp);

echo 'success';
?>