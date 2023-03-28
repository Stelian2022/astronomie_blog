<?php
/*
* Ajout d'un article
*/
session_start();
include '../inc/fonctions.php';

(isUserLogin()) ?: redirectUrl('view/404.php');
$titre = $contenu = $image = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') :
    $imageName = $_FILES['image']['name'];
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($imageName);

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    $titre = cleanData($_POST['titre']);
    $image = "./uploads/" . $imageName;
    $contenu = cleanData($_POST['contenu']);

    insertArticle($titre, $contenu, $image, $_SESSION['id_utilisateur']);

    if ($_SESSION['login'] === 'redacteur') :
        redirectUrl();
    else :
        //dd($_SESSION);
        redirectUrl('./adminBlog/');
    endif;
endif;









require '../view/adminBlog/ajout.view.php';
