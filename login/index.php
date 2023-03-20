<?php
/*
 * Formulaire de connexion
 */
session_start();
include '../inc/fonctions.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') :
    $email = cleanData($_POST['email']);
    $pwd = cleanData($_POST['pwd']);

    if ($email) :
        if (findEmail($email)) :
            if (password_verify($pwd, findEmail($email)['pwd'])) :
                $_SESSION['login'] = findEmail($email)['role'];
                $_SESSION['id_utilisateur'] = findEmail($email)['id_utilisateur'];

                if (findEmail($email)['role'] === 'admin') :
                   redirectUrl('adminBlog/');
                endif;

                redirectUrl();
            else :
                $errors[] = 'Le mot de passe est non valide.';
            endif;
        else :
            echo 'Votre email n\'est pas enregistré comme utilisateur de notre site.<br>';
            echo 'Veuillez vous enregister avec <a href="../register">ce formulaire</a>';
            exit();
        endif;

    else :
        $errors[] = 'Votre email est manquant ou incorrect !';
    endif;

endif;

require '../view/login/index.view.php';
