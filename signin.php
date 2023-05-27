<!DOCTYPE html>
<html>
<head>
	<title>Sign In</title>
</head>
<body>
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		<label for="name">Name:</label>
		<input type="text" name="name" id="name_id"><br><br>

		<label for="password">Password:</label>
		<input type="text" name="password" id="password_id"><br><br>

		<input type="submit" name="submit" value="Sign in">
	</form><br/><br/>

    Does not has an account yet? <a href='signup.php'>Sign up here</a><br/><br/>


	<?php
    include "functions.php";

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
            echo "Succeed, you will be redirected to the home page in 3 seconds<br>";
            session_start();
            if ($name == 'White') {
                $_SESSION['privilege'] = 'administrator';
            }
            else {
                $_SESSION['privilege'] = 'stuff';
            }

            // Redirect to the home page
            echo '<script>
            setTimeout(function() {
                window.location.href = "home.php";
            }, 3000);
            </script>';
        } else {
            echo "Failed<br>";
            // Redirect to the sign in page
            echo '<script>
            setTimeout(function() {
                window.location.href = "signin.php";
            }, 3000);
            </script>';
        }
// 
	}
	?>

</body>
</html>