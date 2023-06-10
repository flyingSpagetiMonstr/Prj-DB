<?php
// ====================================================================================

$connection = connect('mydb');

session_start();

check();

$table = $_GET['table'];

if (!in_array($table, tables($connection))) {
    $table = "";
}

$_SESSION['table'] = $table;

privi_check();

$condition = $_POST['condition']; // #################################################
if ($condition) {
    echo $condition;

    // ##############################################################################
    $columns = columns($table ,$connection);
    foreach ($columns as $column) {
        if (strncmp($condition, $column, strlen($column)) === 0) {
            // echo "A starts with " . $column . "\n";
            $condition_col = $column; 
            break;
        }
    }
}
echo "<br/><br/>";


try {
    $col_result = mysqli_query($connection, "SHOW COLUMNS FROM $table");
} catch (Exception $e) {
    echo "Query failed: <br>" . $e->getMessage() . "<br><br>";
    $fail = 1;
}
try {
    if ($condition) {
    // if ($condition && $condition_col) {
        // echo "SELECT * FROM $table WHERE $condition";
        $result = mysqli_query($connection, "SELECT * FROM $table WHERE $condition");
    } else {
        $result = mysqli_query($connection, "SELECT * FROM $table");
    }
} catch (Exception $e) {
    if ($fail!=1) {
        echo "Query failed: <br>" . $e->getMessage() . "<br><br>";
    }
    echo "Probably, invalid table name." . "<br><br>";
}
// while() {
//     echo . "<br>";
// }

// SELECT * FROM Employee where employeeName = 'Xiao Wang' 
// SELECT * FROM Employee where employeeName = '' or '1' = '1' 
// SELECT * FROM Employee; SELECT * FROM Supplier;


// if (mysqli_num_rows($result) >= 0) {
    $PRIMARY_KEY = primary_key($table, $connection);
// $password = $_GET['password'];

    // echo '<form id="form" action="operation.php?operation=insert">';
    echo '<table id="table">';

    // head of table
    echo '<tr>';
    $i = 0;
    $PRIMARY_KEY_INDEX = -1; // starts from 0
    while ($col_info = $col_result->fetch_assoc()) {
        if ($col_info["Field"] != $PRIMARY_KEY) {
            $i++;
        }
        else {
            $PRIMARY_KEY_INDEX = $i;
        } 
        echo '<th>' . $col_info["Field"] . '</th>';
    }
    echo '<th>'.'Delete'.'</th>';
    echo '</tr>';

    // body of table
    while ($row = mysqli_fetch_assoc($result)) {
        // get PRIMARY_KEY_VALUE
        $i = 0;
        foreach ($row as $column_name => $value) {
            if ($i == $PRIMARY_KEY_INDEX) {
                $PRIMARY_KEY_VALUE = $value;
            }
            $i++;
        }
        echo '<tr>';
        foreach ($row as $column_name => $value) {
            // echo '<td>'. $value . '</td>';
            // <td onclick = "alter(this, '$table_name', '$PRIMARY_KEY_VALUE', '$column_name');">  $value </td>;
            echo '<td onclick = "alter(this,'."'$PRIMARY_KEY_VALUE', '$column_name'".');">'.$value.'</td>';
            // echo '<td>'. $value . '</td>';
        }


        // echo '<td >'.'<button/>'.'</td>';
        // echo '<td id="'.$PRIMARY_KEY_VALUE.'">'.'<button></button>'.'</td>';
        echo '<td onclick = "'."window.location.href = 'operation.php?operation=delete&primary_key=".$PRIMARY_KEY_VALUE."';" .'">'.'<img src="delete.png" alt="Delete"/>'.'</td>';
        // <td onclick = "window.location.href = 'operation.php?primary_key=3'; "><button>@</button></td>;
        // <td onclick = "window.location.href = 'operation.php?operation=delete&primary_key=$PRIMARY_KEY_VALUE';"><button>@</button></td>;

        echo '</tr>';
    }
    echo '</table>';
    // echo "</form>";
    // echo none_null_col($table, $connection)[1];

    // $row = mysqli_fetch_assoc($result);
    // foreach ($row as $column_name => $value) {
    //         echo '<th>' . $column_name . '</th>';
    // }// $password = $_GET['password'];
// }

// ====================================================================================
    mysqli_close($connection);
?>
