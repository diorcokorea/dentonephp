<?php
    function initDB()
    {
        $hostname = "dioseoul.cea0ixlb7gt0.ap-northeast-2.rds.amazonaws.com";
        $username = "admin";
        $password = "diorco2014";
//        $username = "dentone";
//        $password = "diorco3605";
        $dbname = "aligner_new";
        $conn = mysqli_connect($hostname, $username, $password, $dbname,3307);// or did("Connect failed: %s\n". $conn -> error);
	mysqli_set_charset($conn, 'utf8'); 
        return $conn;
    }
  function getConnection1(){
        $hostname = "dioseoul.cea0ixlb7gt0.ap-northeast-2.rds.amazonaws.com";
        $username = "admin";
        $password = "diorco2014";
//        $username = "dentone";
//        $password = "diorco3605";
        $dbname = "aligner_new";
            $conn = null;
            try{
                //$this->conn = new PDO("mysql:host=$host;dbname=$database_name;charset=$charset;port=$port;username=$username;password=$password");
                $conn = new PDO("mysql:host=" . $this->hostname . ";dbname=" . $this->database_name, $this->username, $this->password);
                $conn->exec("set names utf8");
            }catch(PDOException $exception){
                echo "Database could not be connected: " . $exception->getMessage();
            }
            return $this->conn;
        }
    function CloseCon($conn)
    {
        $conn -> close();
    }
?>
