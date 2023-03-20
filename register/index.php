<?php
/*
* Formulaire d'enregistrement d'un nouvel utilisateur
*/
session_start();

require '../inc/fonctions.php';

$nom = $prenom = $email = $pwd = $errors = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') :

    $prenom = cleanData($_POST['prenom']);
    $nom = cleanData($_POST['nom']);
    $email = cleanData($_POST['email']);
    $pwd = cleanData($_POST['pwd']);
    $role = cleanData($_POST['role']);

    if ($email && $pwd) :
        if (findEmail($email)) :
            $errors = 'Veuiller choisir une autre adreese email !';
        else :
            $lastIdUtilisateur = insertUtilisateur($nom,$prenom, $email, $pwd,$role);
            $_SESSION['login'] = findEmail($email)['role'];

            $_SESSION['id_utilisateur'] = $lastIdUtilisateur;
            if($role === 'admin'):
               redirectUrl('./adminBlog/');
            else:
               redirectUrl();
            endif;
        endif;
    else :
        $errors = 'Votre email ou mot de passe sont incorrect !';
    endif;
endif;

require '../view/register/index.view.php';
