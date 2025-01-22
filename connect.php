<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form method="POST" action="">
        <label for="users">Nom d'utilisateur</label>
        <input type="text" id="users" name="users" placeholder="Nom d'utilisateur" required/>

        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password" placeholder="Mot de passe" required/>

        <input type="submit" value="Se connecter"/>

        <?php
            // Lire les utilisateurs et mots de passe à partir des fichiers CSV
            $users = str_getcsv(file_get_contents('BDD/users.csv'));
            $passwords = str_getcsv(file_get_contents('BDD/password.csv'));

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $inputUser  = trim($_POST['users']);
                $inputPassword = trim($_POST['password']);

                // Vérifier si le nom d'utilisateur et le mot de passe sont corrects
                if (in_array($inputUser , $users) && in_array($inputPassword, $passwords)) {
                    echo "<p>Bravo</p>";
                    header('Location: index.html');
                } else {
                    echo '<p class="error">Nom d\'utilisateur ou mot de passe incorrect</p>';
                }
            }
        ?>
    </form>
</body>
</html>