<?php
$id = $_POST['id'];
$title = $_POST['title'];
$content = $_POST['content'];
$author = $_POST['author'];
$date = $_POST['date'];
$category = $_POST['category'];
$tags = $_POST['tags'];
$status = $_POST['status'];
$filename = 'BDD/articles.csv';

$rows = array_map('str_getcsv', file($filename));
$header = array_shift($rows);

foreach ($rows as &$row) {
    if ($row[0] == $id) {
        $row[1] = $title;
        $row[2] = $content;
        $row[3] = $author;
        $row[4] = $date;
        $row[5] = $category;
        $row[6] = $tags;
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