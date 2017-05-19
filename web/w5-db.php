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

    </body>
</html>