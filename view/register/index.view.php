<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../assets/css/pico.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <main class="container">
        <h1>Enregistrer un nouvel utilisateur</h1>
        <form method="POST" class="form">
            <div>
                <label for="prenom">Prenom *</label>
                <input type="prenom" name="prenom" id="prenom" value="<?= $prenom ?>">
            </div>
            <div>
                <label for="nom">Nom *</label>
                <input type="nom" name="nom" id="nom" value="<?= $nom ?>">
            </div>
            <div>
                <label for="email">Email *</label>
                <input type="email" name="email" id="email" required value="<?= $email ?>">
            </div>
            <div>
                <label for="pwd">Mot de passe *</label>
                <input type="password" name="pwd" id="pwd" required value="<?= $pwd ?>">
            </div>
            <div>
                <label for="role">Role</label>
                Redacteur <input type="radio" name="role" id="role" value="redacteur" checked> 
                Admin <input type="radio" name="role" id="role" value="admin">
            </div>
            <div>
                <input type="submit" value="Inscription">
            </div>
            <?php if (!empty($errors)) : ?>
                <div class="errors">
                    <ul class="errors">
                        <li><?= $errors ?></li>
                    </ul>
                </div>
            <?php endif; ?>
        </form>
        <p>* Informations obligatoires</p>
    </main>
</body>

</html>
