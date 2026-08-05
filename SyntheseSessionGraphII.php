  <?php
include_once 'Security.php';
$IdSession = app_get_int("IdSession", isset($IdSession) ? $IdSession : 0);
//echo "<br>IdSession = ".$IdSession;

//include 'ConnexionBDDiPassBall.php';

  ?>

  <html>
    <head>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      //google.charts.setOnLoadCallback(drawSeriesChartI);
      google.charts.setOnLoadCallback(drawSeriesChartII);

    function drawSeriesChartII() {

      var data = google.visualization.arrayToDataTable([
        ['Code J', 'Pts / Impact', 'Score', 'G/D','Dist moy'],
      <?php

      /*$ Données SynthèseDonnéesPartie*/
      $sqlResultatsSession = "SELECT * FROM SyntheseDonneesParties WHERE IdSession=".$IdSession." ORDER BY Score DESC";
      //echo $sqlResultatsSession;

      /*$reponse = $bd->query($sql, SQLITE3_BOTH, $err);*/
      $reponse = $bd->query($sqlResultatsSession);
      if ($reponse === FALSE) {
          echo "La requete a echouee pour la raison suivante: ".$err;
      } else {


          // Init des valeurs min et max
          // $ImpMin = 0;
          // $ImpMax = 0;
          //
          // $PtsImpMin = 0;
          // $PtsImpMax = 0;
          //
          // $CinqGMin = 0;
          // $CinqGMax = 0;
          //
          // $CinqDMin = 0;
          // $CinqDMax = 0;
          //
          // $GMin = 0;
          // $GMax = 0;
          //
          // $DMin = 0;
          // $DMax = 0;



          $i=1;

          while ($row = $reponse->fetchArray()) {
              /*IdSession ,IdPartie , NomJoueur , PrenomJoueur , Score , Nb Impact , Dmoy ,Dmin , Dmax , NbBG, NbBD*/

              // Info Joueur
              $sqlJoueur = "SELECT * FROM Joueurs WHERE IdJoueur=".$row['IdJoueur'];
              $reponseJ = $bd->query($sqlJoueur);
              $rowJ = $reponseJ->fetchArray();

              $PtParImp = number_format($row['Score'] / $row['NbImp'], 2, '.', ' ');

              $dmoy = number_format($row['dmoy'], 2, '.', ' ');
              $dmin = number_format($row['dmin'], 2, '.', ' ');
              $dmax = number_format($row['dMax'], 2, '.', ' ');


              // Calcul Axes Verticaux min et max
              If ($i == 1 ){
                  $Vmin = $row['Score'];
                  $Vmax = $row['Score'];
              }

              If ($Vmax <= $row['Score']){
                  $Vmax = $row['Score'];
              }


              If ($row['Score'] <= $Vmin ){
                  $Vmin = $row['Score'];
              }

              // Calcul Axes Horizontaux min et max
              If ($i == 1 ){
                  $Hmin = $PtParImp;
                  $Hmax = $PtParImp;
              }

              If ($Hmax <= $PtParImp){
                  $Hmax = $PtParImp;
              }


              If ($PtParImp <= $Hmin ){
                  $Hmin = $PtParImp;
              }

              $i=$i+1;

              // Graduation Cercles et couleurs
              if ($row['pG'] <= 0.4) {

                $GD="%G<40%";

              }

              if ($row['pG'] < 0.5 And $row['pG'] > 0.4) {

                //$GD="40%<%G<50%";
                $GD="%G<50%";

              }
              if ($row['pG'] < 0.6 And $row['pG'] >= 0.5) {

                //$GD="50%<%G<60%";
                $GD="%G<60%";

              }

              if ($row['pG'] >= 0.6) {

                $GD="%G>60%";
                // $GD=$row['pG'];

              }

              //['Code J', 'Pts / IMpact', 'Pts', 'G/D',     'Dist moy'],
              echo "['".$rowJ['CodeJoueur']."',".$PtParImp.",".$row['Score'].",'".$GD."',".$dmoy."],";



          }
      }

      // Calcul Axes Verticaux min et max
      $Vmin = $Vmin - 50;
      $Vmax = $Vmax + 50;
      //echo " Vmin =".$Vmin." Vmax =".$Vmax."<br>";

      // Calcul Axes Verticaux min et max
      $Hmin = number_format($Hmin, 0, '.', ' ') - 1;
      $Hmax = number_format($Hmax, 0, '.', ' ') + 1;
      //echo " Hmin =".$Hmin." Hmax =".$Hmax."<br>";

      ?>
        ]);



      var options = {
        title: 'Corrélation entre le Score, le nombre de points moyen par impacts \n ET la Distance moyenne par partie (diamètre cercle)',
        titleTextStyle : {  color: 'green',
                            fontName: 'Arial',
                            fontSize: 22,
                            bold: true,
                            italic: true, },
        backgroundColor: '#e9f0ea',
        chartArea:{width:'75%',height:'75%',
                  backgroundColor: {stroke : 'green', strokeWidth:3 },
                },
        hAxis:      {title: 'Points par Impacts',
                     titleTextStyle: {
                        color: '#FF0000',
                        fontName: 'Arial',
                        fontSize: 20,
                        bold: true,},
                      viewWindow : {
                        min: <?php echo $Hmin ?> ,
                        max: <?php echo $Hmax ?> ,},
                      gridlines : {
                        color: '#333',
                        count: 20,},
                        // minSpacing: 10},
                      },
        vAxis:      {title: 'Score',
                     titleTextStyle: {
                        color: '#FF0000',
                        fontName: 'Arial',
                        fontSize: 20,
                        bold: true,},
                      viewWindow : {
                        min: <?php echo $Vmin ?>,
                        max: <?php echo $Vmax ?> ,},
                      gridlines : {
                        color: '#333',
                        count: 15,},
                        // minSpacing: 10},
                      },
        colorAxis: {colors: ['yellow', 'red']},
        bubble: {textStyle:
                  {fontSize: 18,
                    fontName: 'Arial',
                    color: 'black',
                    bold: true,
                    auraColor: 'none'}
                }

      };

      var chart = new google.visualization.BubbleChart(document.getElementById('series_chart_divII'));
      chart.draw(data, options);

    }
    </script>

<center>

    <div id="series_chart_divII" style="width: 1000px; height: 500px;"></div>

</center>

</body>
</html>
