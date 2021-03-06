<?php
session_start();
require("includes/init.php");
include('filters/auth_filter.php');

if (!empty($_GET['id'])) {
    $q = $db->prepare('SELECT * FROM codes WHERE id = ?');
    $success = $q->execute([$_GET['id']]);

    $data = $q->fetch(PDO::FETCH_OBJ);

    if (!$data) {
        redirect('share_code.php');
    }
} else {
    redirect('share_code.php');
}

?>
<?php require('views/show_code.view.php'); ?>