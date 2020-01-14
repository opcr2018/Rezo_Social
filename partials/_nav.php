<nav class="navbar navbar-expand-md navbar-light bg-light fixed-top">
  <div class="navbar-header">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar"
      aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="index.php"><?= WEBSITE_NAME; ?></a>
  </div>

  <div class="collapse navbar-collapse" id="navbar">
    <ul class="nav navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="list_users.php">Liste des Utilisateurs</a>
      </li>
    </ul>
    <div class="nav navbar-nav d-flex justify-content-end">
      <?php if (is_logged_in()) : //Quand le personne est connectée?>
      <ul class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img
            src="<?= get_session('avatar') ? get_session('avatar') : get_avatar_url(get_session('email'), 50) ?>"
            alt="image de profil de <?=  get_session('pseudo') ?>"
            class="avatar-xs"></a>
        <ul class="dropdown-menu dropdown-menu-lg-right">
          <li
            class="<?= set_active('profile') ?>">
            <a class="nav-link"
              href="profile.php?id=<?= get_session('user_id') ?>"><?= $menu['mon_profil'][$_SESSION['locale']] ?></a>
          </li>
          <li
            class="<?= set_active('edit_user') ?>">
            <a class="nav-link"
              href="edit_user.php?id=<?= get_session('user_id') ?>"><?= $menu['editer_profil'][$_SESSION['locale']] ?></a>
          </li>
          <li
            class="<?= set_active('share_code') ?>">
            <a class="nav-link" href="share_code.php"><?= $menu['share_code'][$_SESSION['locale']] ?></a>
          </li>
          <li class="dropdown-divider"></li>
          <li>
            <a class="nav-link" href="logout.php"><?= $menu['deconnexion'][$_SESSION['locale']] ?></a>
          </li>
        </ul>
      </ul>

      <?php //Quand la personne n'est pas connectée
      else : ?>
      <li
        class="nav-item <?= set_active('login') ?>">
        <a class="nav-link" href="login.php"><?= $menu['connexion'][$_SESSION['locale']] ?></a>
      </li>
      <li
        class="nav-item <?= set_active('register') ?>">
        <a class="nav-link" href="register.php"><?= $menu['inscription'][$_SESSION['locale']] ?></a>
      </li>
      <?php endif; ?>
    </div>
  </div>
</nav>