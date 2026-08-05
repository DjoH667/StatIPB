<?php

include 'MenuIPassBall.php';  // Ok.
?>

<?php

/* Variables passées en prametres dans l'url*/
$IdP = $_GET["IdP"];
$IdJ = $_GET["IdJ"];


include 'ConnexionBDDiPassBall.php';


// Lecture des donnees dans la table
$sqlParametresPartie = "SELECT * FROM ParametresPartie where IdPartie='".$IdP."'";
/*$sqlParametresPartie = "SELECT * FROM ParametresPartie ";*/
$sqlJoueur = "SELECT * FROM Joueurs where IdJoueur='".$IdJ."'";
$sqlDonneesPartie = "SELECT NbImp,Dist,dmoy,dmin,dMax FROM DonneesParties where IdPartie='".$IdP."'";


/*$reponse = $bd->query($sql, SQLITE3_BOTH, $err);*/
$reponseParametresPartie = $bd->query($sqlParametresPartie);
$reponseJoueur = $bd->query($sqlJoueur);
$reponseDonneesPartie = $bd->query($sqlDonneesPartie);

/*
if ($reponseParametresPartie === FALSE)
    echo "La requete ParametresPartie a echouee pour la raison suivante: ".$err;
*/

if ($reponseJoueur === FALSE)
    echo "La requete Joueur a echouee pour la raison suivante: ".$err;

if ($reponseDonneesPartie === FALSE)
    echo "La requete DonneesPartie a echouee pour la raison suivante: ".$err;

$rowJoueur = $reponseJoueur->fetchArray();
$Joueur = $rowJoueur['PrenomJoueur']." ".$rowJoueur['NomJoueur'];

$rowParametresPartie= $reponseParametresPartie->fetchArray();

$DureePartie = $rowParametresPartie['DatePartie'];
$Dmin = $rowParametresPartie['DminPartie']/100;
$c1 = $rowParametresPartie['c1Partie'];
$c2 = $rowParametresPartie['c2Partie'];

//echo "Synthèse IdPartie = ".$IdP." & IdJoueur = ".$IdJ."<br>";
echo "<a href='SynthesePartie.php?IdJ=".$IdJ."&IdP=".$IdP."'>Retour sur la Synthese  de la Partie n°".$IdP." Par ".$Joueur."</a>";

?>


<p>R&eacute;sultats Partie</p>
<p>Date : <?php echo $rowParametresPartie['DatePartie']?></p>
<p>Joueur :  <?php echo $Joueur; ?> </p>

<p>Dur&eacute;e : <?php echo $rowParametresPartie['DureePartie'].' Minute' ?></p>
<p>Dmin : <?php echo $rowParametresPartie['DminPartie'].' Mètre' ?></p>
<p>c1: <?php echo $rowParametresPartie['c1Partie'] ?></p>
<p>c2 : <?php echo $rowParametresPartie['c2Partie'] ?></p>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

                function drawChart1() {
                  var data = google.visualization.arrayToDataTable([
                  //['Impactnum',d min,d moy,Dist,d Max
                  <?php
                  while ($rowDonneesPartie = $reponseDonneesPartie->fetchArray()) {
                    echo
                    "['".$rowDonneesPartie['NbImp']."',"
                    .$rowDonneesPartie['dMax'].","
                    .$rowDonneesPartie['dmoy'].","
                    .$rowDonneesPartie['Dist'].","
                    .$rowDonneesPartie['dmin']."],"."\n";
                    // Distance min - Distance Max / Distance moyenne - Distance '
                    }
                    ?>

                      // Treat first row as data as well.
                    ], true);

                  var options = {
                    legend:{position: 'top', textStyle: {color: 'blue', fontSize: 16}},
                    'title':'Distance min - Distance Max / Distance moyenne - Distance ',
                    'width':800,
                    'height':600,
                    hAxis: {
                      title: 'N Impact'
                    },
                    vAxis: {
                      title: 'Distance en m',
                      minValue: 2,
                      gridlines: {color: '#333', minSpacing: 10}
                    },

                    candlestick: {
                          fallingColor: { strokeWidth: 0, fill: '#a52714' }, // red
                          risingColor: { strokeWidth: 0, fill: '#0f9d58' }   // green
                        }

                    //animation.startup: true
                    //animation.duration:2000

                  };

                  var chart1 = new google.visualization.CandlestickChart(document.getElementById('CandlestickChartPhp'));

                  chart1.draw(data, options);

                  }



                  function drawChart2() {
                    var data = google.visualization.arrayToDataTable([
                      ['Year', 'Sales', 'Expenses'],
                      ['2013',  1000,      400],
                      ['2014',  1170,      460],
                      ['2015',  660,       1120],
                      ['2016',  1030,      540]
                    ]);

                    var options = {
                      title: 'Distances suivant impacts',
                      hAxis: {title: 'Year',  titleTextStyle: {color: '#333'}},
                      vAxis: {minValue: 0},
                      vAxis: {minValue: 100}
                    };

                    var chart2 = new google.visualization.AreaChart(document.getElementById('chart_distance'));
                    chart2.draw(data, options);
                  }

</script>

        <h2>Evolutions des distances suivant Impacts</h2>
        <div id="CandlestickChartPhp" align="center" ></div>
        <div id="chart_distance" style="width: 100%; height: 500px;"></div>


<?php include 'AbaqueChartsPointDistance.php'; ?>
