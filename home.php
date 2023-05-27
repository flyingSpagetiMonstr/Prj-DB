<html>
    <head>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
    <div class="container">
        <!-- <h2>Welcome</h2> -->
        <?php
        include "functions.php";
        session_start();
        $privilege = $_SESSION['privilege'];
        // echo "|", $privilege, "|";

        $connection = connect('mydb');

        $sql = "show tables";
        $result = mysqli_query($connection, $sql);

        echo "Here are the tables in our company's database:<br><br>";
        if (mysqli_num_rows($result) > 0) {
            echo '<table>';
            // body of table
            mysqli_data_seek($result, 0); // Reset result set pointer to the beginning
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                foreach ($row as $table_name) {
                    // echo '<td onclick = "submitForm('. "'" . $value . "'" . ');">'. $value . '</td>';
                    // echo '<td onclick = "relink(' . "'" . $raw_name . "', " . "'" . $password . "', " . "'" . $value . "'" . ');">'. $value . '</td>';
                    // echo '<td onclick = "relink(' . "'" . $raw_name . "', " . "'" . $password . "', " . "'" . $value . "'" . ", 'table'" .');">'. $value . '</td>';
                    echo '<td onclick = "' . "window.location.href = 'table.php?table=" . $table_name . "';"  . '">'. $table_name . '</td>';
                }
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo 'No data available.';
        }

        mysqli_close($connection);
        ?><br/><br/>
        Click one to view details.
    </div>
    </body>
</html>
