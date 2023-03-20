<?php
/*
* Ajout d'un article
*/
session_start();
include '../inc/fonctions.php';

(isUserLogin()) ?: redirectUrl('view/404.php');

   
$titre = $contenu = $image_url = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') :

    $titre = cleanData($_POST['titre']);
    $image_url = cleanData($_POST['image_url']);
    $contenu = cleanData($_POST['contenu']);

    insertArticle($titre,$contenu ,$image_url, $_SESSION['id_utilisateur']);

    if ($_SESSION['login'] === 'redacteur'):
       redirectUrl();
    else:
//dd($_SESSION);
       redirectUrl('./adminBlog/');
    endif;
endif;

require '../view/adminBlog/ajout.view.php';
