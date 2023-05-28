<?php
    session_start();
    $_SESSION['privilege'] = '';
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		$name = $_POST["name"];
		$hashedpassword = hash('sha256', $_POST["password"]);
    
        // $servername = "localhost";
        // $MySQL_username = "root";
        // $MySQL_password = "MySQLpassword"; // password of root to MySQL
        $database = "users";

        // $connection = mysqli_connect($servername, $MySQL_username, $MySQL_password, $database);
        $connection = connect($database);

// 
        $query = "SELECT * FROM info where username = ? and password = ?";
        $statement = mysqli_prepare($connection, $query);
        if(!$statement) {
            die('Query preparation failed: ' . mysqli_error($connection));
        }
        mysqli_stmt_bind_param($statement, 'ss', $name, $hashedpassword);
        $succeed = mysqli_stmt_execute($statement);
        $result = mysqli_stmt_get_result($statement);

        if(mysqli_num_rows($result) == 1) {
            if ($name == 'White') {
                $_SESSION['privilege'] = 'administrator';
            }
            else {
                $_SESSION['privilege'] = 'stuff';
            }
            $_SESSION['username'] = $name;
            echo '<script>
            setTimeout(function() {
                window.location.href = "home.php";
            }, 0);
            </script>';
        } else {
            echo "Failed<br>";
        }
	}
?>