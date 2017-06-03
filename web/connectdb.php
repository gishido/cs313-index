<?php

    function get_db () {
        $db = null;

        $dbUrl = getenv('DATABASE_URL');

        if (empty($dbUrl)) {
            // localhost configuration URL with postgres username and a database
            $dbUrl = "postgres://svcphp:cs313rules!@localhost:5432/registration";
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

        return $db;
    }

?>