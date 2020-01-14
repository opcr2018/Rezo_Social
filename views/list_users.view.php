<?php $title = 'Liste des Utilisateurs'; ?>
<?php include('partials/_header.php'); ?>


<div id="main-content">
    <div class="container">
        <h1>Liste des Utilisateurs</h1>
        <?php foreach (array_chunk($users, 4) as $user_set): ?>
        <div class="row users">
            <?php foreach ($user_set as $user): ?>
            <div class="col-md-3 user-block">
                <a href="profile.php?id=<?= $user->id ?>"><img
                        src="<?= $user->avatar ? $user->avatar : get_avatar_url($user->email, 50) ?>"
                        alt="image de profil de <?= e($user->pseudo) ?>"
                        class="avatar-md"><br />
                </a>
                <h4 class="user-block-username">
                    <a href="profile.php?id=<?= $user->id ?>">
                        <?= e($user->pseudo) ?>
                    </a>
                </h4>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endforeach; ?>
        <div id="pagination"><?= $pagination ?>
        </div>
    </div>
</div>



<?php include('partials/_footer.php');
