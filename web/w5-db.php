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
            <select name="rolelist">
                <option value='Leader'>Leader</option>
                <option value='OZone'>OZone</option>
                <option value='Zone Leader'>Zone Leader</option>
                <option value='District Lader'>District Lader</option>
                <option value='Camper'>Camper</option>
            </select>
            <br>
            Shirt Size:
            <input type="text" name="shirt" value="Shirt Size">
            <br>
            Ward:<br>
            <select name="wardlist">
                <option value='Auburn'>Auburn</option>
                <option value='Game Farm'>Game Farm</option>
                <option value='Green River'>Green River</option>
                <option value='Lake Holm'>Lake Holm</option>
                <option value='Mill Pond'>Mill Pond</option>
                <option value='White River'>White River</option>
                <option value='Buckley 1'>Buckley 1</option>
                <option value='Buckley 2'>Buckley 2</option>
                <option value='Enumclaw 1'>Enumclaw 1</option>
                <option value='Enumclaw 2'>Enumclaw 2</option>
                <option value='Enumclaw 3'>Enumclaw 3</option>
                <option value='Mt. Peak'>Mt. Peak</option>
                <option value='Orting'>Orting</option>
                <option value='Victor Falls'>Victor Falls</option>
                <option value='Dash Point'>Dash Point</option>
                <option value='Dolloff Lake'>Dolloff Lake</option>
                <option value='Federal Way'>Federal Way</option>
                <option value='Hylebos'>Hylebos</option>
                <option value='Jovita Creek'>Jovita Creek</option>
                <option value='Lakota Creek'>Lakota Creek</option>
                <option value='Redondo'>Redondo</option>
                <option value='Silver Lake'>Silver Lake</option>
                <option value='Star Lake'>Star Lake</option>
                <option value='Clark Lake'>Clark Lake</option>
                <option value='Crestwood'>Crestwood</option>
                <option value='Lake Meridian'>Lake Meridian</option>
                <option value='Lake Sawyer'>Lake Sawyer</option>
                <option value='Park Orchard'>Park Orchard</option>
                <option value='Scenic Hill'>Scenic Hill</option>
                <option value='Rock Creek'>Rock Creek</option>
                <option value='Glacier Park'>Glacier Park</option>
                <option value='Elk Run'>Elk Run</option>
                <option value='Cedar River'>Cedar River</option>
                <option value='Lake Wilderness'>Lake Wilderness</option>
                <option value='Lake Lucerne'>Lake Lucerne</option>
                <option value='Bonney Lake'>Bonney Lake</option>
                <option value='Clarks Creek'>Clarks Creek</option>
                <option value='Lake Tapps'>Lake Tapps</option>
                <option value='North Tapps'>North Tapps</option>
                <option value='Puyallup'>Puyallup</option>
                <option value='Sumner'>Sumner</option>
                <option value='Surprise Lake'>Surprise Lake</option>
                <option value='Manorwood'>Manorwood</option>
                <option value='Ridgecrest'>Ridgecrest</option>
                <option value='South Hill'>South Hill</option>
                <option value='Gem Heights'>Gem Heights</option>
                <option value='Silver Creek'>Silver Creek</option>
                <option value='Pioneer Valley'>Pioneer Valley</option>
            </select>
            Stake:
            <select name='stakelist'>
                <option value='Auburn'>Auburn</option>
                <option value='Enumclaw'>Enumclaw</option>
                <option value='Federal Way'>Federal Way</option>
                <option value='Kent'>Kent</option>
                <option value='Mapel Valley'>Mapel Valley</option>
                <option value='Puyallup'>Puyallup</option>
                <option value='Puyallup South'>Puyallup South</option>
            </select>
            <br>
            Email:<br>
            <input type="email" name="email" value="Email"><br>
            <br>
            <input type="submit" value="Register">
        </form>
    </body>
</html>