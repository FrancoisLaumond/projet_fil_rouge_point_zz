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
            $filename = 'BDD/articles.csv';

            if (($handle = fopen($filename, 'rb')) !== FALSE) {
                $count = 0;
                while (($data = fgetcsv($handle, 1000, ',', '"', '\\')) !== FALSE) {
                    echo "<tr>
                            <td>{$data[1]}</td>
                            <td>
                                <span class='camera' data-id='{$data[0]}' data-status='{$data[7]}'>
                                    " . ($data[7] === 'true' ? '📷' : '📵') . "
                                </span>
                            </td>
                            <td><span class='delete' data-id='{$data[0]}'>🗑️</span></td>
                            <td><span class='edit' data-id='{$data[0]}' data-title='{$data[1]}' data-content='{$data[2]}' data-author='{$data[3]}' data-text='{$data[4]}' data-category='{$data[5]}' data-tags='{$data[6]}' data-status='{$data[7]}'>✏️</span></td>
                        </tr>";
                    $count++;
                }
                fclose($handle);
            }
            ?>
        </table>
    </div>

    <div>
        <?php
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
        
            $filename = 'BDD/articles.csv';
            $maxId = Get_Max_Id($filename);

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $id = $maxId + 1;
                $name = $_POST['name'];
                $description = $_POST['description'];
                $main_image = $_POST['main_image'];
                $text = $_POST['text'];
                $secondary_image = $_POST['secondary_image'];
                $tag = $_POST['tag'];
                $show = isset($_POST['show']) ? 'Yes' : 'No';

                $file = fopen('BDD/articles.csv', 'a');
                fputcsv($file, [$id, $name, $description, $main_image, $text, $secondary_image, $tag, $show]);
                fclose($file);
            }
        ?>
        <div class="div_add_article_and_explication">

            <div class="explication-div">
                <h2>Comment ca fonctione</h2>
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
                    - <strong>Image secondaire</strong> : Ajoutez plusieurs URLs, séparées par des virgules.<br>
                    - <strong>Tags</strong> : Sélectionnez des mots-clés.<br>
                    - <strong>Afficher l'article</strong> : Cochez cette case si vous souhaitez publier immédiatement.<br>
                    - <strong>Enregistrer</strong> : Cliquez sur "Ajouter".<br><br>
                    <strong>⚠️ Ne pas utiliser</strong> <code>;, / "</code> dans les champs pour éviter les erreurs.<br><br>
                    <strong>3. Modifier un article</strong><br>
                    1. Cliquez sur ✏️.<br>
                    2. Modifiez les informations.<br>
                    3. Cliquez sur "Enregistrer".<br><br>
                    <strong>4. Supprimer un article</strong><br>
                    Cliquez sur 🗑️ pour supprimer un article définitivement.<br><br>
                </p>
            </div>

            <form method="POST" action="" class="form_add_article">

                <h2>Tableau pour créer un article</h2>
                
                <label for="name">Nom</label>
                <textarea id="name" name="name" placeholder="Nom" required></textarea>
            
                <label for="description">Description</label>
                <textarea id="description" name="description" placeholder="Description" required></textarea>
            
                <label for="main_image">Image Principal</label>
                <textarea id="main_image" name="main_image" placeholder="Image Principal" required></textarea>
            
                <label for="text">Texte</label>
                <textarea id="text" name="text" placeholder="Texte" required></textarea>
            
                <label for="secondary_image">Image Secondaire</label>
                <textarea id="secondary_image" name="secondary_image" placeholder="Image Secondaire" required></textarea>
            
                <label for="tag">Tag</label>
                <select id="tag" name="tag[]" multiple required>
                    <option value="" disabled selected>Choisissez un ou des tag</option>
                    <option value="tag1">Tag 1</option>
                    <option value="tag2">Tag 2</option>
                    <option value="tag3">Tag 3</option>
                </select>
            
                <label for="show">Show</label>
                <input type="checkbox" id="show" name="show">
            
                <input type="submit" value="Ajouter"/>
            </form>
            </form>
        </div>


    </div>
    
    <div id="edit-popup" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%, -50%); background-color:white; padding:20px; border:1px solid black;">
    <form id="edit-form">
        <input type="hidden" id="edit-id" name="id">
        <label for="edit-title">Titre:</label>
        <input type="text" id="edit-title" name="title"><br>
        <label for="edit-content">Contenu:</label>
        <textarea id="edit-content" name="content"></textarea><br>
        <label for="edit-author">Auteur:</label>
        <input type="text" id="edit-author" name="author"><br>
        <label for="edit-text">Text:</label>
        <input type="text" id="edit-text" name="text"><br>
        <label for="edit-category">Catégorie:</label>
        <input type="text" id="edit-category" name="category"><br>
        <label for="edit-tags">Tags:</label>
        <input type="text" id="edit-tags" name="tags"><br>
        <label for="edit-status">Statut:</label>
        <input type="text" id="edit-status" name="status"><br>
        <button type="submit">Enregistrer</button>
        <button type="button" id="edit-close">Fermer</button>
    </form>
</div>
</body>
</html>