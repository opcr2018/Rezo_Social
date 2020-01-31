<?php $title = 'Accueil'; ?>
<?php include('partials/_header.php'); ?>

<div id="main-content">
  <div class="container">
    <div class="jumbotron">
      <h1><?= WEBSITE_NAME; ?></h1>
      <p><?= WEBSITE_NAME; ?> est le réseau social des développeurs.<br />
        Et qui dit développeurs, dit également code source !<br />
        Grâce à cette plateforme, vous avez la possiblité de tisser des liens d'amitié avec d'autres développeurs,
        échanger des codes soruces, recevoir de l'aide si vous rencontrez des problèmes sur l'un de vos projets et bien
        plus encore !<br />
        Alors n'hésitez plus et <a href="register.php">rejoignez dès maintenant la communauté Rez !</a>
      </p>
      <a href="register.php" class="btn btn-primary btn-plg">Créer un compte</a>
    </div>

  </div><!-- /.container -->
</div>





<?php include('partials/_footer.php'); ?>