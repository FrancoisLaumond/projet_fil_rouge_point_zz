<?php $isArticlesPage = basename($_SERVER['PHP_SELF']) == 'article.php'; ?>
<nav style="background-color: <?= $isArticlesPage ? '#E14A4C' : 'transparent' ?>;">
    <a href="index.php" class="navLogo">
        <img src="content/logo.png" alt="Logo">
    </a>
    <ul>
        <li class="dropdown">
            <a class="aclonica-regular" href="articles.php" style="color: <?= $isArticlesPage ? '#FFFFFF' : '#000000' ?>;">Mes créations</a>
            <div class="submenu">
    <img src="content/navimg.png" alt="dropdown image">
    <div class="dropdown-list">
        <h2 class="aclonica-regular" style="font-size: 40px">Mes Créations</h2>
        <div class="dropdown-content">
            <div class="dropdown-sublist">
                <h5 class="aclonica-regular"><a href="articles.php">Tout voir</a></h5>
                <h5 class="aclonica-regular"><a href="articles.php?tag=bébé">Gamme bébé</a></h5>
                <h5 class="aclonica-regular"><a href="articles.php?tag=femme">Gamme femme</a></h5>
            </div>
            <div class="dropdown-sublist">
                <h5 class="aclonica-regular"><a href="articles.php?tag=eco">Gamme zéro déchet</a></h5>
                <h5 class="aclonica-regular"><a href="articles.php?tag=sacados">Sacs à dos</a></h5>
                <h5 class="aclonica-regular"><a href="articles.php?tag=banane">Sac banane</a></h5>
            </div>
        </div>
    </div>
</div>

        </li>
        <li><a href="about.php" style="color: <?= $isArticlesPage ? '#FFFFFF' : '#000000' ?>;" class="aclonica-regular">Conception</a></li>
        <li>
            <a href="contact.php" class="aclonica-regular contactButton" 
               style="background-color: <?= $isArticlesPage ? '#FFFFFF' : '#E14A4C' ?>; 
                      color: <?= $isArticlesPage ? '#E14A4C' : '#FFFFFF' ?>;">
                Contact
            </a>
        </li>
    </ul>
</nav>
