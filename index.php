<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Point Zig-Zag - Accueil</title>
    <link rel="stylesheet" href="front-style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Aclonica&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.typekit.net/bgg3fjy.css"></head>
<body>
<?php include 'nav.php'; ?>
    <div class="main-content">
    <?php include 'caroussel.php'; ?>
        <br><br>

        <h2 style="text-align:center; font-family: 'brillant', sans-serif;">Les plus aimés</h2>

        <div class="imgDisplay">
            <div><a href="#"><img src="content/index1.png" alt="display1"></a><h4>Trend 1</h4></div>
            <div><a href="#"><img src="content/index2.png" alt="display2"></a><h4>Trend 2</h4></div>
            <div><a href="#"><img src="content/index3.png" alt="display3"></a><h4>Trend 3</h4></div>
        </div>
        <br><br>
        <div class="altBlock">
            <div>
                <h2>Le concept</h2>
                <p>J’ai à coeur de vous proposer des articles pour bébé, femme et zéro déchet.
                Ces créations sont confectionnées de A à Z par mes soins. Mes idées sont cousues dans une démarche       éco-responsable (provenance des tissus, qualité des tissus, label etc..), avec des matériaux de qualité tout en étant toujours à l’écoute de vos suggestions et demandes.</p>            </div>
            <img src="content/caroussel1.png" alt="concept">
        </div>
        <h2 style="text-align:center; font-family: 'brillant', sans-serif;">Nos Valeurs</h2>

        <div class="imgDisplayAlt">
            <div class="valueBlock"><img src="content/value1.png" alt="value1"><h4>Tissus français<br>ou recyclés</h4></div>
            <div class="valueBlock"><img src="content/value2.png" alt="value2"><h4>Savoir-faire<br>artisanal</h4></div>
            <div class="valueBlock"><img src="content/value3.png" alt="value3"><h4>Valeurs<br>familiales</h4></div>
        </div>
    </div>
<?php include 'footer.php'; ?>
    <script src="front-script.js"></script>
</body>
</html>