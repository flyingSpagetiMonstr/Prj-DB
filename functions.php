<?php

// use function PHPSTORM_META\type;
function prompt($str) {
    session_start();
    check();
    echo "<h5><i>Welcome, " . $_SESSION['username'] . "!</i></h5>";
    echo "<i>$str</i><br><br>";
}

function connect($database){
    $servername = "localhost";
    $username = "root"; // boss
    $password = "MySQLpassword";

    $connection = mysqli_connect($servername, $username, $password, $database);
    
    if (!$connection) {
        echo "Connection failed: " ; 
        die("Connection failed: " . mysqli_connect_error());
    } else{
        // echo '<h1>---Connected---</h1><br><br>';
        // echo '<h1>---Connected<sub>/[' . $raw_name . ']</sub>---</h1><br><br>';
        return $connection;
    }
}

function primary_key($tableName, $connection){
    // Query the database schema to retrieve primary key information
    $query = "SHOW KEYS FROM `$tableName` WHERE Key_name = 'PRIMARY'";
    $result = $connection->query($query);
    // Check if the query was successful
    if ($result) {
        // Fetch the primary key column(s)
        $primaryKeyColumns = array();
        while ($row = $result->fetch_assoc()) {
        $primaryKeyColumns[] = $row['Column_name'];
        }
    }
    return $primaryKeyColumns[0];
}

function none_null_col($tableName, $connection){
    $query = "SHOW COLUMNS FROM `$tableName` WHERE `Null` = 'NO';";
    $result = $connection->query($query);
    if ($result) {
        $nonNullColumns = array();
        while ($row = $result->fetch_assoc()) {
        $nonNullColumns[] = $row['Field'];
        }
    }
    return $nonNullColumns;
}


function insert($table, $dict, $connection)
{
    $column_names = "";
    $placeholders = "";
    $types = "";
    $values = array();
    foreach ($dict as $key => $value) {
        $sql = "SELECT data_type FROM information_schema.columns WHERE table_name = ? AND column_name = ?";
        $stmt = mysqli_prepare($connection, $sql);
        try {
            mysqli_stmt_bind_param($stmt, "ss", $table, $key);
            mysqli_stmt_execute($stmt);
        } catch (Exception $e) {
            echo "Execution failed when getting data type: <br>" . $e->getMessage() . "<br><br>";    
        }
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);

        mysqli_stmt_close($stmt);

        if ($row) {
            $column_name = $key;
            $data_type = $row['DATA_TYPE'];
            if ($column_names != "") {
                $column_names .= ", ";
                $placeholders .= ", ";
                $types .= "";
            }
            $column_names .= $column_name;
            $placeholders .= "?";
            $types .= get_format_char($data_type);
                $values[] = $value;
        }
    }

    $sql = "INSERT INTO $table ($column_names) VALUES ($placeholders)";
    $stmt = mysqli_prepare($connection, $sql);

    mysqli_stmt_bind_param($stmt, $types, ...$values);
    try {
        $succeed = mysqli_stmt_execute($stmt);
    } catch (Exception $e) {
        echo "Execution failed: <br>" . $e->getMessage() . "<br><br>";    
    }

    if ($succeed && mysqli_stmt_affected_rows($stmt) > 0) {
        echo "Insert operation succedded.", "<br><br>";
    } 
    // else if ($succeed == 0) {
    //     echo "Insert operation failed", "<br><br>";
    // }
    mysqli_stmt_close($stmt);
}

// safe
function get_type_str($table, $column_name, $connection){
    $sql = "SELECT data_type FROM information_schema.columns WHERE table_name = ? AND column_name = ?";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $table, $column_name);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    $data_type = $row['DATA_TYPE'];
    // echo $row['DATA_TYPE'] . "<br>";
    return get_format_char($data_type);
}

function tables($connection){
    $tables = array();
    $sql = "show tables";
    $result = mysqli_query($connection, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        foreach ($row as $table_name) {
            $tables[] = $table_name;
        }
    }
    return $tables;
}
function columns($table_name, $connection){
    $columns = array();
    $sql = "show columns from $table_name";
    $result = mysqli_query($connection, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $columns[] = $row['Field'];
        // echo $row['Field'], "<br>";
    }
    return $columns;
}

// sign in check
function check(){
    if ($_SESSION['privilege'] == "") {
        echo "Sign in first please.<br><br>";
        echo "<a href='signin.php'>Sign in here</a><br/><br/>";
        exit();
    }
}
function privi_check(){
    if ($_SESSION['privilege'] == "stuff" && $_SESSION['table'] == "Transaction") {
        echo "You are not allowed to see/do this.<br>";
        echo "<a href=".$_SERVER['HTTP_REFERER'].">Return to the previous page</a>";
        exit();
    }
}
function get_format_char($data_type) {
    switch (strtoupper($data_type)) {
        case "VARCHAR":
        case "CHAR":
        case "TEXT":
        case "ENUM":
        case "SET":
            return "s";
        case "TINYINT":
        case "SMALLINT":
        case "MEDIUMINT":
        case "INT":
        case "INTEGER":
            return "i";
        case "BIGINT":
            return "b";
        case "FLOAT":
        case "DOUBLE":
        case "DECIMAL":
            return "d";
        case "DATE":
        case "TIME":
        case "DATETIME":
        case "TIMESTAMP":
            return "s";
        default:
            return "";
    }
}
// function truncate_all($connection){
//     $tables = tables($connection);
//     foreach ($tables as $table_name) {
//         echo $table_name, "<br>";
//         truncate($table_name, $connection);
//         echo "Truncated<br>";
//     }
// }

// function truncate($table_name, $connection){
//     $sql = "TRUNCATE $table_name";
//     echo $sql, "<br>";
//     $result = mysqli_query($connection, $sql);

//     if ($result) {
//         echo "Truncate operation succedded.", "<br><br>";
//     } else {
//         echo "Truncate operation failed", "<br><br>";
//     }
// }
?>
