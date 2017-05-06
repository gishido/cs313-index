<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<?php
    $_SESSION['shop'] = "stoves";
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CS313 - Adam Shumway</title>
    <!-- http://getbootstrap.com/getting-started/ - Latest compiled and minified CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- main css file -->
    <link href="css/main.css" rel="stylesheet" type="text/css">
    <!-- jquery js file...needed for some boostrap functions -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <!-- http://getbootstrap.com/getting-started/ - Latest compiled and minified JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <!-- referencing bootstrap's navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
                <a class="navbar-brand" href="index.php">Adam Shumway</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <!--        <li><a href="#">Link</a></li>
        <li><a href="#">Link</a></li>-->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Assignments <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="shopping.php">Prove03 - Shopping Cart</a></li>
                            <!--<li><a href="#">Assignment 2</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li role="separator" class="divider"></li>-->
                            <li><a href="assignments.html">All Assigments</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
    <!-- browse -->
    <div class="container" id="firstRow">
        <div class="row">
            <h1> Browse Products </h1>
        </div>
        <hr>
    </div>
    <!-- bootstrap thumbnail example http://getbootstrap.com/components/#thumbnails-->
    <div class="row">
        <div class="col-sm-6 col-md-2">
            <div class="thumbnail">
                <img src="img/BioLite.jpg" alt="BioLite">
                <div class="caption">
                    <h3>BioLite Camp Stove</h3>
                    <p>...</p>
                    <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-2">
            <div class="thumbnail">
                <img src="img/CampChefEverest.jpg" alt="CampChef">
                <div class="caption">
                    <h3>Camp Chef Everest</h3>
                    <p>...</p>
                    <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-2">
            <div class="thumbnail">
                <img src="img/ColemanDualFuel.jpg" alt="DualFuel">
                <div class="caption">
                    <h3>Coleman Dual Fuel</h3>
                    <p>...</p>
                    <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-2">
            <div class="thumbnail">
                <img src="img/JetboilMightyMo.jpg" alt="MightyMo">
                <div class="caption">
                    <h3>Jetboil Mighty Mo</h3>
                    <p>...</p>
                    <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-2">
            <div class="thumbnail">
                <img src="img/Reactor.jpg" alt="MSR Reactor">
                <div class="caption">
                    <h3>MSR Reactor</h3>
                    <p>...</p>
                    <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-2">
            <div class="thumbnail">
                <img src="img/WindBurner.jpg" alt="Windburner">
                <div class="caption">
                    <h3>MSR WindBurner</h3>
                    <p>...</p>
                    <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>