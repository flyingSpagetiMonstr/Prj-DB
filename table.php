<html>
    <head>
        <link rel="stylesheet" href="styles.css">
        <link href="https://unpkg.com/cirrus-ui" type="text/css" rel="stylesheet"/>
        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,300,400,600,700" rel="stylesheet"/>
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet"/>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous"/>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous"/>
        <!-- <script src="functions.js"></script> -->
        <?php include "functions.php"?>
    </head>
    <body>

    <div class="card Placeholder">
      <div class="content">
        <p>
          <?php prompt($_GET['table'] . " table: ") ?>
        </p>
      </div>
    </div>

    <div class="card real_card middle-it">
        <div class="card__container middle-it" id="before_table" style="display:flex;flex-direction:column;">
            <?php include 'table-script.php';?>
        </div>

        <div class="card__mobile-title px-1">
            <div class="content">
            <div class="tile">
                <div class="tile__container">
                <p class="tile__title"><i>Click on any element to modify</i></p>
                <p class="tile__subtitle">Or: </p>
                </div>
            </div>
            </div>
        </div>
      
        <div class="card__body content" style="height:fit-content">
            <button onclick="info_prompt();this.style.display='None';">Add a New Row</button><br/><br/>
        </div>
        <div class="card__footer content px-1"><a href="home.php">Return to home page</a></div>
    </div>
    </body>
</html>

<script>
function info_prompt() {
    var div = document.getElementById("before_table");
    var form = document.createElement("form");
    
    form.action = "operation.php?operation=insert";
    form.method = "POST"
    
    div.appendChild(form);

    var table = document.createElement("table");
    form.appendChild(table);

    var demands = <?php $connection = connect('mydb'); echo json_encode(none_null_col($_SESSION['table'], $connection));mysqli_close($connection);?>;

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
    // var submit = document.createElement("input");
    form.appendChild(input);
    // form.appendChild(submit);
    form.action = "operation.php?operation=alter&primary_key="+$PRIMARY_KEY_VALUE+"&column_name="+$column_name;
    form.method = "POST";
    input.type = "text";
    input.name = "value"
    // submit.type = "submit";
    // submit.value = "Submit";
    input.placeholder = self.innerHTML;
    self.innerHTML = "";
    self.appendChild(form);
}
</script>