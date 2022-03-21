<!-- <?php
  echo '<h1>Yeah, it works!<h1>';
	//phpinfo();
?> -->

<?php
//These are the defined authentication environment in the db service
$request_uri = $_SERVER['REQUEST_URI'];

if($request_uri == "/"){	echo "<script>location.href = './views/index.php'</script> "; }
// // The MySQL service named in the docker-compose.yml.
// $host = 'localhost:40000';

// // Database use name
// $user = 'root';

// //database user password
// $pass = '9080';

// // check the MySQL connection status
// $conn = new mysqli($host, $user, $pass);
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// } else {
//     echo "Connected to MySQL server successfully!";
// }
?>
