<html>
    <head>
        <title>Sign In</title>
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
                    <input type="text" name="password" id="password_id" placeholder="Password"><br><br>

                    <input type="submit" name="submit" value="Sign in">
                    </form>
                </p>
                <!-- <div class="card__footer content"> -->
                Does not has an account yet? <a href='signup.php'>Sign up here</a><br/><br/>
                <!-- </div> -->
            </div>
            <?php include "signin-script.php"?>
        </div>
    </body>
</html>

