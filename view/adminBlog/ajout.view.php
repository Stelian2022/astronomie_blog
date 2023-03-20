<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Ajout article</title>
    <link rel="stylesheet" href="../assets/css/pico.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <main class="container">
        <h1>Ajout d'un article</h1>
        <form method="POST" class="form">
            <div>
                <label for="titre">Titre article</label>
                <input type="titre" name="titre" id="titre" value="<?= $titre ?>">
            </div>
            <div>
                <label for="contenu">Contenu article</label>
<textarea name="contenu" id="contenu"><?= $contenu ?></textarea>
            </div>
            <div>
                <label for="image_url">Image URL</label>
                <input type="text" name="image_url" id="image_url" value="<?= $image_url ?>">
            </div>
            <div>
                <input type="submit" value="Ajouter">
                <a href="./"><button type="button">Annuler</button></a>
            </div>
            <?php if (!empty($errors)) : ?>
                <div class="errors">
                    <ul class="errors">
                        <li><?= $errors ?></li>
                    </ul>
                </div>
            <?php endif; ?>
        </form>
    </main>
</body>

</html>
