<?php
/*
 * Vue Gestion des article
 */
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=, initial-scale=1.0">
   <title>Admin Blog</title>
   <link rel="stylesheet" href="../assets/css/pico.min.css">
   <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
   <main class="container">
      <header class="header">
         <h1>Gestion des articles</h1>
         <p><a href="../" role="button">Voir Blog</a></p>
        
         <p><a href="./ajout.php" role="button">Ajouter un article</a></p>
         <p><a href="../login/deconnexion.php" role="button">Deconnexion</a></p>
      </header>
         <?php if(count(getArticleLimit($limit, $offset)) != 0): ?>
      <table>
         <thead>
            <tr>
               <th>Id</th>
               <th>Titre</th>
               <th>Contenu</th>
               <th>Date</th>
               <th>Actions</th>
            </tr>
         </thead>
         <tbody>
         <?php //dd(getArticleLimit($limit, $offset)) ?>
            <?php foreach (getArticleLimit($limit, $offset) as $key => $value) : ?>
               <tr>
                  <td><?= $value['id_article'] ?></td>
                  <td><?= $value['titre'] ?></td>
                  <td><?= $value['contenu']?></td>
                  <td><?= $value['created_at'] ?></td>
                  <td>
                     <a href="./edit.php?id=<?= $value['id_article'] ?>" role="button">Edit</a>
                     <a href="./supp.php?id=<?= $value['id_article'] ?>" role="button" onclick="return confirm('Confirmer la suppression de cet article ?');">Supprimer</a>
                  </td>
               </tr>
            <?php endforeach; ?>
         </tbody>
      </table>
            <?php else: ?>
<p>Aucun article !</p>
<?php endif; ?>
   </main>
</body>

</html>
