<?php $title = 'Inscription'; ?>
<?php include('partials/_header.php'); ?>

<div id="main-content">
        <div class="container">
                <h1 class="lead">Devenez dès à présent membre !</h1>

                <?php include('partials/_errors.php'); ?>

                <form data-parsley-validate method="POST" class="well col-md-6" autocomplete="off">

                        <!-- Name field -->
                        <div class="form-group">
                                <label class="control-label" for="name">Nom : </label>
                                <input type="text" value="<?= get_input('name') ?>" class="form-control" id="name" name="name" required="required" />
                        </div>

                        <!-- Pseudo field -->
                        <div class="form-group">
                                <label class="control-label" for="pseudo">Pseudo : </label>
                                <input type="text" value="<?= get_input('pseudo') ?>" class="form-control" id="pseudo" name="pseudo" data-parsley-minlength="3" required="required" />
                        </div>

                        <!-- Email field -->
                        <div class="form-group">
                                <label class="control-label" for="email">Adresse Email : </label>
                                <input type="email" value="<?= get_input('email') ?>" class="form-control" id="email" name="email" data-parsley-trigger="change" required="required" />
                        </div>

                        <!-- Password field -->
                        <div class="form-group">
                                <label class="control-label" for="password">Mot de passe : </label>
                                <input type="password" class="form-control" id="password" name="password" required="required" />
                        </div>

                        <!-- Password Confirmation field -->
                        <div class="form-group">
                                <label class="control-label" for="password_confirm">Confirmer votre mot de passe : </label>
                                <input type="password" class="form-control" id="password_confirm" name="password_confirm" required="required" data-parsley-equalto="#password" />
                        </div>

                        <input type="submit" class="btn btn-primary" value="Inscription" name="register" />



                </form>




        </div><!-- /.container -->
</div>





<?php include('partials/_footer.php'); ?>