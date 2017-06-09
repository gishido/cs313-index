<?php
    require("connectdb.php");
    $db = get_db();


    $username = $_POST[username];
    $email = $_POST[email];
    $passwordHash = password_hash($_POST[password], PASSWORD_DEFAULT);

    if (!isset($email))
    {
        foreach ($db->query("SELECT * FROM login WHERE username = '$username'") as $row)
        {
            if (password_verify($_POST[password], $row['password']))
            {
                session_start();
                $_SESSION['username'] = $row['username'];
                $_SESSION['start'] = time(); // Taking now logged in time.
                // Ending a session in 5 minutes from the starting time.
                $_SESSION['expire'] = $_SESSION['start'] + (5 * 60);
                header('Location: ' . "project.php");
                die();
            }
            else
            {
                header('Location: ' . "signin.php");
                die();
            }
        }
    }

    foreach ($db->query("SELECT * FROM login WHERE username = '$username'") as $row);

    if ($row)
    {
        header('Location: ' . "signupError.php");
        die();
    }
    else
    {
        //echo $username;
        $loginQuery = 'INSERT INTO login (username, email, password) VALUES (?,?,?)';

        $stmt = $db->prepare($loginQuery);
        $stmt->bindParam(1, $username);
        $stmt->bindParam(2, $email);
        $stmt->bindParam(3, $passwordHash);
        $stmt->execute();
        print_r($stmt->errorInfo());
        $loginid = $db->lastInsertId();

        header('Location: ' . "signin.php");
        //die();

    }


?>
