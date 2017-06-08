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
            $camperid = $_POST['camperid'];

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

            echo "$campInfo text is: ".$campInfo;
            echo "<br>";
            echo "$camperid is: ".$camperid;
            echo "<br>";
            echo "<br>";

            /*$find = $db->prepare($findSQL);
            $find->execute();
            $rows = $find->fetchAll(PDO::FETCH_ASSOC);
            {
                echo '<table style="text-align:center">';
                echo '<tr>';
                echo '<th>Edit</th>';
                echo '<th>Year</th>';
                echo '<th>Member</th>';
                echo '<th>Role</th>';
                echo '<th>First Name</th>';
                echo '<th>Last Name</th>';
                echo '<th>Email</th>';
                echo '<th>Shirt Size</th>';
    /*            echo '<th>Stake</th>';
                echo '<th>Ward</th>';
                echo '</tr>';
                //print to screen
                foreach($rows as $row)
                {

                    echo '<tr>';
                    echo '<td><form action="camper-edit.php" method="post"><input type="submit" value="Edit"></form>';
                    echo '<input type="hidden" name="camperid" value="'.$row['camperid'].'"></td>';
                    echo '<td>'.$row['year'].'</td>';
                    echo '<td>'.$row['ismember'].'</td>';
                    echo '<td>'.$row['roleid'].'</td>';
                    echo '<td>'.$row['firstname'].'</td>';
                    echo '<td>'.$row['lastname'].'</td>';
                    echo '<td>'.$row['email'].'</td>';
                    echo '<td>'.$row['shirtsize'].'</td>';
    /*                echo '<td>'.$row['stake'].'</td>';
                    echo '<td>'.$row['ward'].'</td>';*/
                    /*echo '</tr>';

                }

                echo '</table>';
                echo '<br>';

            }*/

            
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
            <label for="role">Role</label>
            <input type="text" name="role" value="<?php echo $role ?>"><br>
            <label for="ward">Ward</label>
            <input type="text" name="ward" value="<?php echo $ward ?>"><br>
            <label for="stake">Stake</label>
            <input type="text" name="stake" value="<?php echo $stake ?>"><br>
            <input type="submit" value="Update">

            <?php
                if(isset($_SESSION['updated']))
                {
                    echo '<br>';
                    echo '<p><span font-wight:"bold">Record has been updated</span></p>';
                    $_SESSION['updated'] = NULL;
                }
            ?>
        </form>
    </body>
</html>