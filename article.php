<?php
$articles = [];
if (($handle = fopen('BDD/articles.csv', 'r')) !== false) {
    while (($data = fgetcsv($handle, 1000, ",", '"', "\\")) !== false) { // Ajout explicite du paramètre $escape
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $article ? htmlspecialchars($article['name']) : 'Article introuvable'; ?></title>
    <link rel="stylesheet" href="front-style.css">
</head>
<body>
<?php include 'nav.php'; ?>
<div class="article-solo">
    <?php if ($article): ?>
        <div class="article-main-block">
            <div class="article-main-infos">
                <h1><?php echo htmlspecialchars($article['name']); ?></h1>
                <p><?php echo nl2br(htmlspecialchars($article['description'])); ?></p>
                <div class="article-contact">
                    <a href="contact.php"><p>Cet article vous intéresse? <br> Contactez moi !</p></a>
                </div>
            </div>
            <img src="<?php echo htmlspecialchars($article['thumbnail']); ?>" alt="<?php echo htmlspecialchars($article['name']); ?>">
        </div>
        <div class="article-main-infos">
            <p><?php echo nl2br(htmlspecialchars($article['long_description'])); ?></p>
            <div class="article-showcase">
                <?php if (!empty($article['images'])): ?>
                    <?php foreach ($article['images'] as $image): ?>
                        <img src="<?php echo htmlspecialchars($image); ?>" alt="Image de l'article">
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Aucune image disponible pour cet article.</p>
                <?php endif; ?>
            </div>
            <div class="article-main-tags">
                <p><strong>Tags:</strong> 
                    <?php 
                    echo implode(', ', array_map(function($tag) {
                        return '<a href="articles.php?tag=' . urlencode($tag) . '">' . htmlspecialchars($tag) . '</a>';
                    }, $article['tags'])); 
                    ?>
                </p>
            </div>
        </div>
    <?php else: ?>
        <p>Article introuvable. Veuillez vérifier l'ID de l'article.</p>
    <?php endif; ?>
</div>    
<?php include('footer.php'); ?>
</body>
</html>