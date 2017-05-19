<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
    </head>
    <body> 
    <h1>Project Title: Camp Registration</h1>
        <?php

            // default Heroku Postgres configuration URL
            $dbUrl = getenv('DATABASE_URL');

            if (empty($dbUrl)) {
            // example localhost configuration URL with postgres username and a database called cs313db
            $dbUrl = "postgres://postgres:gishido@localhost:5432/registration";
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

            //get roleid
            $stmt = $db->prepare('SELECT roleid FROM role where rolename = :role');
            $stmt->bindParam(':role', $role);
            $stmt->execute();
            $roleid = $stmt->fetchAll(PDO::FETCH_ASSOC);

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

            $lastInsert = $db->lastInsertID(camperid);
            echo $lastInsert;
            echo '<br>';

            //insert into camp
            $sqlCamp = 'INSERT INTO camp (year, camperid, wardid) values (?,?,?);';

            // prepared sql
/*            $stmt = $db->prepare($sqlCamper);
            $stmt->bindParam(1, $stake);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);*/

        ?>
    </body>
</html>