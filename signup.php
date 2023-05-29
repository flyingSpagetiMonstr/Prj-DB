<html>
    <head>
        <title>Sign Up</title>
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
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <!-- <label for="name">Name:</label> -->
                    <input type="text" name="name" id="name_id" placeholder="Name"><br><br>

                    <!-- <label for="password">Password:</label> -->
                    <input type="password" name="password" id="password_id" placeholder="Password"><br><br>

                    <input type="submit" name="submit" value="Create account">
                    </form>
                </p>
                Already has an account? <a href='signin.php'>Sign in here</a><br/><br/>
                <?php include "signup-script.php"?>
            </div>
        </div>
    </body>
</html>

