<?php
session_start();

require("bootstrap/locale.php");
include('filters/auth_filter.php');
require('config/database.php');
require('includes/functions.php');

if (isset($_POST['publish'])) {

    if (!empty($_POST['content'])) {
        $errors = [];
        $content = e($_POST['content']);
        
        if (mb_strlen($_POST['content']) < 3) {
            $errors[] = "Minimum 3 caractères";
        }

        if (mb_strlen($_POST['content']) > 140) {
            $errors[] = "Maximum 140 caractères";
        }

        if (count($errors) == 0) {
            $q = $db->prepare("INSERT INTO microposts(content, user_id, created_at) 
                               VALUES(:content, :user_id, NOW())");
            $q->execute([
                'content' => $content,
                'user_id' => get_session('user_id')
            ]);

            set_flash('Votre statut a été mis à jour', 'info');
            redirect('profile.php?id='.get_session('user_id'));        } else {
            set_flash('Contenu invalide', 'warning');
            redirect('profile.php?id='.get_session('user_id'));
            
        }
    }
}

