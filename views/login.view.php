<?php $title = 'Connexion'; ?>
<?php include('partials/_header.php'); ?>

<div id="main-content">
        <div class="container">
                <h1 class="lead">Connexion</h1>

                <?php include('partials/_errors.php'); ?>

                <form data-parsley-validate method="POST" class="well col-md-6" autocomplete="off">

                        <!-- Identifiant field -->
                        <div class="form-group">
                                <label class="control-label" for="identifiant">Pseudo ou Adresse électronique : </label>
                                <input type="text" value="<?= get_input('identifiant') ?>" class="form-control" id="identifiant" name="identifiant" required="required" />
                        </div>

                        <!-- Password field -->
                        <div class="form-group">
                                <label class="control-label" for="password">Mot de passe : </label>
                                <input type="password" class="form-control" id="password" name="password" required="required" />
                        </div>

                        <!-- Remember me field -->
                        <div class="form-group">
                                <label class="control-label" for="remember_me">
                                     <input type="checkbox" id="remember_me" name="remember_me"> 
                                     Garder ma session active 
                                </label>                               
                        </div>

                       
                        <input type="submit" class="btn btn-primary" value="Connextion" name="login" />



                </form>




        </div><!-- /.container -->
</div>





<?php include('partials/_footer.php'); ?>