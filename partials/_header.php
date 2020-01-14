<!DOCTYPE html>
<html lang='fr'>

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">

  <meta name="description" content="blog pour présenter mes différents travaux" />
  <meta name="keywords" content="pizza, dev, php, mysql, twig, visual code" />
  <meta charset="utf-8" />
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <!--Compatibilite avec le dernier IE-->
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!--Compatibilite avec les petits ecrans-->
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- titre -->
  <title>
    <?= isset($title)
        ? $title .' - '.WEBSITE_NAME 
        : WEBSITE_NAME.' - simple, rapide, efficace';
    ?>

  </title>


  <!-- Style personnel -->
  <link rel="stylesheet" href="assets/css/style.css" />

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.3.1/simplex/bootstrap.min.css">
  <!-- Font awesome-->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Code+Pro&display=swap">
  <!-- Prettify css -->
  <link rel="stylesheet" href="assets/css/prettySkins/sunburst.css" />
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]> <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script> <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script> <![endif]-->
</head>

<body>

  <?php include('partials/_nav.php'); ?>
  <?php include('partials/_flash.php'); ?>