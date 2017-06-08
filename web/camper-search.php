<?php
    session_start();
    require("connectdb.php");

    $db = get_db();

    function searchAgain() {
        echo '<form action="camper-search.php" method="post">';
        echo '<label for="search">Search Camper</label>';
        echo '<input type="text" name="search">';
        echo '<input type="submit" value="Search Again">';
        echo '<input type="button" value="Return to Main" onclick="location.href='."'w6-db.php'".';">';
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Camper Search</title>
    </head>
    <body> 
        <h1>Campers</h1>
        <hr/>
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
                echo '<table style="text-align:center">';
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
                    echo '<td><form action="camper-edit.php" method="post">';
                    echo '<input type="hidden" name="camperid" value="'.$row['camperid'].'">'; 
                    echo '<input type="submit" name="action" value="Edit">';
                    echo '<input type="submit" name="action" value="Delete">';
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