<?php
    session_start();
    require("connectdb.php");

    $db = get_db();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Camper Edit</title>
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
            <div class="row">
                <h1>Edit Registration</h1>
                <hr>
            </div>
        </div>
        <?php

            $camperid;
            if(isset($_SESSION['updated']))
            {
                $camperid = $_SESSION['camperid'];
            }
            else
            {
                $camperid = $_POST['camperid'];
            }
            
            $deleteCamp = "DELETE FROM camp WHERE camperid = ".$camperid;
            $deleteCamper = "DELETE FROM camper WHERE camperid = ".$camperid;
            /*echo '$deleteCamp text is: '.$deleteCamp.'<br>'; 
            echo '$deleteCamper text is: '.$deleteCamper.'<br>';*/ 

            if($_POST['action']=="Delete")
            {
                $stmt1 = $db->prepare($deleteCamp);
                $stmt2 = $db->prepare($deleteCamper);
                $stmt1->execute();
                $stmt2->execute();
            }

            $findSQL = "SELECT * FROM camper 
                            WHERE camperid = ".$camperid;

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

            /*echo '$campInfo text is: '.$campInfo;
            echo "<br>";
            echo '$camperid is: '.$camperid;
            echo "<br>";
            echo "<br>";*/
            
            $stmt = $db->prepare($campInfo);
            $stmt->bindParam(1, $camperid);
            $stmt->execute();
            $rows = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $isMember = $rows['ismember'];
            $role = $rows['rolename'];
            $firstName = $rows['firstname'];
            $lastName = $rows['lastname'];
            $email = $rows['email'];
            $shirtSize = $rows['shirtsize'];
            $year = $rows['year'];
            $ward = $rows['ward'];
            $stake = $rows['stake'];

/*            echo '$isMember = '.$isMember.'<br>';
            echo '$role = '.$role.'<br>';
            echo '$firstName = '.$firstName.'<br>';
            echo '$lastName = '.$lastName.'<br>';
            echo '$email = '.$email.'<br>';
            echo '$shirtSize = '.$shirtSize.'<br>';
            echo '$year = '.$year.'<br>';
            echo '$ward = '.$ward.'<br>';
            echo '$stake = '.$stake.'<br>';*/

        ?>
        <div class="container">
            <div class="row">
                <form class="form horizontal" id="form-label" action="update-camper.php" method="post">
                    <div class="form-group col-sm-9 col-sm-offset-3">
                        <label class="control-label col-sm-2" for="firstname">First Name</label>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" value="<?php echo $firstName ?>" name="firstname" id="fname">
                        </div>
                    </div>
                    <div class="form-group col-sm-9 col-sm-offset-3">
                        <label class="control-label col-sm-2" for="lastname">Last Name</label>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" value="<?php echo $lastName ?>" name="lastname" id="lname">
                        </div>
                    </div>
                    <div class="form-group col-sm-9 col-sm-offset-3">
                        <label class="control-label  col-sm-2" for="email">Email</label>
                        <div class="col-sm-4">
                            <input class="form-control" type="email" value="<?php echo $email ?>" name="email" id="email">
                        </div>
                    </div>
                    <div class="form-group col-sm-9 col-sm-offset-3">
                        <label class="control-label  col-sm-2" for="role">Role</label>
                        <div class="col-sm-4">
                            <?php
                                $rolesql = 'SELECT rolename FROM role order by role';
                                $statement = $db->prepare($rolesql);
                                $statement->execute();
                                $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
                                
                                echo '<select name="role">';
                                foreach($rows as $row)
                                {
                                    if($row['rolename'] == $role)
                                    {
                                        echo "<option value='".$row['rolename']."' selected>".$row['rolename']."</option>";
                                    }
                                    else
                                    {
                                        echo "<option value='".$row['rolename']."'>".$row['rolename']."</option>";
                                    }
                                    
                                }
                                echo '</select><br>';
                            ?>
                        </div>
                    </div> 
                    <div class="form-group col-sm-9 col-sm-offset-3">
                        <label class="control-label  col-sm-2" for="shirt">Shirt Size</label>
                        <div class=" col-sm-4">
                            <input class="form-control" type="text" value="<?php echo $shirtSize ?>"name="shirt" id="shirt">
                        </div>
                    </div>
                    <div class="form-group col-sm-9 col-sm-offset-3">
                        <label class="control-label  col-sm-2" for="ward">Ward</label>
                        <div class="col-sm-4">
                            <?php
                                $rolesql = 'SELECT ward FROM ward order by ward';
                                $statement = $db->prepare($rolesql);
                                $statement->execute();
                                $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
                                
                                echo '<select name="ward">';
                                foreach($rows as $row)
                                {
                                    if($row['ward'] == $ward)
                                    {
                                        echo "<option value='".$row['ward']."' selected>".$row['ward']."</option>";
                                    }
                                    else
                                    {
                                        echo "<option value='".$row['ward']."'>".$row['ward']."</option>";
                                    }
                                }
                                echo '</select><br>';
                            ?>
                        </div>
                    </div> 
                    <div class="form-group col-sm-9 col-sm-offset-3">
                        <label class="control-label col-sm-2" for="stake">Stake</label>
                        <div class="col-sm-4">
                            <input type="text" name="stake" value="<?php echo $stake ?>" readonly>
                        </div>
                    </div>
                    <br>
                    <div class="form-group col-sm-9 col-sm-offset-3">
                        <div class="col-sm-4 col-sm-offset-2">
                            <?php
                                if($_POST['action']=="Delete")
                                {
                                    echo '<input class="btn btn-primary" type="submit" value="Update" disabled>';
                                }
                                else
                                {
                                    echo '<input class="btn btn-primary" type="submit" value="Update">';
                                }
                            ?>
                        </div>
                    </div>
                    <input type="hidden" name="camperid" value="<?php echo $camperid ?>">
                    <br>
                    <br>
                    <hr>
                    <div class="form-group col-sm-12 col-sm-offset-2">
                        <div class="col-sm-4 col-sm-offset-2">
                            <input class="btn btn-info" type="button" value="Back to Search" onclick="location.href='search-camper.php';">
                            <input class="btn btn-default" type="button" value="Return to Main" onclick="location.href='project.php';">
                        </div>
                    </div>
                    <div class="form-group col-sm-9 col-sm-offset-3">     
                    <?php
                        if(isset($_SESSION['updated']))
                        {
                             echo '<br>';
                            echo '<p><strong>Record has been updated</strong></p>';
                            $_SESSION['updated'] = NULL;
                            $_SESSION['camperid'] = NULL;
                        }

                        if($_POST['action']=="Delete")
                        {
                            echo '<br>';
                            echo '<p><strong>Record has been deleted</strong></p>';
                        }
                    ?>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>