<html>
    <head>
        <title>Operation</title>
        <link rel="stylesheet" href="styles.css">
        <link href="https://unpkg.com/cirrus-ui" type="text/css" rel="stylesheet"/>
        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,300,400,600,700" rel="stylesheet"/>
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet"/>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous"/>
        <?php include "functions.php"?>
    </head>
    <body>
        <div class="card Placeholder">
            <div class="content">
                <p>
                    <?php include "operation-script.php"?>
                </p>
                <a href="<?php echo $_SERVER['HTTP_REFERER'];?>">Return to the previous page</a>
            </div>
        </div>
    </body>
</html>

