<?php
session_start();
require("includes/init.php");
include('filters/auth_filter.php');


if (!empty($_GET['id'])) {
    $q = $db->prepare('SELECT code FROM codes WHERE id = ?');
    $success = $q->execute([$_GET['id']]);

    $data = $q->fetch(PDO::FETCH_OBJ);

    if (!$data) {
        $code = "";
    } else {
        $code = $data->code;
    }
} else {
    $code = "";
}

//Si le formulaire a été soumis
if (isset($_POST['save'])) {
    if (not_empty(['code'])) {
        extract($_POST);
        $q = $db->prepare('INSERT INTO codes(code) VALUES(?)');
        $success = $q->execute([$code]);

        if ($success) {
            $id = $db->lastInsertId();
            redirect('show_code.php?id=' . $id);
        } else {
            set_flash("Erreur lors de l'ajout du code source. Veuillez réessayer SVP.");
            redirect("share_code.php");
        }
    } else {
        redirect('share_code.php');
    }
}
?>

<?php require('views/share_code.view.php'); ?>
