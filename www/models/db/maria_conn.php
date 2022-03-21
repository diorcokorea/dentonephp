<?php
    function initDB()
    {
        $hostname = "mariadb";
        $username = "root";
        $password = "9080";
//        $username = "dentone";
//        $password = "diorco3605";
        $dbname = "aligner";
        $conn = mysqli_connect($hostname, $username, $password, $dbname) or did("Connect failed: %s\n". $conn -> error);
	mysqli_set_charset($conn, 'utf8'); 
        return $conn;
    }

    function CloseCon($conn)
    {
        $conn -> close();
    }
?>
