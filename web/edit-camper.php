<?php
    session_start();
    require("connectdb.php");

    $db = get_db();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Camper Edit</title>
    </head>
    <body> 
        <h1>Edit Registration</h1>
        <hr>
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
        <form action="camper-update.php" method="post">
            <label for="firstname">First Name</label>
            <input type="text" name="firstname" value="<?php echo $firstName ?>"><br>
            <label for="lastname">Last Name</label>
            <input type="text" name="lastname" value="<?php echo $lastName ?>"><br>
            <label for="email">Email</label>
            <input type="text" name="email" value="<?php echo $email ?>"><br>
            <label for="role">Role</label>
            <?php
                $rolesql = 'SELECT rolename FROM role order by role';
                $statement = $db->query($rolesql);
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
            <label for="shirt">Shrit Size</label>
            <input type="text" name="shirt" value="<?php echo $shirtSize ?>"><br>
            <label for="ward">Ward</label>
            <?php
                $wardsql = 'SELECT ward FROM ward order by ward';
                $statement = $db->query($wardsql);
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
            <label for="stake">Stake</label>
            <input type="text" name="stake" value="<?php echo $stake ?>" readonly><br>
            <?php
                if($_POST['action']=="Delete")
                {
                    echo '<input type="submit" value="Update" disabled>';
                }
                else
                {
                    echo '<input type="submit" value="Update">';
                }
            ?>
            <input type="hidden" name="camperid" value="<?php echo $camperid ?>">
            <br>
            <br>
            <input type="button" value="Back to Search" onclick="location.href='camper-search.php';">
            <input type="button" value="Return to Main" onclick="location.href='w6-db.php';">

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
        </form>
    </body>
</html>