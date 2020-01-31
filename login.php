<?php
session_start();
require("includes/init.php");
require("bootstrap/locale.php");
include('filters/guest_filter.php');
require('config/database.php');
require('includes/functions.php');
require('includes/constants.php');

//Si le formulaire a été soumis
if (isset($_POST['login'])) {
    //Si tous les champs ont été complétés
    if (not_empty(['identifiant', 'password'])) {
        $errors = [];

        extract($_POST);

        $q = $db->prepare("SELECT id, pseudo, avatar, password AS hashed_password, email FROM users 
        WHERE (pseudo = :identifiant OR email = :identifiant)
        AND active = '1'");

        $q->execute([
            'identifiant' => $identifiant
        ]);

        $user = $q->fetch(PDO::FETCH_OBJ);

        if ($user && password_verify($password, $user->hashed_password)) {
            $_SESSION['pseudo'] = $user->pseudo;
            $_SESSION['user_id'] = $user->id;
            $_SESSION['avatar'] = $user->avatar;
            $_SESSION['email'] = $user->email;

            //si l'utilisateur souhaite de garder sa session active
            if(isset($_POST['remember_me']) && $_POST['remember_me'] == 'on')
            {
                setcookie('pseudo', $user->pseudo, time()+3600*24*365, null, null, false, true);
                setcookie('user_id', $user->id, time()+3600*24*365, null, null, false, true);
                setcookie('avatar', $user->avatar, time()+3600*24*365, null, null, false, true);
            }

            redirect_intent_or('profile.php?id=' . $user->id);
        } else {
            set_flash('Combinaison Identifiant/Password incorrect', 'warning');
            save_input_data();
        }


    }
} else {
    clear_input_data();
}
?>

    
<?php require("views/login.view.php"); ?>