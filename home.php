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
        check();
        echo "Welcome, " . $_SESSION['privilege'] . "!<br><br>";

        $connection = connect('mydb');

        $tables = tables($connection);
        

        echo "Here are the tables in our company's database:<br><br>";
        if (count($tables) > 0) {
            echo '<table>';
            foreach ($tables as $table) {
                echo '<tr>';
                echo '<td onclick = "' . "window.location.href = 'table.php?table=" . $table . "';"  . '">'. $table . '</td>';
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
