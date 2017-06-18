<?php
    session_start();
/*    require("connectdb.php");

    $db = get_db();*/
?>
<!DOCTYPE html>
<html>
    <head>
        <title>PHP Project</title>
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
                    <li><a href="project.php">Project Milestone 1</a></li>
            <!--        <li><a href="#">Link</a></li>
                    <li><a href="#">Link</a></li>-->
                    <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Assignments <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="w5-db.php">Prove05 - Data Access</a></li>
                        <li><a href="w6-db.php">Prove06 - Data Modification</a></li>
                        <li><a href="https://radiant-mesa-28428.herokuapp.com/">Prove09 - Postal Rate</a></li>
                    <!-- <li role="separator" class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li role="separator" class="divider"></li>-->
                        <li><a href="assignments.html">All Assigments</a></li>
                    </ul>
                    </li>
                </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <div class="container" id="project">
            <div class="row">
                <h1>Create Login</h1>
                <hr>
            </div>
        </div>        
        <div class="container">
            <div class="row">
                <div><h3>SIGN-UP: Create your username and password</h3></div>
                <form class="form horizonal" id="form-label" action="signupDB.php" method="POST">
                    <div class="form-group col-sm-9 col-sm-offset-3">
                        <label for="username" class="control-label col-sm-2">Username:</label>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" name="username"><br />
                        </div>
                    </div>
                    <div class="form-group col-sm-9 col-sm-offset-3">
                        <label for="email" class="control-label col-sm-2">Email:</label>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" name="email"><br />
                        </div>
                    </div>
                    <div class="form-group col-sm-9 col-sm-offset-3">
                        <label for="password" class="control-label col-sm-2">Password:</label>
                        <div class="col-sm-4">
                            <input class="form-control" type="password" name="password"><br />
                        </div>
                    </div>
                    <div class="form-group col-sm-offset-3 col-sm-9">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button type="submit" class="btn btn-primary">SIGN-UP</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>                
    </body>
</html>