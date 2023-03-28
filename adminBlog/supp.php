<?php
/*
* Suppression d'un film
*/
include '../inc/fonctions.php';
(isAdminLogin()) ?: redirectUrl('view/404.php');
$id = $_GET['id'];

if (suppArticleById($id)) :
   header('Location: ./index.php');
   exit();
else :
   exit('Erreur s\'est produite !');
endif;
