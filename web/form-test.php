<?php
    session_start();
    require("connectdb.php");

    $db = get_db();
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
        <h1>Test Form</h1>
        <div class="container">
            <div class="row">
                <form class="form horizontal" id="form-label" action="" method="post">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="fname">First Name</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" name="fname" id="fname">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>