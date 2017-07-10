<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="Λαβύρινθος - Η ταβέρνα του Αντύπα">
    <meta name="author" content="anpel">
    <title>Restaurant Menu Manager</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Bootstrap table -->
    <link rel="stylesheet" href="assets/css/bootstrap-table.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap-editable.css">

    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]--> 
</head>
 <body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="?action=plates">Restaurant Name</a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="?action=plates">Plates</a></li>
                    <li><a href="?action=categories">Categories</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Options <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="?action=plate_create">New plate</a></li>
                            <li><a href="?action=category_create">New category</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="?action=menu" target="_blank">Printable English Menu</a></li>
                            <li><a href="?action=menu&language=gr" target="_blank">Printable Greek Menu</a></li>
                            <li><a href="?action=menu&language=it" target="_blank">Printable Italian Menu</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>

    <div class="container">
        <div class="content">
        <p class="custom-date"><?php echo date('j/n/Y'); ?></p>
            <img class="padding-bottom" src="assets/images/restaurant_logo.jpg" alt="Restaurant logo" />
