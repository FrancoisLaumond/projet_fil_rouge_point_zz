<?php
$users = str_getcsv(file_get_contents('BDD/users.csv'), ',', '"', '\\');
$passwords = str_getcsv(file_get_contents('BDD/password.csv'), ',', '"', '\\');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputUser  = trim($_POST['users']);
    $inputPassword = trim($_POST['password']);

    if (in_array($inputUser , $users) && in_array($inputPassword, $passwords)) {
        header('Location: admin.php');
        exit;
    } else {
        $error = 'Nom d\'utilisateur ou mot de passe incorrect';
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="back-style.css">
</head>
<body>
    <form method="POST" action="" class="login-form">
        <label for="users">Nom d'utilisateur</label>
        <input type="text" id="users" name="users" placeholder="Nom d'utilisateur" required/>

        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password" placeholder="Mot de passe" required/>

        <input type="submit" value="Se connecter"/>
        <?php
            if (isset($error)) {
                echo '<p class="error">' . $error . '</p>';
            }
        ?>
    </form>
</body>
</html>