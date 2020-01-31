<?php $title = 'Changer de mot de password'; ?>
<?php include('partials/_header.php'); ?>

<div id="main-content">
    <div class="container">
        <h1 class="lead">Changez votre mot de passe</h1>

        <?php include('partials/_errors.php'); ?>

        <form data-parsley-validate method="POST" class="well col-md-6" autocomplete="off">

            <!-- Password old -->
            <div class="form-group">
                <label class="control-label" for="current_password">Mot de passe actuel<span
                        class="text-danger">*</span></label>
                <input type="password" class="form-control" id="current_password" name="current_password"
                    required="required" />
            </div>

            <!-- Password new -->
            <div class="form-group">
                <label class="control-label" for="new_password">Nouveau mot de passe<span
                        class="text-danger">*</span></label>
                <input type="password" class="form-control" id="new_password" name="new_password" required="required"
                    data-parsley-minlength="6" />
            </div>

            <!-- Password Confirmation -->
            <div class="form-group">
                <label class="control-label" for="new_password_confirmation">Confirmer votre nouveau mot de passe<span
                        class="text-danger">*</span></label>
                <input type="password" class="form-control" id="new_password_confirmation"
                    name="new_password_confirmation" required="required" data-parsley-equalto="#new_password" />
            </div>

            <input type="submit" class="btn btn-primary" value="Envoyer" name="change_password" />
        </form>
    </div><!-- /.container -->
</div>

<?php include('partials/_footer.php');
