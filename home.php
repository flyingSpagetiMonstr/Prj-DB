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

    <div class="card Placeholder" style="height:fit-content;width:fit-content;margin: 5px auto; padding-bottom:0%;padding-top: 25px;;">
      <div class="content">
        <p>
          <?php prompt("Here are the data tables in our company's database:") ?>
        </p>
      </div>
    </div>

    <div class="card real_card card--slide-up middle-it" style="margin:0 auto">
      <div class="card__container" style="display:grid;">
        <?php include 'home-script.php';?>
      </div>

      <div class="card__mobile-title px-1">
        <div class="content">
          <div class="tile">
            <div class="tile__container">
              <p class="tile__title"><i>Click one to view details</i></p>
              <p class="tile__subtitle">Or:[More operations]</p>
            </div>
          </div>
        </div>
      </div>
      
      <div class="card__body content" style="height:fit-content">
          <a href="operation.php?operation=backup"><button><i>Back up current database</i></button></a><br/><br/>
          <a href="operation.php?operation=recover"><button><i>Recover database from last backup</i></button></a><br/><br/>
      </div>
    </div>


    <div class="middle-it">
        <br/><br/>
        

    </div>
    </body>
</html>
