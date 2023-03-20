<?php
/*
* Fonctions utiles au fonctionnnent du projet
*/
error_reporting(E_ALL);
ini_set('display_errors', '1');

function dbug($valeur)
{
   echo "<pre style='background-color:black;color:white;padding: 15px;overflow: auto;'>";
   var_dump($valeur);
   echo "</pre>";
}

function dd($valeur)
{
   echo "<pre style='background-color:black;color:white;padding: 15px;overflow: auto;height: 500px;'>";
   var_dump($valeur);
   // print_r($valeur);
   echo "</pre>";
   die();
}

function cleanData($valeur)
{
   if (!empty($valeur) && isset($valeur)) :
      $valeur = strip_tags(trim($valeur));
      return $valeur;
   else :
      return false;
   endif;
}

function textData($valeur)
{
   $valeur = preg_match('/^[a-z-A-Z]*$/', $valeur);
   return $valeur;
}

function isGetIdValid(): bool
{
   if (isset($_GET['id']) && is_numeric($_GET['id'])):
      return true;
   else:
      return false;
   endif;
}

function getArticleLimit(int $limit, int $offset): array
{
   require 'pdo.php';
   $sqlRequest = "SELECT * FROM article ORDER BY id_article DESC LIMIT :limit OFFSET :offset";
   $resultat = $conn->prepare($sqlRequest);
   $resultat->bindValue(':limit', $limit, PDO::PARAM_INT);
   $resultat->bindValue(':offset', $offset, PDO::PARAM_INT);
   $resultat->execute();
   return $resultat->fetchAll();
}

function getArticleById(int $idArticle): array
{
   require 'pdo.php';
   $sqlRequest = "SELECT * FROM article WHERE id_article = :idArticle";
   $resultat = $conn->prepare($sqlRequest);
   $resultat->bindValue(':idArticle', $idArticle, PDO::PARAM_INT);
   $resultat->execute();
   return $resultat->fetch();
}

function suppArticleById(int $idArticle): bool
{
   require 'pdo.php';
   $sqlRequest = "DELETE FROM article WHERE id_article = :idArticle";
   $resultat = $conn->prepare($sqlRequest);
   $resultat->bindValue(':idArticle', $idArticle, PDO::PARAM_INT);
   return $resultat->execute();
}

function insertArticle(string $titre, string $contenu, string $image_url, int $id_utilisateur): int
{
   require 'pdo.php';
   $requete = 'INSERT INTO article (titre,contenu,image_url,id_utilisateur) VALUES (:titre, :contenu, :image_url, :id_utilisateur)';
   $resultat = $conn->prepare($requete);
   $resultat->bindValue(':titre', $titre, PDO::PARAM_STR);
   $resultat->bindValue(':contenu', $contenu, PDO::PARAM_STR);
   $resultat->bindValue(':image_url', $image_url, PDO::PARAM_STR);
   $resultat->bindValue(':id_utilisateur', $id_utilisateur, PDO::PARAM_STR);
   $resultat->execute();
   return $conn->lastInsertId();
}

function updateArticle(int $id_article, string $titre, string $contenu, string $image_url): bool
{
   require 'pdo.php';
   $requete = 'UPDATE article SET titre = :titre, contenu = :contenu,image_url = :image_url WHERE id_article = :id_article';
   $resultat = $conn->prepare($requete);
   $resultat->bindValue(':id_article', $id_article, PDO::PARAM_INT);
   $resultat->bindValue(':titre', $titre, PDO::PARAM_STR);
   $resultat->bindValue(':contenu', $contenu, PDO::PARAM_STR);
   $resultat->bindValue(':image_url', $image_url, PDO::PARAM_STR);
   $resultat->execute();
   return $resultat->execute();
}

function isUserLogin(): bool
{
   if (isset($_SESSION['login']) && $_SESSION['login'] == true) :
      return true;
   else :
      return false;
   endif;
}

function findEmail(string $email): array|bool
{
   require 'pdo.php';

   $requete = 'SELECT * FROM utilisateur where email = :email';
   $resultat = $conn->prepare($requete);
   $resultat->bindValue(':email', $email, PDO::PARAM_STR);
   $resultat->execute();
   return $resultat->fetch();
}

function insertUtilisateur(string $nom,string $prenom, string $email, string $pwd,string $role): int
{
   require 'pdo.php';
   $pwdHashe = password_hash($pwd, PASSWORD_DEFAULT);

   $requete = 'INSERT INTO utilisateur (nom,prenom,email,pwd,role) VALUES (:nom, :prenom, :email, :pwd, :role)';
   $resultat = $conn->prepare($requete);
   $resultat->bindValue(':nom', $nom, PDO::PARAM_STR);
   $resultat->bindValue(':prenom', $prenom, PDO::PARAM_STR);
   $resultat->bindValue(':email', $email, PDO::PARAM_STR);
   $resultat->bindValue(':pwd', $pwdHashe, PDO::PARAM_STR);
   $resultat->bindValue(':role', $role, PDO::PARAM_STR);
   $resultat->execute();
   return $conn->lastInsertId();
}

function getUtilisateurAll(): array
{
   require 'pdo.php';
   $sqlRequest = "SELECT * FROM utilisateur";

   $resultat = $conn->prepare($sqlRequest);
   $resultat->execute();
   return $resultat->fetchAll();
}

function error404(): void
{
   http_response_code(404);
   include('../view/404.php');
   die();
}

function redirectUrl(string $path = ''): void
{
   $homeUrl = 'http://' . $_SERVER['HTTP_HOST']. '/astronomie_blog' ;
   $homeUrl .= '/'. $path;
   header("Location: {$homeUrl}");
   exit();
}
