<html>
    <head>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
    <div class="container" id="div">
        <?php
// ====================================================================================
// include "functions.php";

$connection = connect('mydb');

session_start();

check();

$table = $_GET['table'];
if (!in_array($table, tables($connection))) {
    $table = "";
}
$_SESSION['table'] = $table;

echo $table . "<br><br>";


try {
    $col_result = mysqli_query($connection, "SHOW COLUMNS FROM $table");
} catch (Exception $e) {
    echo "Query failed: <br>" . $e->getMessage() . "<br><br>";
}
try {
$result = mysqli_query($connection, "SELECT * FROM $table");
} catch (Exception $e) {
    echo "Query failed: <br>" . $e->getMessage() . "<br><br>";
    echo "Probably, no such table." . "<br><br>";
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
    echo '<th>'.' | '.'Delete Row'.'</th>';
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
        ?><br/><br/>
<script type="text/javascript">
// create a form
function info_prompt() {
    var div = document.getElementById("div");
    var form = document.createElement("form");
    form.action = "operation.php?operation=insert";
    form.method = "POST"
    div.appendChild(form);
    var table = document.createElement("table");
    form.appendChild(table);
    var demands = <?php echo json_encode(none_null_col($_SESSION['table'], $connection)); ?>;

    var original_table = document.getElementById("table");
    var l = original_table.rows[0].cells.length;

    var newRow = table.insertRow();
    
    for (let i = 0; i < l; i++) {
        var cell = newRow.insertCell();

        var index = demands.indexOf(original_table.rows[0].cells[i].innerHTML);

        if (index != -1) {
        var input = document.createElement("input");
        input.type = "text";
        input.id = "info_id";
        input.name = demands[index];
        input.placeholder = demands[index];
        cell.appendChild(input);
        } else {
        cell.innerHTML = "";
        }
    }
    var br = document.createElement("br");
    // var form = document.createElement("form");
    var submit = document.createElement("input");
    submit.type = "submit";
    submit.value = "Submit";
    form.appendChild(br);
    form.appendChild(br);
    form.appendChild(submit);
    // form {table} submit 
}

function alter(self, $PRIMARY_KEY_VALUE, $column_name) {
    self.onclick = "";
    var form = document.createElement("form");
    var input = document.createElement("input");
    var submit = document.createElement("input");
    form.appendChild(input);
    form.appendChild(submit);
    form.action = "operation.php?operation=alter&primary_key="+$PRIMARY_KEY_VALUE+"&column_name="+$column_name;
    form.method = "POST";
    input.type = "text";
    input.name = "value"
    submit.type = "submit";
    submit.value = "Submit";
    input.placeholder = self.innerHTML;
    self.innerHTML = "";
    self.appendChild(form);
}
</script>
        <i>Click on any element to modify, or:</i><br/><br/>
        <button onclick="info_prompt();this.style.display='None';">Add a New Row</button><br/><br/>
        <a href="home.php">Return to home page</a>
        <?php
            mysqli_close($connection);
        ?>
    </div>
    </body>
</html>

