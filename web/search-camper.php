<?php
    session_start();
    require("connectdb.php");

    $db = get_db();

    function searchAgain() {
        echo '<form class="form horizontal" id="form-label" action="search-camper.php" method="post">';
        echo '<div class="form-group col-sm-9">';
        echo '<label class="control-label col-sm-2" for="search">Search Camper</label>';
        echo '<div class="col-sm-4">';
        echo '<input class="form-control" type="text" name="search">';
        echo '</div>';
        echo '<input class="btn btn-primary" type="submit" value="Search Again">';
        echo '<input class="btn btn-default" type="button" value="Return to Main" onclick="location.href='."'project.php'".';">';
        echo '</div>';
    }

/*    <form class="form horizonal" action="camper-search.php" method="post">
                    <div class="form-group row">
                        <div class="form-group col-sm-12 col-sm-offset-2">
                            <label class="control-label col-sm-2" for="search">Search Camper</label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" name="search">
                            </div>
                            <div class="col-sm-2">
                                <input class="btn btn-primary" type="submit" value="Search">
                            </div>
                        </div>
                    </div>
                </form>*/
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Camper Search</title>
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
        <div class="container" id="project"> 
            <h1>Campers</h1>
            <hr/>
        </div>
        <?php
            $myUser = htmlspecialchars($_POST['search']);
            /*echo "$myUser text is: ".$myUser;
            echo "<br>";*/

            /*$findSQL = "select * from camper where (firstname like '%Adam%') or (lastname like '%Adam%')";*/
            /*$findSQL = "SELECT * FROM camper 
                        WHERE (firstname like '%".$myUser."%') 
                            or (lastname like '%".$myUser."%')";*/

            $findSQL = "SELECT year, cp.camperid, cp.isMember, r.rolename, cp.firstname, cp.lastname
                        ,cp.email, cp.shirtsize, w.stake, w.ward
                    from camp c
                    join camper cp
                        on c.camperid = cp.camperid
                    join (select w.wardid, s.stake, w.ward from ward w
                        join stake s on w.stakeid = s.stakeid) as w
                        on c.wardid = w.wardid
                    join role r
                        on cp.roleid = r.roleid
                    WHERE (firstname like '%".$myUser."%') 
                            or (lastname like '%".$myUser."%')
                    ORDER BY cp.camperid";

/*            echo "$findSQL text is: ".$findSQL;
            echo "<br>";*/

            $find = $db->prepare($findSQL);
            $find->execute();
            $rows = $find->fetchAll(PDO::FETCH_ASSOC);
            if(empty($rows))
            {
                echo '<h3>No records found</h3><br>';
                searchAgain();
            }
            else
            {
                echo '<table class="table">';
                echo '<tr>';
                echo '<th>Edit</th>';
                echo '<th>camperid</th>';
                echo '<th>Year</th>';
                echo '<th>Member</th>';
                echo '<th>Role</th>';
                echo '<th>First Name</th>';
                echo '<th>Last Name</th>';
                echo '<th>Email</th>';
                echo '<th>Shirt Size</th>';
    /*            echo '<th>Stake</th>';
                echo '<th>Ward</th>';*/
                echo '</tr>';
                //print to screen
                foreach($rows as $row)
                {

                    echo '<tr>';
                    echo '<td><form class="form" action="edit-camper.php" method="post">';
                    echo '<input type="hidden" name="camperid" value="'.$row['camperid'].'">'; 
                    echo '<input class="btn btn-primary" type="submit" name="action" value="Edit">';
                    echo '<input class="btn btn-warning" type="submit" name="action" value="Delete">';
                    echo '</form></td>';
                    echo '<td>'.$row['camperid'].'</td>';
                    echo '<td>'.$row['year'].'</td>';
                    echo '<td>'.$row['ismember'].'</td>';
                    echo '<td>'.$row['rolename'].'</td>';
                    echo '<td>'.$row['firstname'].'</td>';
                    echo '<td>'.$row['lastname'].'</td>';
                    echo '<td>'.$row['email'].'</td>';
                    echo '<td>'.$row['shirtsize'].'</td>';
    /*                echo '<td>'.$row['stake'].'</td>';
                    echo '<td>'.$row['ward'].'</td>';*/
                    echo '</tr>';
                }

                echo '</table>';
                echo '<br>';

                searchAgain();
            }
                 
        ?>
    </body>
</html>