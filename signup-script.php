<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $hashedpassword = hash('sha256', $_POST["password"]);

    $servername = "localhost";
    $MySQL_username = "root";
    $MySQL_password = "MySQLpassword"; // password of root to MySQL
    $database = "users";

    $connection = mysqli_connect($servername, $MySQL_username, $MySQL_password, $database);

    $query = "INSERT INTO info (username, password) VALUES (?, ?)";
    // $query = "SELECT * FROM Employee where employeeName = ?";
    $statement = mysqli_prepare($connection, $query);
    if(!$statement) {
        die('Query preparation failed: ' . mysqli_error($connection));
    }
    
    mysqli_stmt_bind_param($statement, 'ss', $name, $hashedpassword);

    try {
        $succeed = mysqli_stmt_execute($statement);
    } catch (Exception $e) {
        echo "Sign Up Failed: <br>" . $e->getMessage() . "<br><br>";    
        // $succeed = 1; // in fact, failed
    }

    // $result = mysqli_stmt_get_result($statement);

    // echo $succeed;
    // echo mysqli_stmt_affected_rows($statement);

    if ($succeed && (mysqli_stmt_affected_rows($statement) > 0)) {
        echo "Succeed, you can go to the sign in page now<br>";
        echo "<a href='signin.php'>Sign in here</a><br/><br/>";
    }
    mysqli_stmt_close($statement);
    mysqli_close($connection);
}
?>
