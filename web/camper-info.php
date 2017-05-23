<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Camper Info</title>
    </head>
    <body> 
    <h1>Camper Info</h1>
    <hr>
        <?php

            // default Heroku Postgres configuration URL
            $dbUrl = getenv('DATABASE_URL');

            if (empty($dbUrl)) {
            // example localhost configuration URL with postgres username and a database called cs313db
            $dbUrl = "postgres://svcphp:cs313rules!@localhost:5432/registration";
            }

            $dbopts = parse_url($dbUrl);

            /* print "<p>$dbUrl</p>\n\n";*/

            $dbHost = $dbopts["host"];
            $dbPort = $dbopts["port"];
            $dbUser = $dbopts["user"];
            $dbPassword = $dbopts["pass"];
            $dbName = ltrim($dbopts["path"],'/');

            //make connection
            try {
                $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
            }
            catch (PDOException $ex) {
            print "<p>error: $ex->getMessage() </p>\n\n";
            die();
            }

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
            $wardname = $_POST['wardlist'];
           
            //build sql
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
                        ; ';
            
            $stmt = $db->prepare($campInfo);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            echo '<table style="text-align:center">';
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
    </body>
</html>