<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Point Zig-Zag - Accueil</title>
    <link rel="stylesheet" href="front-style.css">
</head>
<body>
<?php include 'nav.php'; ?>
    <div class="main-content">
    <?php include 'caroussel.php'; ?>
        <br><br>

        <h2 style="text-align:center;">Les plus aimés</h2>

        <div class="imgDisplay">
            <div><a href="#"><img src="content/index1.png" alt="display1"></a><h4>Trend 1</h4></div>
            <div><a href="#"><img src="content/index2.png" alt="display2"></a><h4>Trend 2</h4></div>
            <div><a href="#"><img src="content/index3.png" alt="display3"></a><h4>Trend 3</h4></div>
        </div>
        <br><br>
        <div class="altBlock">
            <div>
                <h2>Le concept</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>            </div>
            <img src="content/caroussel1.png" alt="concept">
        </div>
        <h2 style="text-align:center;">Nos Valeurs</h2>

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