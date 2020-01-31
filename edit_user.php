<?php
session_start();
require("includes/init.php");
include('filters/auth_filter.php');



if (!empty($_GET['id']) && $_GET['id'] === get_session('user_id')) {
    //recuperer les infos d'user en bdd
    $user = find_user_by_id($_GET['id']);

    if (!$user) {
        redirect('index.php');
    }
} else {
    redirect('profile.php?id=' . get_session('user_id'));
}

if (isset($_POST['update'])) {
    //Si tous les champs ont été complétés
    if (not_empty(['name', 'city', 'country', 'sex', 'bio'])) {
        $errors = [];

        extract($_POST);

        //mise à jour du profil
        $q = $db->prepare('UPDATE users 
        SET name = :name, city = :city, country = :country, 
            sex = :sex, twitter = :twitter, github = :github, 
            available_for_hire = :available_for_hire, bio = :bio 
            WHERE id = :id');
        $q->execute([
            'name'               => $_POST['name'],
            'city'               => $_POST['city'],
            'country'            => $_POST['country'],
            'sex'                => $_POST['sex'],
            'twitter'            => $_POST['twitter'],
            'github'             => $_POST['github'],
            'available_for_hire' => !empty($_POST['available_for_hire']) ? '1' : '0',
            'bio'                => $_POST['bio'],
            'id'                 => get_session('user_id')
        ]);

        set_flash("Félicitations, votre profil a été mis à jour !");
        redirect('profile.php?id='.get_session('user_id'));
    } else {
        save_input_data();
        $errors[] = "Veuillez remplir tous les champs marqués d'un (*)";
    }
} else {
    clear_input_data();
}

//Upload d'une image pour l'avatar
$targetFolder = '/uploads/'.$_SESSION['user_id'];

if (!empty($_FILES) && $_FILES['avatar']['error'] == 0 && !empty($_GET['id'])) {
    $file_tmp_name = $_FILES['avatar']['tmp_name'];
    $targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;

    if (!file_exists($targetPath)) {
        mkdir($targetPath, 0755, true);
    }
    $fileTypes = array('.jepg', '.jpg', '.png', '.gif');
    $file_name = $_FILES['avatar']['name'];
    $file_extension = strrchr($file_name, ".");
    
    $file_rand_name = md5(uniqid(rand())).$file_extension;
    $file_path = rtrim($targetPath).'/'.$file_rand_name;
    

    if (in_array($file_extension, $fileTypes)) {
        if (move_uploaded_file($file_tmp_name, $file_path)) {
            $q = $db->prepare("UPDATE users
                               SET avatar = :avatar
                               WHERE id = :id");
            $q->execute([
                'avatar' => $targetFolder.'/'.$file_rand_name,
                'id'     => $_SESSION['user_id']
            ]);
            
            $_SESSION['avatar'] = $targetFolder.'/'.$file_rand_name;

            set_flash('Le fichier a été envoyé avec succès !', 'success');
            redirect('profile.php?id='.get_session('user_id'));
        } else {
            set_flash("Une erreur est survenue lors de l'envoi du fichier.", 'warning');
        }
    } else {
        set_flash('Seuls les fichiers images (jpg, png, gif) sont autorisés', 'warning');
    }
}

require("views/edit_user.view.php");
