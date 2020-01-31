<?php
session_start();

// Supprimer l'entree en bdd au niveau de auth_tokens
require('config/database.php');
$q = $db->prepare("DELETE FROM auth_tokens WHERE user_id = ?");
$q->execute([$_SESSION['user_id']]);

// Supprimer les cookies et détruire la session
setcookie('auth', '', time()-3600);
session_destroy();
$_SESSION = [];

header('Location: login.php');

?>
