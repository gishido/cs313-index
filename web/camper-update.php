<?php 
    session_start();
    require("connectdb.php");
    $db = get_db();
    
    $role = $_POST['rolename'];
    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $email = $_POST['email'];
    $shirtSize = $_POST['shirt'];
    $ward = $_POST['ward'];
    $camperid = $_POST['camperid'];

    $updateCamper = "UPDATE camper
                    SET firstname = '".$firstName
                    ."', lastname = '".$lastName
                    ."', shirtsize = '".$shirtSize
                    ."' WHERE camperid = ".$camperid;
    
    echo '$updateCamper text: '.$updateCamper.'<br>';

    $selectWard = "SELECT wardID WHERE ward = ".$ward;
    $wardID = $db->query($selectWard);

    $updateWard = "UPDATE camp
                SET wardid = ".$wardID
                ." WHERE camperid = ".$camperid;

    $updateStake = "UPDATE Stake";

    $stmt = $db->prepare($updateCamper);

    try{
        $stmt->execute();
        $_SESSION['updated'] = true;
        $_SESSION['camperid'] = $camperid;

        header('location:'.'camper-edit.php');
        die();
    }catch (Exception $e){
        echo 'Error on update: '.$e->getMessage().'\n';
    }


?>