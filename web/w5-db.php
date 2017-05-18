<!DOCTYPE html>
<html>
    <head>
    </head>
    <body> 
        <?php

            // default Heroku Postgres configuration URL
            $dbUrl = getenv('DATABASE_URL');

            if (empty($dbUrl)) {
            // example localhost configuration URL with postgres username and a database called cs313db
            $dbUrl = "postgres://postgres:gishido@localhost:5432/scriptures";
            }

            $dbopts = parse_url($dbUrl);

            /* print "<p>$dbUrl</p>\n\n";*/

            $dbHost = $dbopts["host"];
            $dbPort = $dbopts["port"];
            $dbUser = $dbopts["user"];
            $dbPassword = $dbopts["pass"];
            $dbName = ltrim($dbopts["path"],'/');

            //print "<p>pgsql:host=$dbHost;port=$dbPort;dbname=$dbName</p>\n\n";

            try {
                $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
            }
            catch (PDOException $ex) {
            print "<p>error: $ex->getMessage() </p>\n\n";
            die();
            }

            // prepared sql
            $stmt = $db->prepare('SELECT * FROM scriptures');
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            /*    while ($rows = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                echo $rows['book']." ".$rows['chapter'].":".$rows['verse']." - ";
                echo '"' . $rows['content'] . '"';
                echo '<br/>';
                echo '<br/>';
            }*/
            foreach($rows as $row)
            {
                echo "<strong>".$row['book']." ".$row['chapter'].":".$row['verse']."</strong> - ";
                echo '"' . $row['content'] . '"';
                echo '<br/>';
                echo '<br/>';
            }

        ?>   
    </body>
</html>