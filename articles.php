<?php
include 'nav.php';

$csvFile = 'BDD/articles.csv';

if (!file_exists($csvFile)) {
    die("<p>Erreur : le fichier des articles est introuvable.</p>");
}

$selectedTag = isset($_GET['tag']) ? htmlspecialchars($_GET['tag']) : '';

$articles = [];
if (($handle = fopen($csvFile, "r")) !== FALSE) {
    fgetcsv($handle);
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        if (strtolower($data[7]) === 'true') {
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
<html lang="fr">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Point Zig-Zag - Accueil</title>
    <link rel="stylesheet" href="front-style.css">
</head>
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
    <script src="front-script.js"></script>
</body>
</html>
