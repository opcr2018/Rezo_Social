<?php $title = 'Page de profil'; ?>
<?php include('partials/_header.php'); ?>


<div id="main-content">
        <div class="container">
                <div class="row">
                        <div class="col-md-6">
                                <div class="card">
                                        <?php include('partials/_errors.php'); ?>
                                        <h5 class="card-header">Profil de <?= e($user->pseudo) ?>
                                        </h5>
                                        <div class="card-body">
                                                <p class="card-text"> <img
                                                                src="<?= $user->avatar ? $user->avatar : get_avatar_url(get_session('email'), 50) ?>"
                                                                alt="image de profil de <?= e($user->pseudo) ?>"
                                                                class="img-thumbnail avatar-md"><br /></p>
                                                <div class="row">
                                                        <div class="col-md-6">
                                                                <p class="card-text">
                                                                        <?= e($user->pseudo) ?><br />
                                                                        <a
                                                                                href="mailto:<?= e($user->email) ?>"><?= e($user->email) ?></a>
                                                                        <br />
                                                                        <?= $user->city && $user->country
                                                                                ? '<i class="fa fa-location-arrow">&nbsp;</i>' . e($user->city) . ' - ' . e($user->country) . '<br />'
                                                                                : '';
                                                                        ?>
                                                                        <a href="//www.google.fr/maps?q=<?= e($user->city) . ' ' . e($user->country) ?>"
                                                                                target="_blank">Voir sur
                                                                                GoogleMaps</a><br />
                                                                </p>
                                                        </div>
                                                        <div class="col-md-6">
                                                                <p class="card-text">
                                                                        <?= $user->twitter
                                                                                ? '<i class="fa fa-twitter">&nbsp;</i> <a href="//twitter.com/' . e($user->twitter) . '"> @' . e($user->twitter) . '</a><br />'
                                                                                : '';
                                                                        ?>
                                                                        <?= $user->github
                                                                                ? '<i class="fa fa-github"></i>&nbsp;<a href="//github.com/' . e($user->github) . '">' . e($user->github) . '</a><br />'
                                                                                : '';
                                                                        ?>
                                                                        <?= $user->sex == "H"
                                                                                ? '<i class="fa fa-male"></i>'
                                                                                : '<i class="fa fa-female"></i>';
                                                                        ?>
                                                                        <?= $user->available_for_hire
                                                                                ? 'Disponible pour emploi'
                                                                                : 'Non disponible pour emploi';
                                                                        ?>
                                                                </p>
                                                        </div>
                                                </div>
                                        </div>
                                        <div class="row well">
                                                <div class="col-md-12">
                                                        <div class="card">
                                                                <h5 class="card-header"> Petite biographie de <?= e($user->pseudo) ?>
                                                                </h5>
                                                                <p class="card-text">
                                                                        <?= $user->bio
                                                                                ? nl2br(e($user->bio))
                                                                                : 'Aucune biographie pour le moment...';
                                                                        ?>
                                                                </p>
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                        </div>
                        <div class="col-md-6">
                                <?php if (!empty($_GET['id']) && $_GET['id'] === get_session('user_id')): ?>
                                <div class="statut-post">
                                        <form action="microposts.php" method="post" data-parsley-validate>
                                                <div class="form-group">
                                                        <label for="content" class="sr-only">Statut : </label>
                                                        <textarea name="content" id="content" rows="5"
                                                                class="form-control" placeholder="Alors quoi de neuf ?"
                                                                data-parsley-minlength="3" required="required" data-parsley-maxlength="140"></textarea>
                                                </div>
                                                <div class="form-group statut-post-submit">
                                                        <input type="submit" name="publish" value="Publier"
                                                                class="btn btn-secondary btn-sm" />
                                                </div>
                                        </form>
                                </div>
                                <?php endif; ?>

                                <?php if (count($microposts) != 0): ?>
                                <?php foreach ($microposts as $micropost) : ?>
                                <?php include('partials/_micropost.php'); ?>
                                <?php endforeach; ?>
                                <?php else: ?>
                                <p>Cet utilisateur n'a encore rien posté pour le moment...</p>
                                <?php endif; ?>
                        </div>
                </div><!-- /.container -->
        </div>
</div>

 <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="lib/parsley/parsley.min.js"></script>
    <script src="lib/parsley/i18n/fr.js"></script>
    <script src="assets/js/jquery.timeago.js"></script>

    <script type="text/javascript">
      window.ParsleyValidator.setlocale('fr');
      </script>
      <script type="text/javascript">
      $(document).ready(function() { 
              $(".timed").timeago();
      });
    </script>
    </body>

    </html>
