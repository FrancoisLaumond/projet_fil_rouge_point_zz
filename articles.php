<?php
$csvFile = 'BDD/articles.csv';

if (!file_exists($csvFile)) {
    die("<p>Erreur : le fichier des articles est introuvable.</p>");
}

$selectedTag = isset($_GET['tag']) ? htmlspecialchars($_GET['tag']) : '';

$articles = [];
if (($handle = fopen($csvFile, "r")) !== FALSE) {
    fgetcsv($handle, 1000, ",", '"', "\\"); // Lecture de l'en-tête avec $escape explicitement défini
    while (($data = fgetcsv($handle, 1000, ",", '"', "\\")) !== FALSE) { // Ajout explicite du paramètre $escape
        if (strtolower($data[7]) === 'yes') {
            $tags = explode(';', $data[6]);
            if ($selectedTag === '' || in_array($selectedTag, $tags)) {
                $articles[] = [
                    'id' => $data[0],
                    'name' => $data[1],
                    'description' => $data[2],
                    'thumbnail' => $data[3],
                    'long_description' => $data[4],
                    'images' => explode(';', $data[5]),
                    'tags' => $tags,
                ];
            }
        }
    }
    fclose($handle);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Point Zig-Zag - À Propos</title>
    <link rel="stylesheet" href="front-style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Aclonica&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.typekit.net/bgg3fjy.css"></head>
<body>
<?php include 'nav.php'; ?>
<body>
    <div class="articles-container">
        <h1><?= $selectedTag ? "Articles : " . $selectedTag : "Nos Articles" ?></h1>
        <div class="articles-grid">
            <?php foreach ($articles as $article) : ?>
                <div class="article-card">
                    <a href="article.php?item=<?= htmlspecialchars($article['id']) ?>">
                    <img src="<?= htmlspecialchars($article['thumbnail']) ?>" alt="<?= htmlspecialchars($article['name']) ?>">
                    <h2><?= htmlspecialchars($article['name']) ?></h2>
                    <p><?= htmlspecialchars($article['description']) ?></p>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    
    <?php include 'footer.php'; ?>
</body>
</html>