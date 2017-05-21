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
            //what kind of list do we want (i.e. select * from [list])
            $_SESSION['list'] = 'ward';

            
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
        ?>
        
        <!-- Display list -->
        <hr>
        <h3>1. Ward List: A list of all the wards that are participating in Camp Helaman.</h3>
        <a href="ward-list.php">Show list of wards</a>  

        <!-- Simple Search -->
        <hr>
        <h3>2. Stake Search: A simple form that allows a search for a stake. If found, a list of all the wards in a stake will be displayed.</h3>
        
        <form action="stake-search.php" method="post">
            <input type="radio" name="stake" value="Auburn" checked>Auburn<br>
            <input type="radio" name="stake" value="Enumclaw">Enumclaw<br>
            <input type="radio" name="stake" value="Federal Way">Federal Way<br>
            <input type="radio" name="stake" value="Kent">Kent<br>
            <input type="radio" name="stake" value="Mapel Valley">Mapel Valley<br>
            <input type="radio" name="stake" value="Puyallup">Puyallup<br>
            <input type="radio" name="stake" value="Puyallup South">Puyallup South<br>
            <br>
            <input type="submit" value="Search">
        </form>
        
        <hr>
        <h3>3. Display existing registrants: A simple page that shows all the current registrants for camp.</h3>
        <a href="camper-info.php">Camp registration list</a>

        <!-- create a form for data entry -->
        <hr>
        <h3>4. Register Camper:</h3>
        <form action="register-camper.php" method="post">
            First Name:<br>
            <input type="text" name="fname" value="First Name">
            Last Name:
            <input type="text" name="lname" value="Last Name"><br>
            Role at camp:
                <?php
                    $rolesql = 'SELECT rolename FROM role order by role';
                    $statement = $db->query($rolesql);
                    echo '<select name="rolelist">';
                    while ($row = $statement->fetch(PDO::FETCH_ASSOC))
                    {
                        echo "<option value='".$row['rolename']."'>".$row['rolename']."</option>";
                    }
                    echo '</select>';
                ?>
<!--            <select name="rolelist">
                <option value='Leader'>Leader</option>
                <option value='OZone'>OZone</option>
                <option value='Zone Leader'>Zone Leader</option>
                <option value='District Lader'>District Lader</option>
                <option value='Camper'>Camper</option>
            </select>-->
            <br>
            Shirt Size:
            <input type="text" name="shirt" value="Shirt Size">
            <br>
            Ward:
            <?php
                $wardsql = 'SELECT ward FROM ward order by ward';
                $statement = $db->query($wardsql);
                echo '<select name="wardlist">';
                while ($row = $statement->fetch(PDO::FETCH_ASSOC))
                {
                    echo "<option value='".$row['ward']."'>".$row['ward']."</option>";
                }
                echo '</select>';
            ?>
            Stake:
            <?php
                $stakesql = 'SELECT stake FROM stake order by stake';
                $statement = $db->query($stakesql);
                echo '<select name="stakelist">';
                while ($row = $statement->fetch(PDO::FETCH_ASSOC))
                {
                    echo "<option value='".$row['stake']."'>".$row['stake']."</option>";
                }
                echo '</select>';
            ?>
            <!--<select name='stakelist'>
                <option value='Auburn'>Auburn</option>
                <option value='Enumclaw'>Enumclaw</option>
                <option value='Federal Way'>Federal Way</option>
                <option value='Kent'>Kent</option>
                <option value='Mapel Valley'>Mapel Valley</option>
                <option value='Puyallup'>Puyallup</option>
                <option value='Puyallup South'>Puyallup South</option>
            </select>-->
            <br>
            Email:<br>
            <input type="email" name="email" value="Email"><br>
            <br>
            <input type="submit" value="Register">
        </form>
    </body>
</html>