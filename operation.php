<html>
    <head>
        <link rel="stylesheet" href="styles.css">
        <script>
            window.onload = 
            setTimeout(function () {
                window.location.href = "table.php?table=<?php session_start(); echo $_SESSION['table'];?>";
            }, 3000);
        </script>
    </head>
    <body>
    <div class="container">
        <h2>Welcome</h2>
        <?php
// ====================================================================================
include "functions.php";

// session_start();
$table = $_SESSION['table'];

$connection = connect($_SESSION['raw_name'], $_SESSION['password']);

$primaryKeyValue = $_GET['primary_key'];
$primaryKeyName = primary_key($table, $connection); 
// =========

$query = "DELETE FROM $table WHERE $primaryKeyName = '$primaryKeyValue'";

if (mysqli_query($connection, $query)) {
    echo "Row deleted successfully.";
} else {
    echo "Error deleting row: " . mysqli_error($connection);
}
echo '<br><br>';
// =========
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
// VALUES ('value1', 'value2', 'value3');




mysqli_close($connection);
// ====================================================================================
        ?>
        You will be redirected to the previous page in 3 seconds.
    </div>
    </body>
</html>



<!-- INSERT INTO Transaction(transactionNo, productNo, purchaseOrderNo) values(3,2,1) -->