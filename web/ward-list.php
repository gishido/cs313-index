<?php
    session_start();
    require('connectdb.php');

    $db = get_db();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Ward List</title>
    </head>
    <body> 
    <h1>Ward List</h1>
    <hr>
        <?php
                      
            // create sql
            $sql = 'SELECT * FROM ward';

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