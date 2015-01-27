<?php

function head($page = 'Home') {
	$head = '
	<html>
  <head>
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="shortcut icon" sizes="196x196" href="favicon.png">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/DisVia.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/heartcode-canvasloader.js"></script>

    <link rel="manifest" href="manifest.json">
    <title>Dis-Via</title>
    <meta name="viewport" content="width=device-width">
    <meta charset="UTF-8">
    <nav class="navbar navbar-inverse" role="navigation">
        <div class="container-fluid">
          <div class="navbar-header">

              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="index.php">Dis-Via v1.2</a>
              <a href="index.php"><button type="button" class="navbar-toggle"><span class="glyphicon glyphicon-refresh"></span></button></a>
          </div>
          <div class="collapse navbar-collapse" id="menu-collapse">
              <ul class="nav navbar-nav">
                <li><a href="set.php"><span class="glyphicon glyphicon-plus"></span> Ajouter un arrêt</a></li>
                <li><a href="del.php"><span class="glyphicon glyphicon-trash"></span> Supprimer un arrêt</a></li>
              </ul>

              <ul class="nav navbar-nav navbar-right">

              </ul>
          </div>
        </div>
    </nav>
  </head>
  
  <body>';
  echo $head;
}

function foot() {
	echo "  </body>
</html>";
}

?>