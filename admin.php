<?php
$filename = 'BDD/articles.csv';

// Fonction pour obtenir le plus grand ID dans le fichier CSV
function Get_Max_Id($filename) {
    $maxId = 0;
    if (($handle = fopen($filename, 'r')) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ',', '"', '\\')) !== FALSE) {
            if (isset($data[0]) && is_numeric($data[0]) && (int)$data[0] > $maxId) {
                $maxId = (int)$data[0];
            }
        }
        fclose($handle);
    }
    return $maxId;
}

// Traitement du formulaire d'ajout d'article
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $maxId = Get_Max_Id($filename);
    $id = $maxId + 1;

    // Validation des données
    $name = htmlspecialchars(trim($_POST['name']));
    $description = htmlspecialchars(trim($_POST['description']));
    $main_image = htmlspecialchars(trim($_POST['main_image']));
    $text = htmlspecialchars(trim($_POST['text']));
    $secondary_image = htmlspecialchars(trim($_POST['secondary_image']));
    $tags = htmlspecialchars(implode(';', $_POST['tag'] ?? [])); // Vérifie si des tags sont fournis
    $show = isset($_POST['show']) ? 'true' : 'false';

    if (empty($name) || empty($description) || empty($main_image) || empty($text)) {
        echo "<p>Erreur : Tous les champs obligatoires doivent être remplis.</p>";
    } else {
        // Ajout des données dans le fichier CSV
        $file = fopen($filename, 'a');
        if ($file) {
            // Ajout des données avec un saut de ligne explicite
            fwrite($file, implode(',', [$id, $name, $description, $main_image, $text, $secondary_image, $tags, $show]) . PHP_EOL);
            fclose($file);

            // Redirection pour éviter les doubles soumissions
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        } else {
            echo "<p>Erreur lors de l'ajout de l'article.</p>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator Page</title>
    <script src="back-script.js"></script>
    <link rel="stylesheet" href="back-style.css">
</head>
<body class="body-admin">
    <div>
        <table>
            <tr>
                <th>Nom</th>
                <th>Montrer ou Non</th>
                <th>Supprimer l'article</th>
                <th>Modifier</th>
            </tr>
            <?php
            // Lecture et affichage des articles depuis le fichier CSV
            if (($handle = fopen($filename, 'rb')) !== FALSE) {
                while (($data = fgetcsv($handle, 1000, ',', '"', '\\')) !== FALSE) {
                    // Ignorez les lignes vides ou incomplètes
                    if (empty($data) || count($data) < 8) {
                        continue;
                    }

                    // Récupérez les données avec des vérifications
                    $data_id = isset($data[0]) ? $data[0] : '';
                    $data_name = isset($data[1]) ? $data[1] : 'Nom manquant';
                    $data_description = isset($data[2]) ? $data[2] : 'Description manquante';
                    $data_main_image = isset($data[3]) ? $data[3] : '';
                    $data_text = isset($data[4]) ? $data[4] : '';
                    $data_secondary_image = isset($data[5]) ? $data[5] : '';
                    $data_tags = isset($data[6]) ? $data[6] : '';
                    $data_status = isset($data[7]) ? $data[7] : 'false';

                    echo "<tr>
                            <td>{$data_name}</td>
                            <td>
                                <span class='camera' data-id='{$data_id}' data-status='{$data_status}'>
                                    " . ($data_status === 'true' ? '📷' : '📵') . "
                                </span>
                            </td>
                            <td><span class='delete' data-id='{$data_id}'>🗑️</span></td>
                            <td>
                                <span class='edit' 
                                    data-id='$data_id' 
                                    data-title='$data_name' 
                                    data-content='$data_description' 
                                    data-author='$data_main_image' 
                                    data-text='$data_text' 
                                    data-category='$data_secondary_image' 
                                    data-tags='$data_tags' 
                                    data-status='$data_status'
                                    >✏️
                                </span>
                            </td>
                        </tr>";
                }
                fclose($handle);
            }
            ?>
        </table>
    </div>

    <div class="div_add_article_and_explication">
        <div class="explication-div">
            <h2>Comment ça fonctionne</h2>
            <p>
                <strong>Guide d'utilisation de la page d'administration</strong><br><br>
                Cette page vous permet de gérer vos articles facilement.<br><br>
                <strong>1. Gérer les articles</strong><br>
                - <strong>Afficher/Masquer</strong> : Cliquez sur 📷 pour activer ou désactiver l'affichage d'un article.<br>
                - <strong>Modifier</strong> : Cliquez sur ✏️ pour éditer un article.<br>
                - <strong>Supprimer</strong> : Cliquez sur 🗑️ pour supprimer un article définitivement.<br><br>
                <strong>2. Ajouter un article</strong><br>
                - <strong>Nom</strong> : Entrez le titre de l'article.<br>
                - <strong>Description</strong> : Ajoutez un court résumé.<br>
                - <strong>Image principale</strong> : Entrez l'URL de l'image principale.<br>
                - <strong>Texte</strong> : Rédigez le contenu.<br>
                - <strong>Image secondaire</strong> : Ajoutez plusieurs URLs, séparées par des <strong>points-virgules</strong>.<br>
                - <strong>Tags</strong> : Sélectionnez des mots-clés.<br>
                - <strong>Afficher l'article</strong> : Cochez cette case si vous souhaitez publier immédiatement.<br>
                - <strong>Enregistrer</strong> : Cliquez sur "Ajouter".<br><br>
            </p>
        </div>

        <form method="POST" action="" class="form_add_article">
            <h2>Ajouter un article</h2>
            
            <label for="name">Nom</label>
            <textarea id="name" name="name" placeholder="Nom" required></textarea>
        
            <label for="description">Description</label>
            <textarea id="description" name="description" placeholder="Description" required></textarea>
        
            <label for="main_image">Image Principale</label>
            <textarea id="main_image" name="main_image" placeholder="URL de l'image principale" required></textarea>
        
            <label for="text">Texte</label>
            <textarea id="text" name="text" placeholder="Texte" required></textarea>
        
            <label for="secondary_image">Images Secondaires</label>
            <textarea id="secondary_image" name="secondary_image" placeholder="URLs des images secondaires (séparées par des ;)" required></textarea>
        
            <label for="tag">Tags</label>
            <select id="tag" name="tag[]" multiple required>
                <option value="tag1">Tag 1</option>
                <option value="tag2">Tag 2</option>
                <option value="tag3">Tag 3</option>
            </select>
        
            <label for="show">Afficher l'article</label>
            <input type="checkbox" id="show" name="show">
        
            <input type="submit" value="Ajouter">
        </form>
    </div>

        <!-- Pop-up de modification -->
    <div id="edit-popup" style="display: none;">
        <form id="edit-form" method="POST" action="edit_article.php">
            <h2>Modifier l'article</h2>
            <input type="hidden" id="edit-id" name="id">

            <label for="edit-title">Titre</label>
            <input type="text" id="edit-title" name="title" required>

            <label for="edit-content">Description</label>
            <textarea id="edit-content" name="content" required></textarea>

            <label for="edit-author">Auteur</label>
            <input type="text" id="edit-author" name="author" required>

            <label for="edit-text">Texte</label>
            <textarea id="edit-text" name="text" required></textarea>

            <label for="edit-category">Catégorie</label>
            <input type="text" id="edit-category" name="category" required>

            <label for="edit-tags">Tags</label>
            <input type="text" id="edit-tags" name="tags" required>

            <label for="edit-status">Statut</label>
            <select id="edit-status" name="status" required>
                <option value="true">Afficher</option>
                <option value="false">Masquer</option>
            </select>

            <button type="submit">Enregistrer</button>
            <button type="button" id="edit-close">Annuler</button>
    </form>
</div>
<?php
if (isset($_GET['error'])) {
    $error_message = '';
    switch ($_GET['error']) {
        case 'missing_fields':
            $error_message = 'Veuillez remplir tous les champs obligatoires.';
            break;
        case 'write_error':
            $error_message = 'Erreur lors de l\'enregistrement de l\'article.';
            break;
        default:
            $error_message = 'Une erreur inconnue est survenue.';
    }
    echo "<p class='error-message'>$error_message</p>";
}
?>
</body>
</html>