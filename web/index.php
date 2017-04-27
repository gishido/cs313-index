<!DOCTYPE html>
<html>
<head>
  <title>CS313 - Adam Shumway</title>
  <!-- http://getbootstrap.com/getting-started/ - Latest compiled and minified CSS -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <!-- http://getbootstrap.com/getting-started/ - Latest compiled and minified JavaScript -->
  <script src="js/bootstrap.min.js"></script>
  <!-- jquery js file...needed for some boostrap functions -->
  <script src="js/jquery-3.2.1.min.js"></script> 
</head>
<body>
<h1>
  <?php
    echo "<center>";
    echo 'Running from Index App';
    echo "</center>";
  ?>
</h1>
<div class="container" id=button1>
  <button type="button" class="btn btn-primary hover-bold" onclick="clickMe();">Click Me!</button>
</div>
<div class="container" id=button2>
  <button type="button" class="btn btn-danger hover-bold" onclick="clickMe();">Click Me!</button>
</div>
<div class="container" id=button3>
  <button type="button" class="btn btn-warning hover-bold" onclick="clickMe();">Click Me!</button>
</div>
</body>
</html>


