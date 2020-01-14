<article class="media statut-media">
    <div class="pull-left">
        <img src="<?= $user->avatar ? $user->avatar : get_avatar_url(get_session('email'), 50) ?>"
            alt="<?= e($user->pseudo) ?>" class="media-object avatar-xs">
    </div>
    <div class="media-body">
        <h4><?= $user->pseudo ?>
        </h4>
        <p>
            <i class="fa fa-clock-o"></i>
            <span class="timed"
                title="<?= e($micropost->created_at) ?>">
                <?= e($micropost->created_at) ?>
            </span>
        </p>
        <?= nl2br(e($micropost->content)) ?>
    </div>
</article>
