<?php
    session_start();
    require("connectdb.php");

    $db = get_db();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Registration Confirmation</title>
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

        <div class="container" id="user-conf">
            <div class="row">
                <h1>Registration Confirmation</h1>
                <hr>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <?php
                //load variables
                $isMember = 1;
                $role = $_POST['rolelist'];
                $firstName = $_POST['fname'];
                $lastName = $_POST['lname'];
                $email = $_POST['email'];
                $shirtSize = $_POST['shirt'];
                $roleid;
                $wardid;
                $year = 2017;
                $ward = $_POST['wardlist'];

                $wardname = "'".$ward."'"; 

                //get roleid
                $stmt = $db->prepare('SELECT roleid FROM role where rolename = :role');
                $stmt->bindParam(':role', $role);
                $stmt->execute();
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach($rows as $row) {
                    $roleid = $row['roleid'];
                }
                //build sql
                //insert into camper
                $sqlCamper = 'INSERT INTO camper (isMember, roleid, firstName, lastName, email, shirtSize) 
                values(?,?,?,?,?,?);';

                $stmt = $db->prepare($sqlCamper);
                $stmt->bindParam(1, $isMember);
                $stmt->bindParam(2, $roleid);
                $stmt->bindParam(3, $firstName);
                $stmt->bindParam(4, $lastName);
                $stmt->bindParam(5, $email);
                $stmt->bindParam(6, $shirtSize);
                $stmt->execute();

                $lastCamper = $db->lastInsertID();
    /*           echo $lastCamper;
                echo '<br>';*/

                //ward sql
                $wardSelect = 'SELECT wardid, ward FROM ward WHERE ward = '.$wardname.' order by ward';
                $statement = $db->query($wardSelect);
                while ($row = $statement->fetch(PDO::FETCH_ASSOC))
                {
                    $wardid = $row['wardid'];
                }

                //insert into camp
                $sqlCamp = 'INSERT INTO camp (year, camperid, wardid) values ('.$year.','.$lastCamper.','.$wardid.')';
    /*            echo $sqlCamp.'<br>';*/
                // prepared sql
                $stmt = $db->prepare($sqlCamp);
                $stmt->execute();

                $lastCamp = $db->lastInsertID();
    /*            echo $lastCamp;
                echo '<br>';*/

                //select camper info post registration
                $campInfo = 'SELECT year, cp.isMember, r.rolename, cp.firstname, cp.lastname
                                , cp.email, cp.shirtsize, w.stake, w.ward
                            from camp c
                            join camper cp
                                on c.camperid = cp.camperid
                            join (select w.wardid, s.stake, w.ward from ward w
                                join stake s on w.stakeid = s.stakeid) as w
                                on c.wardid = w.wardid
                            join role r
                                on cp.roleid = r.roleid
                            where cp.camperid = ?
                            ; ';
                
                $stmt = $db->prepare($campInfo);
                $stmt->bindParam(1, $lastCamper);
                $stmt->execute();
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                /*echo '<table style="text-align:center">';*/
                echo '<table class="table">';
                echo '<tr>';
                echo '<th>Year</th>';
                echo '<th>Member</th>';
                echo '<th>Role</th>';
                echo '<th>First Name</th>';
                echo '<th>Last Name</th>';
                echo '<th>Email</th>';
                echo '<th>Shirt Size</th>';
                echo '<th>Stake</th>';
                echo '<th>Ward</th>';
                echo '</tr>';
                //print to screen
                foreach($rows as $row)
                {
                    echo '<tr>';
                    echo '<td>'.$row['year'].'</td>';
                    echo '<td>'.$row['ismember'].'</td>';
                    echo '<td>'.$row['rolename'].'</td>';
                    echo '<td>'.$row['firstname'].'</td>';
                    echo '<td>'.$row['lastname'].'</td>';
                    echo '<td>'.$row['email'].'</td>';
                    echo '<td>'.$row['shirtsize'].'</td>';
                    echo '<td>'.$row['stake'].'</td>';
                    echo '<td>'.$row['ward'].'</td>';
                    echo '</tr>';
                }

                echo '</table>';

                ?>
            </div>
        </div>
    </body>
</html>