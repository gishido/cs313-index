<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
    </head>
    <body> 
    <h1>Ward List</h1>
        <?php
            // default Heroku Postgres configuration URL
            $dbUrl = getenv('DATABASE_URL');

            if (empty($dbUrl)) {
            // example localhost configuration URL with postgres username and a database called cs313db
            $dbUrl = "postgres://postgres:gishido@localhost:5432/registration";
            }

            $dbopts = parse_url($dbUrl);


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
            
            // create sql
            $sql = 'SELECT * FROM '.$_SESSION['list'];

            // prepared sql
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            //display to screen
            echo '<strong>Wards:</strong><br>';
            foreach($rows as $row)
            {
                echo '&nbsp&nbsp&nbsp'.$row['ward'];
                echo '<br/>';
            }

        ?>   
    </body>
</html>