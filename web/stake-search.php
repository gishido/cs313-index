<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Stake Search</title>
    </head>
    <body> 
    <h1>Stake Search</h1>
    <hr>
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
     
            //query
            $sql = 'SELECT ward, stake FROM ward 
                    JOIN stake ON ward.stakeid = stake.stakeid 
                    where stake = ?';
/*            echo $sql.'<br>';*/

            $stake = $_POST['stake'];

            // prepared sql
            $stmt = $db->prepare($sql);
            $stmt->bindParam(1, $stake);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            //print to screen
            echo '<strong>Stake: </strong>'.$stake.'<br><br>';
            echo '<strong>Wards:</strong><br>';
            foreach($rows as $row)
            {
                echo '&nbsp&nbsp&nbsp'.$row['ward'];
                echo '<br/>';
            }

        ?>   
    </body>
</html>