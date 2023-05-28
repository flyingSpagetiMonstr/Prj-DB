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
        echo "<i>Welcome, " . $_SESSION['privilege'] . "!</i><br><br>";

        $connection = connect('mydb');

        $tables = tables($connection);
        

        echo "<i>Here are the tables in our company's database:</i><br><br>";
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
        <i>Click one to view details, or:</i><br/><br/>
        <a href="operation.php?operation=backup"><button><i>Back up current database</i></button></a><br/><br/>
        <a href="operation.php?operation=recover"><button><i>Recover database from last backup</i></button></a><br/><br/>
        
    </div>
    </body>
</html>
