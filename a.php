<?php

    mysqli_begin_transaction($connection);
    try {
        $succeed = mysqli_stmt_execute($stmt);
    } catch (Exception $e) {
        echo "Execution failed: <br>" . $e->getMessage() . "<br><br>";    
        // $succeed = 1; // in fact, failed
        mysqli_rollback($conection);
    }
    mysqli_commit($connection);

?>