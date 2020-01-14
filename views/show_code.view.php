<?php $title = 'Affichage du code source'; ?>
<?php include('partials/_header.php'); ?>

<div id="main-content">
    <div id="main-content-share-code">
        <pre class="prettyprint linenums"><?= e($data->code) ?></pre>
        <div class="btn-group share-nav">
            <a href="share_code.php?id=<?= $_GET['id'] ?>" class="btn btn-warning">Cloner</a>
            <a href="share_code.php" class="btn btn-info">Nouveau</a>
        </div>
    </div>
</div>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<!-- Prettify js -->
<script src="assets/js/prettify.js"></script>
<script>
    prettyPrint();
</script>
</body>

</html>