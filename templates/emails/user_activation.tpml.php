<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset='utf-8'>
</head>

<body>
    <div id="main-content">
        <div class="container">
            <div class="jumbotron">
                <h1>Activation de compte !</h1>
                Pour activer votre compte, veuillez cliquer sur ce lien :<a href="<?= WEBSITE_URL.'/activation.php?p='.$_POST['pseudo'].'&amp;token='.$token ?>">Lien d'activation<br /></a>
               <p> Bonne journée ! </p>
            </div>

        </div>

</body>

</html>