<?php
/*
 * Page de deconnexion
 */
session_start();
session_unset();
session_destroy();
require '../inc/fonctions.php';
redirectUrl();
