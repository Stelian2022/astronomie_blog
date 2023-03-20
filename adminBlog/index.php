<?php
/*
* Page qui appel la vue pour la gestion des films
*/
session_start();
include '../inc/fonctions.php';

$limit = 10;
$offset = 0;

require '../view/adminBlog/index.view.php';
