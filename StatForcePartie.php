<?php
include 'MenuDev.php';  // Ok.
include 'MenuIPassBall.php';  // Ok.
?>

<?php

/* Variables passées en prametres dans l'url*/
$IdP = $_GET["IdP"];
$IdJ = $_GET["IdJ"];





echo "Synthèse IdPartie = ".$IdP." & IdJoueur = ".$IdJ."<br>";
echo "<a href='SynthesePartie.php?IdJ=".$IdP."&IdP=".$IdJ."'>Synthese  de la Partie n°".$IdP." Par ".$IdJ."</a>";

include 'ConnexionBDDiPassBall.php';

// Lecture des donnees dans la table
$sqlParametresPartie = "SELECT * FROM ParametresPartie where IdPartie='".$IdP."'";
/*$sqlParametresPartie = "SELECT * FROM ParametresPartie ";*/
$sqlJoueur = "SELECT * FROM Joueurs where IdJoueur='".$IdJ."'";
$sqlDonneesPartie = "SELECT NbImp,Force,Fmoy,Fmin,FMax FROM DonneesPartie where IdPartie='".$IdP."'";


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
$Joueur = $rowJoueur['NomJoueur']." ".$rowJoueur['PrenomJoueur'];

$rowParametresPartie= $reponseParametresPartie->fetchArray();


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

                function drawChart() {
                  var data = google.visualization.arrayToDataTable([
                  //['Impactnum',d min,d moy,Dist,d Max
                  <?php
                  while ($rowDonneesPartie = $reponseDonneesPartie->fetchArray()) {
                  echo
                  "['".$rowDonneesPartie['NbImp']."',"
                  .$rowDonneesPartie['Fmin'].","
                  .$rowDonneesPartie['Fmoy'].","
                  .$rowDonneesPartie['Force'].","
                  .$rowDonneesPartie['FMax']."],"."\n";
                  // Distance min - Distance Max / Distance moyenne - Distance '
                  }
                  ?>

                    // Treat first row as data as well.
                  ], true);

                  var options = {
                    legend:{position: 'top', textStyle: {color: 'blue', fontSize: 16}},
                    'title':'Force min - Force Max / Force moyenne - Force ',
                    'width':800,
                    'height':600,
                    hAxis: {
                      title: 'N Impact'
                    },
                    vAxis: {
                      title: 'Force en ?',
                      //minValue: 2,
                      gridlines: {color: '#333', minSpacing: 10}
                    },

                    candlestick: {
                          fallingColor: { strokeWidth: 0, fill: '#a52714' }, // red
                          risingColor: { strokeWidth: 0, fill: '#0f9d58' }   // green
                        }
                    //animation.startup: true
                    //animation.duration:2000

};

var chart = new google.visualization.CandlestickChart(document.getElementById('CandlestickChartPhp'));

chart.draw(data, options);
}
</script>

        <h2>Chart CandlestickChart PHP</h2>
        <div id="CandlestickChartPhp" align="center" ></div>
