<?php
    session_start();
    require("connectdb.php");

    $db = get_db();
?>
<!DOCTYPE html>
<html>
    <head>
    </head>
    <body> 
        <h1>Project Title: Camp Registration</h1>
        <!-- Display list -->
        <hr>
        <h3>1. Register Camper:</h3>
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
            <br>
            Email:<br>
            <input type="email" name="email" value="Email"><br>
            <br>
            <input type="submit" value="Register">
        </form>

        <h3>2. Ward List: A list of all the wards that are participating in Camp Helaman.</h3>
        <a href="ward-list.php">Show list of wards</a>  

        <!-- Simple Search -->
        <hr>
        <h3>3. Stake Search: A simple form that allows a search for a stake. If found, a list of all the wards in a stake will be displayed.</h3>
        
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
        <h3>4. Display existing registrants: A simple page that shows all the current registrants for camp.</h3>
        <a href="camper-info.php">Camp registration list</a>

        <hr>

        <h3>5. Find/Edit/Delete a person: Search for registered campers, edit or delete them</h3>
        <p>Through this search, you'll be able to return names of people that have similar first or last names to the search.  If there are no results, a message will display.  From the search screen, you'll be able to perform multiple searches or return to "main".  You can edit or delete a record.  If you delete a record, it will disable the "update" button.  If you edite a field, it will update that relevant record on the backend database and display a message.  From the edit menu, you'll be able to search again or return to main'  From main, you can register a new camper, if there is desire.</p>
        <form action="camper-search.php" method="post">
            <label for="search">Search Camper</label>
            <input type="text" name="search">
            <input type="submit" value="Search">
        </form>
    </body>
</html>