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

    <div class="u-flex u-justify-center">
        <!-- One -->
        <ul class="no-bullets mx-1" >
          <li>
            <div class="card Placeholder" style="height:auto;width:auto">
              <div class="content u-center">
                <p>
                  <?php prompt("Here are the data tables in our company's database:") ?>
                </p>
              </div>
            </div>
          </li>
          <li>
            <div class="card real_card card--slide-up">
              <div class="card__container" style="height:auto;width:auto">
                <?php include 'home-script.php';?>
              </div>

              <div class="card__mobile-title px-1">
                <div class="content">
                  <div class="tile">
                    <div class="tile__container">
                      <p class="tile__title">Kangaroo Valley Safari</p>
                      <p class="tile__subtitle">By John Doe</p>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="card__body content px-1">
                <p>
                  Located two hours south of Sydney in the Southern Highland of
                  New South Wales...
                </p>
              </div>
              
              <div class="card__footer content px-1">2 min. read 22 comments</div>
            </div>
          </li>
        </ul>
        <!-- End One -->
    </div>


    <div class="middle-it">
        <br/><br/>
        <i>Click one to view details, or:</i><br/><br/>
        <a href="operation.php?operation=backup"><button><i>Back up current database</i></button></a><br/><br/>
        <a href="operation.php?operation=recover"><button><i>Recover database from last backup</i></button></a><br/><br/>
    </div>
    </body>
</html>
