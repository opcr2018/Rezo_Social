<?php
session_start();
require('includes/init.php');
include('filters/auth_filter.php');

if (isset($_POST['change_password'])) {
    //Si tous les champs ont été complétés
    if (not_empty(['current_password', 'new_password', 'new_password_confirmation'])) {
        $errors = [];

        extract($_POST);

        if (mb_strlen($_POST['new_password']) < 6) {
            $errors[] = "Mot de passe trop court (Minimum 6 caractères)";
        } else {
            if ($_POST['new_password'] != $_POST['new_password_confirmation']) {
                $errors[] = "Les deux mot de passe ne concordent pas !";
            }
        }


        // On verifie sur le mot de passe appartient à l'utilisateur
        if (count($errors) == 0) {
            $q = $db->prepare("SELECT password AS hashed_password
                               FROM users 
                               WHERE id = :id");
    
            $q->execute([
                'id' => get_session('user_id')
            ]);
    
            $user = $q->fetch(PDO::FETCH_OBJ);
            
            
            if ($user && password_verify($current_password, $user->hashed_password)) {
        
            //mise à jour du profil
                $q = $db->prepare('UPDATE users 
        SET password = :password
            WHERE id = :id');
                $q->execute([
            'password'  => password_hash($_POST['new_password'], PASSWORD_BCRYPT, array($options = 12)),
            'id'        => get_session('user_id')
        ]);

                set_flash("Félicitations, votre profil a été mis à jour !");
                redirect('profile.php?id='.get_session('user_id'));
            } else {
                save_input_data();
                $errors[] = "Le mot de passe actuel n'est pas incorrect";
            }
        }
    } else {
        save_input_data();
        $errors[] = "Veuillez remplir tous les champs marqués d'un (*)";
    }
} else {
    clear_input_data();
}


require("views/change_password.view.php");
