<?php
    $connection = connect('mydb');

    $tables = tables($connection);
    

    if (count($tables) > 0) {
        echo '<table>';
        foreach ($tables as $table) {
            echo '<tr>';
            echo '<td onclick = "' . "window.location.href = 'table.php?table=" . $table . "';"  . '">'. '<a>' .$table . '</a>' . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo 'No data available.';
    }
    mysqli_close($connection);
?>


