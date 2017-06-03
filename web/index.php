<!DOCTYPE html>
<html lang="en">
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
        <li><a href="project.php">Project Milestone 1</a></li>
<!--        <li><a href="#">Link</a></li>
        <li><a href="#">Link</a></li>-->
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Assignments <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="shopping.php">Prove03 - Shopping Cart</a></li>
            <li><a href="w5-db.php">Prove05 - Data Access</a></li>
            <li><a href="w6-db.php">Prove06 - Data Modification</a></li>
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
  

    <!-- referencing bootstrap's jumbotron -->
    <div class="jumbotron text-center">
      <div class="container">
        <h1>CS313</h1>
        <p id="jumbo"> A personal landing page for Adam Shumway</p>
      </div>
    </div>
  <!-- interests row -->
  <div class="container" id="intrests">
    <div class="row">
      <p>Intrests</p>
      <hr>
    </div>
  </div>

  <!-- section 1 -->
  <section id="showcase">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-sm-6">
          <div class="section1-left">
            <img src="img/backpacking-guy.jpg">
          </div>
        </div>
        <div class="col-md-6 col-sm-6">
          <div class="section1-right">
            <h1>Backpacking</h1>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- section 2 -->
  <section id="showcase">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-sm-6">
          <div class="section2-left">
            <h1>Video Games</h1>
          </div>
        </div>
        <div class="col-md-6 col-sm-6">
          <div class="section2-right">
            <img src="img/videogames.jpg">
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- section 2 -->
  <section id="showcase">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-sm-6">
          <div class="section3-left">
            <img src="img/lds-family-clipart.png">
          </div>
        </div>
        <div class="col-md-6 col-sm-6">
          <div class="section3-right">
            <h1>Family</h1>
          </div>
        </div>
      </div>
    </div>
  </section>
  

</body>
</html>


