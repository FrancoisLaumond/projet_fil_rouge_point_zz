<?php
include('nav.php');

$articles = [];
if (($handle = fopen('BDD/articles.csv', 'r')) !== false) {
    while (($data = fgetcsv($handle, 1000, ",")) !== false) {
        $tags = explode(';', $data[6]);
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
    fclose($handle);
}

$item_id = isset($_GET['item']) ? $_GET['item'] : null;

$article = null;
if ($item_id !== null) {
    foreach ($articles as $art) {
        if ($art['id'] == $item_id) {
            $article = $art;
            break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $article ? htmlspecialchars($article['name']) : "Article non trouvé"; ?></title>
    <link rel="stylesheet" href="front-style.css">
</head>
<body>
    <div class="article-container">
        <?php if ($article): ?>
            <h1><?php echo htmlspecialchars($article['name']); ?></h1>
            <div class="article-thumbnail">
                <img src="<?php echo htmlspecialchars($article['thumbnail']); ?>" alt="<?php echo htmlspecialchars($article['name']); ?>">
            </div>
            <div class="article-description">
                <p><?php echo nl2br(htmlspecialchars($article['description'])); ?></p>
            </div>
            <div class="article-long-description">
                <h2>Description détaillée</h2>
                <p><?php echo nl2br(htmlspecialchars($article['long_description'])); ?></p>
            </div>
            <div class="article-images">
                <?php foreach ($article['images'] as $image): ?>
                    <img src="<?php echo htmlspecialchars($image); ?>" alt="Image de l'article">
                <?php endforeach; ?>
            </div>
            <div class="article-tags">
                <p><strong>Tags:</strong> <?php echo implode(', ', array_map('htmlspecialchars', $article['tags'])); ?></p>
            </div>
        <?php else: ?>
            <h1>Article non trouvé</h1>
            <p>Nous n'avons pas pu trouver l'article que vous cherchez.</p>
        <?php endif; ?>
    </div>

    <?php include('footer.php'); ?>
</body>
</html>
