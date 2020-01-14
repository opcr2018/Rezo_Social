<?php $title = 'Partage de codes sources'; ?>
<?php include('partials/_header.php'); ?>

<div id="main-content">
    <div id="main-content-share-code">
        <form action="" method="POST" autocomplete="off">
            <textarea name="code" id="code" placeholder="Entrez votre code ici..."><?= e($code) ?></textarea>
            <div class="btn-group share-nav">
                <a href="share_code.php" class="btn btn-primary">Tout effacer !</a>
                <input type="submit" name="save" class="btn btn-success" value="Enregistrer">
            </div>
        </form>

    </div><!-- /.container -->
</div>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="assets/js/tabby.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
    $("#code").tabby(); //tabby se substitue au textarea pour avoir accès au tabulation
    $("#code").height($(window).height() - 50); //hauteur de la fenêtre de l'éditeur de texte
</script>

</body>

</html>