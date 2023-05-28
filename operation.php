<html>
    <head>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
    <div class="container">
        <!-- <h2>Welcome</h2> -->
        <?php
// ====================================================================================
include "functions.php";

session_start();
check();

$operation = $_GET['operation'];
// echo  . "<br><br>";
$privilege = $_SESSION['privilege'];

if ($privilege == 'stuff') {
    echo 'You are not allowed to do this.<br><br>';
    $operation = "";
}

if ($operation == "backup" || $operation == "recover") {
    $dump_file = "dumpfile.sql";
    $mysql_host = "localhost";
    $mysql_user = "root";
    $mysql_pass = "MySQLpassword";
    $mysql_db = "mydb";

    if($operation == "backup"){
        $command = "mysqldump -h {$mysql_host} -u {$mysql_user} -p{$mysql_pass} {$mysql_db} > {$dump_file}";
    }
    else{
        $connection = mysqli_connect($mysql_host, $mysql_user, $mysql_pass);
        echo "Conencted to MySQL.<br>";
        mysqli_query($connection, "DROP DATABASE mydb");
        mysqli_query($connection, "CREATE DATABASE mydb");
        echo "que.<br>";
        $command = "mysql -h {$mysql_host} -u {$mysql_user} -p{$mysql_pass} mydb < {$dump_file}";
        echo $command;
        mysqli_close($connection);
    }

    try {
        $ret = exec($command);
        echo("Success.");
    } catch (Exception $e) {
        echo "Failed. <br>" . $e->getMessage();
    }
    echo "<br/><br/>";
    $operation = "";
}

$connection = connect('mydb');
$table = $_SESSION['table']; // not a must
if ($operation == 'delete') {
    $primaryKeyValue = $_GET['primary_key'];

    $primaryKeyName = primary_key($table, $connection); 
    $query = "DELETE FROM $table WHERE $primaryKeyName = ?";

    $stmt = mysqli_prepare($connection, $query);
    $type_str = get_type_str($table, $primaryKeyName, $connection);

    mysqli_stmt_bind_param($stmt, $type_str, $primaryKeyValue);

    try {
        $succeed = mysqli_stmt_execute($stmt);
    } catch (Exception $e) {
        echo "Execution failed: <br>" . $e->getMessage() . "<br><br>";    
    }
    
    if ($succeed && mysqli_stmt_affected_rows($stmt) > 0) {
        echo "Row deleted successfully.";
    } else {
        echo "Error deleting row. " . mysqli_error($connection);
    }
    echo '<br><br>';
    mysqli_stmt_close($stmt);
}
else if ($operation == 'insert') {
    insert($table, $_POST, $connection);
}
// BUG when altering transaction description
else if ($operation == 'alter') {
    $primaryKeyName = primary_key($table, $connection); 
    $primaryKeyValue = $_GET['primary_key'];
    $column_name = $_GET['column_name']; // check
    if (!in_array($column_name, columns($table, $connection))) {
        $column_name = "";
    }
    $value = $_POST['value'];
    $query = "UPDATE $table SET $column_name = ? WHERE $primaryKeyName = ?";
    // echo $query."<br>";

    $stmt = mysqli_prepare($connection, $query);
    $type_str1 = get_type_str($table, $column_name, $connection);
    $type_str2 = get_type_str($table, $primaryKeyName, $connection);

    // echo $type_str1 .$type_str2 . "<br>";
    // echo $value .$primaryKeyValue . "<br>";
    mysqli_stmt_bind_param($stmt, $type_str1.$type_str2, $value, $primaryKeyValue);

    try {
        $succeed = mysqli_stmt_execute($stmt);
    } catch (Exception $e) {
        echo "Execution failed: <br>" . $e->getMessage() . "<br><br>";    
    }

    if ($succeed && mysqli_stmt_affected_rows($stmt) > 0) {
        echo "Altered successfully.";
    } else {
        echo "Error altering: " . mysqli_error($connection);
    }
    echo '<br><br>';
    mysqli_stmt_close($stmt);
}
mysqli_close($connection);
// ====================================================================================
        ?>
        <a href="<?php echo $_SERVER['HTTP_REFERER'];?>">Return to the previous page</a>
    </div>
    </body>
</html>


<!-- INSERT INTO Transaction(transactionNo, productNo, purchaseOrderNo) values(3,2,1) -->

<!-- // =========
// ALTER or DELETE or INSERT

// if insert [click on +] [additional data needed]
// $data = all none null;
// if alter [click on elem] [additional data needed]
// $data = mew data
// if delete [click on -]
// $data = no data

// ==========================================
// make the $sql string: 

// if insert:
// INSERT INTO $table (None Null, None Null, None Null)
// VALUES ('value1', 'value2', 'value3'); -->
