<?php 
    session_start();
    require("connectdb.php");
    $db = get_db();

    $role = $_POST['role'];
    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $email = $_POST['email'];
    $shirtSize = $_POST['shirt'];
    $ward = $_POST['ward'];
    $camperid = $_POST['camperid'];


    //get roleid
    $selectRole = "SELECT roleid FROM role WHERE rolename = '".$role."'";
    /*echo '$selectRole text: '.$selectRole.'<br>';*/

    $rStmt = $db->prepare($selectRole);
    $rStmt->execute();
    $roleID = $rStmt->fetch(PDO::FETCH_ASSOC)['roleid'];
    /*echo '$roleID is: '.$roleID.'<br>';*/

    //update camper
    $updateCamper = "UPDATE camper
                    SET firstname = '".$firstName
                    ."', lastname = '".$lastName
                    ."', email = '".$email
                    ."', roleid = ".$roleID
                    .", shirtsize = '".$shirtSize
                    ."' WHERE camperid = ".$camperid;
    
    /*echo '$updateCamper text: '.$updateCamper.'<br>';*/

    //update ward
    $selectWard = "SELECT wardid FROM ward WHERE ward = '".$ward."'";
    /*echo '$selectWard is: '.$selectWard.'<br>';*/
    $wStmt = $db->prepare($selectWard);
    $wStmt->execute();

    $wardID = $wStmt->fetch(PDO::FETCH_ASSOC)['wardid'];
    
    /*echo '$wardID is: '.$wardID.'<br>';*/

    $updateWard = "UPDATE camp
                SET wardid = ".$wardID
                ." WHERE camperid = ".$camperid;
    /*echo '$updateWard stmt: '.$updateWard.'<br>';*/

    $stmt = $db->prepare($updateCamper);
    $wUpdate = $db->prepare($updateWard);

    try{
        $stmt->execute();
        $wUpdate->execute();
        $_SESSION['updated'] = true;
        $_SESSION['camperid'] = $camperid;

        header('location:'.'edit-camper.php');
        die();
    }catch (Exception $e){
        echo 'Error on update: '.$e->getMessage().'\n';
    }


?>