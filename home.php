<!-- add trigger -->
<html>
    <head>
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
          <?php prompt("Here are the data tables in our company's database:") ?>
        </p>
      </div>
    </div>

    <div class="card real_card middle-it">
      <div class="card__container middle-it" style="display:block;">
        <?php include 'home-script.php';?>
      </div>

      <div class="card__mobile-title">
        <div class="content">
          <div class="tile">
            <div class="tile__container">
              <p class="tile__title"><i>Click one to view details</i></p>
              <p class="tile__subtitle">Or: </p>
            </div>
          </div>
        </div>
      </div>
      
      <div class="card__body content" style="height:fit-content">
          <a href="operation.php?operation=backup"><button><i>Back up current database</i></button></a><br/><br/>
          <a href="operation.php?operation=recover"><button><i>Recover database from last backup</i></button></a><br/><br/>
          <a href="signin.php"><button><i>Log out</i></button></a>
      </div>
    </div>


    <div class="middle-it">
        <br/><br/>
        

    </div>
    </body>
</html>
