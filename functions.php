<?php

function connect($raw_name, $password){
    $servername = "localhost";
    if ($raw_name == "Boss") {
        $username = "root"; // boss
    } else {
        $username = $raw_name; // other
    }
    $database = "mydb";
    
    $connection = mysqli_connect($servername, $username, $password, $database);

    
    if (!$connection) {
        echo "Connection failed: " ; 
        die("Connection failed: " . mysqli_connect_error());
    } else{
        echo '<h1>---Connected---</h1><br><br>';
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

function delete_row($primaryKeyName, $primaryKeyValue, $connection){
    $tableName = "your_table";
    $primaryKeyValue = $_POST['primary_key_value']; // Replace with the actual value

    $query = "DELETE FROM $tableName WHERE $primaryKeyName = '$primaryKeyValue'";

    // Execute the query
    if (mysqli_query($connection, $query)) {
        echo "Row deleted successfully.";
    } else {
        echo "Error deleting row: " . mysqli_error($connection);
    }

}
// function insert($tableName, $connection){
?>
