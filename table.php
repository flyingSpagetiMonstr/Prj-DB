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

// error_reporting(E_ALL);
// ini_set('display_errors', 1);

$table = $_GET['table'];
$_SESSION['table'] = $table;

$connection = connect($_SESSION['raw_name'], $_SESSION['password']);
$table = mysqli_real_escape_string($connection, $table); // not tested yet #######
$query = "SELECT * FROM $table";
$result = mysqli_query($connection, $query);
// SELECT * FROM Employee where employeeName = 'Xiao Wang' 
// SELECT * FROM Employee where employeeName = '' or '1' = '1' 
// SELECT * FROM Employee; SELECT * FROM Supplier;
if (mysqli_num_rows($result) > 0) {
    $PRIMARY_KEY = primary_key($table, $connection);
// $password = $_GET['password'];

    echo '<table id = "table">';

    // head of table
    echo '<tr>';
    $row = mysqli_fetch_assoc($result);

    $i = 0;
    $PRIMARY_KEY_INDEX = -1; // starts from 0
    foreach ($row as $column_name => $value) {
        if ($column_name != $PRIMARY_KEY) {
            $i++;
        }
        else {
            $PRIMARY_KEY_INDEX = $i;
        } 
        echo '<th>' . $column_name . '</th>';
    }

    // echo '<th id="'.$column_name.'">'.' | '.'Delete Row'.'</th>';
    echo '<th>'.' | '.'Delete Row'.'</th>';
    echo '</tr>';

    // body of table
    mysqli_data_seek($result, 0); // Reset result set pointer to the beginning
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        $i = 0;
        foreach ($row as $value) {
            if ($i == $PRIMARY_KEY_INDEX) {
                $PRIMARY_KEY_VALUE = $value;
            }
            echo '<td >'. $value . '</td>';
            $i++;
        }
        // echo '<td >'.'<button/>'.'</td>';
        // echo '<td id="'.$PRIMARY_KEY_VALUE.'">'.'<button>@</button>'.'</td>';
        echo '<td onclick = "'."window.location.href = 'operation.php?primary_key=".$PRIMARY_KEY_VALUE."';" .'">'.'<button>@</button>'.'</td>';

        echo '</tr>';
    }
    echo '</table>';


    // echo none_null_col($table, $connection)[1];

    // $row = mysqli_fetch_assoc($result);
    // foreach ($row as $column_name => $value) {
    //         echo '<th>' . $column_name . '</th>';
    // }// $password = $_GET['password'];

}

mysqli_close($connection);
// ====================================================================================
        ?><br/><br/>
        AAAAAAAAAAAAAAAAAAAAAA
<script type="text/javascript">
function info_prompt() {
    // alert(1);
    // var table = document.getElementById("table");
    // var newRow = table.insertRow();
    // alert(1);
    // // var demands = <?php echo json_encode(none_null_col($_SESSION['table'], $connection)); ?>;
    // alert(1);

    // alert(demands);
    // l = table.rows[0].cells.length;
    // for (let i = 0; i < l; i++) {
    //     // if (table.rows[0].cells[i].innerHTML in ) {
            
    //     // }
    //     var input = document.createElement("input");
    //     input.type = "text";
        
    //     input.id = "info_id";
    //     input.name = "info";
        
    //     var cell = newRow.insertCell();
    //     cell.appendChild(input);
    // }
}
</script>
        BBBBBBBBBBBBBBBBBBBBBB
        <button onclick="info_prompt()">New Row</button><br/><br/>
    </div>
    </body>
</html>

