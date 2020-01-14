<?php $title = 'Edition de profil'; ?>
<?php include('partials/_header.php'); ?>

<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col d-flex justify-content-center">
                <div class="card" id="edit">
                    <?php !empty($_GET['id']) && $_GET['id'] === get_session('user_id') ?: redirect('index.php'); ?>
                    <h5 class="card-header">Compléter mon profil</h5>
                    <div class="card-body">
                        <?php include('partials/_errors.php'); ?>
                        <p class="card-text">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="avatar">Changer mon avatar</label>
                                    <p><img src="<?= $user->avatar ? $user->avatar : get_avatar_url(get_session('email'), 50) ?>"
                                            alt="image de profil de <?= e($user->pseudo) ?>"
                                            class="avatar-md"><br /></p>
                                    <form method="POST" enctype="multipart/form-data" autocomplete="off">
                                        <input action="edit_user.php" type="file" name="avatar"><br /><br />
                                        <input type="submit" class="btn btn-default" value="Envoyer">
                                    </form>
                                </div>
                            </div>
                        </p>

                        <form data-parsley-validate method="POST" autocomplete="off">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name">Nom<span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="John"
                                        value="<?= get_input('name') ?: e($user->name) ?>"
                                        required="required">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="city">Ville<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="city" id="city"
                                        value="<?= get_input('city') ?: e($user->city) ?>"
                                        required="required">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="country">Pays<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="country" id="country"
                                        value="<?= get_input('country') ?: e($user->country) ?>"
                                        required="required">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="sex">Sexe<span class="text-danger">*</span></label>
                                    <select name="sex" id="sex" required="required" class="form-control">

                                        <option value="H" <?= $user->sex == "H"
                                                        ? "selected"
                                                        : ''
                                                    ?>>Homme</option>
                                        <option value="F" <?= $user->sex == "F"
                                                        ? "selected"
                                                        : ''
                                                    ?>>Femme</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="twitter">Twitter</label>
                                    <input type="text" class="form-control" name="twitter" id="twitter"
                                        value="<?= get_input('twitter') ?: e($user->twitter) ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="github">Github</label>
                                    <input type="text" class="form-control" name="github" id="github"
                                        value="<?= get_input('github') ?: e($user->github) ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="available_for_hire"
                                        id="available_for_hire" <?= $user->available_for_hire ? "checked" : '' ?>>
                                    <label class="form-check-label" for="available_for_hire">
                                        Disponible pour emploi ?
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="bio">Biographie<span class="text-danger">*</span></label>
                                <textarea class="form-control" name="bio" id="bio" rows="10" required="required"
                                    placeholder="Je suis amoureux de la commande en ligne..."><?= get_input('bio') ?: e($user->bio) ?></textarea>
                            </div>
                            <input type="submit" class="btn btn-primary" name="update" value="Valider" />
                        </form>
                        </p>

                    </div>
                </div>
            </div>
            <?php //endif;
    ?>
        </div>
    </div>
</div>

<?php include('partials/_footer.php');
