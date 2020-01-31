<?php
session_start();
require("includes/init.php");
require('bootstrap/locale.php');
include('filters/guest_filter.php');
require('config/database.php');
require('includes/functions.php');
require('includes/constants.php');

//Si le formulaire a été soumis
if (isset($_POST['register'])) {

    //Si tous les champs ont été complétés
    if (not_empty(['name', 'pseudo', 'email', 'password', 'password_confirm'])) {
        $errors = [];
        $name             = htmlspecialchars($_POST['name']);
        $username         = htmlspecialchars($_POST['pseudo']);
        $email            = htmlspecialchars($_POST['email']);
        $password         = htmlspecialchars($_POST['password']);
        $password_confirm = htmlspecialchars($_POST['password_confirm']);

        if (mb_strlen($_POST['pseudo']) < 3) {
            $errors[] = "Pseudo trop court (Minimum 3 caractères)";
        }

        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Adresse email invalide";
        }

        if (mb_strlen($_POST['password']) < 6) {
            $errors[] = "Mot de passe trop court (Minimum 6 caractères)";
        } else {
            if ($_POST['password'] != $_POST['password_confirm']) {
                $errors[] = "Les deux mot de passe ne concordent pas !";
            }
        }

        if (is_already_in_use('name', $_POST['name'], 'users')) {
            $errors[] = "Nom déjà utilisé";
        }

        if (is_already_in_use('pseudo', $_POST['pseudo'], 'users')) {
            $errors[] = "Pseudo déjà utilisé";
        }

        if (is_already_in_use('email', $_POST['email'], 'users')) {
            $errors[] = "Adresse email déjà utilisé";
        }

        if (count($errors) == 0) {

            /**Envoi du mail d'activation
             * pour activer le compte par l'administrateur, 
             * commenter les lignes 53 et 59 et enlever // devant :
             * //$to = MAIL_ADMIN;
             * //require('templates/emails/admin_activation.tpml.php');       
             **/

            $to = $_POST['email'];
            //$to = MAIL_ADMIN;
            $subject = WEBSITE_NAME . " - ACTIVATION DE COMPTE";
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT, array($options = 12));
            $token = sha1($_POST['pseudo'] . $_POST['email'] . $password);
            ob_start();
            require('templates/emails/user_activation.tpml.php');
            //require('templates/emails/admin_activation.tpml.php');
            $content = ob_get_clean();

            $headers = 'MIME-VERSION: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

            mail($to, $subject, $content, $headers);

            //informer l'utilisateur pour qu'il verifie sa BAL
            set_flash("Un message de confirmation vous a été envoyé.", 'success');

            //enregistrer les informations du user dans la bdd
            $q = $db->prepare('INSERT INTO users(name, pseudo, email, password) 
                               VALUES(:name, :pseudo, :email, :password)');
            $q->execute([
                'name' => $_POST['name'],
                'pseudo' => $_POST['pseudo'],
                'email' => $_POST['email'],
                'password' => $password
            ]);
            
            redirect('index.php');
        } else {
            save_input_data();
        }
    } else {
        $errors[] = "Veuillez SVP remplir tout les champs";
        save_input_data();
    }
} else {
    clear_input_data();
}

?>


    
<?php require('views/register.view.php'); ?>