<?php
session_start();
require('includes/init.php');

include('filters/auth_filter.php');

if (!empty($_GET['id'])) {
    //recuperer les infos d'user en bdd
    $user = find_user_by_id($_GET['id']);

    if (!$user) {
        redirect('index.php');
    } else {
        $q = $db->prepare("SELECT content, created_at FROM microposts WHERE user_id = :user_id ORDER BY created_at DESC");

        $q->execute([
            'user_id' => $_GET['id']
        ]);

        $microposts = $q->fetchAll(PDO::FETCH_OBJ);
    }
} else {
    redirect('profile.php?id=' . get_session('user_id'));
} 



require("views/profile.view.php");
