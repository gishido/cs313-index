<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Register Camper</title>
    </head>
    <body> 
    <h1>Register Camper</h1>
    <hr>
    <h3>Camper Registered</h3>
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
            
/*            echo 'roleid is: '.$roleid.'<br>';
            echo 'isMember: '.$isMember.'<br>';
            echo 'firstname: '.$firstName.'<br>';
            echo 'lastname: '.$lastName.'<br>';
            echo 'email: '.$email.'<br>';
            echo 'shirt: '.$shirtSize.'<br>';
            echo 'wardname is: '.$wardname.'<br>';
            echo '<br>';*/
            
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