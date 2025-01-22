<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="">
        <input type="text" id="users" name="users" required/>
        <input type="password" id="password" name="password" required/>
        <input type="submit" />
    </form>

    
    <?php 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $usersInput = $_POST['users'];
        $passwordInput = $_POST['password'];

        $users = array_map('str_getcsv', file('BDD/users.csv'));
        $passwords = array_map('str_getcsv',file('BDD/password.csv'));

        $users = array_column($users, 0); 
        $passwords = array_column($passwords, 0);

        if (in_array($usersInput, $users) && in_array($passwordInput, $passwords)) {
            echo "Connexion réussie !";
        } else {
            echo "Identifiant ou mot de passe incorrect.";
        }
    }
    ?>
</body>
</html>