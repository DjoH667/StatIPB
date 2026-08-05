<?php

include 'MenuIPassBall.php';  // Ok.
include_once 'Security.php';
?>

<?php

/* Variables passées en prametres dans l'url*/
$IdP = app_get_int("IdP");
$IdJ = app_get_int("IdJ");


include 'ConnexionBDDiPassBall.php';


// Lecture des donnees dans la table
$sqlParametresPartie = "SELECT * FROM ParametresPartie where IdPartie='".$IdP."'";
/*$sqlParametresPartie = "SELECT * FROM ParametresPartie ";*/
$sqlJoueur = "SELECT * FROM Joueurs where IdJoueur='".$IdJ."'";
$sqlDonneesPartie = "SELECT * FROM DonneesParties where IdPartie='".$IdP."'";


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

$Joueur = $rowJoueur['PrenomJoueur']." ".substr($rowJoueur['NomJoueur'], 0, 3);

$rowParametresPartie= $reponseParametresPartie->fetchArray();

$DureePartie = $rowParametresPartie['DatePartie'];
$Dmin = $rowParametresPartie['DminPartie']/100;
$c1 = $rowParametresPartie['c1Partie'];
$c2 = $rowParametresPartie['c2Partie'];

//echo "Synthèse IdPartie = ".$IdP." & IdJoueur = ".$IdJ."<br>";
echo "<b><a href='SynthesePartie.php?IdJ=".$IdJ."&IdP=".$IdP."'>Retour sur la Synthese  de la Partie n°".$IdP." Par ".$Joueur."</a></b>";

if ($rowParametresPartie['DureePartie']<60){
$DureePartie = $rowParametresPartie['DureePartie'];
$StringDureePartie = $DureePartie." s";
}
else {
$DureePartie = $rowParametresPartie['DureePartie']/60;
$StringDureePartie = $DureePartie." min";
}

$Dnom = $rowParametresPartie['DminPartie']/100;

list($Annee, $Mois, $Jour) = explode('-',$rowParametresPartie['DatePartie']);



?>

<h1>Graphiques Partie n° <?php echo $IdP ?> du <?php echo $Jour."/".$Mois."/".$Annee ?>  par <?php echo $Joueur; ?>  </h1>
<h2>Dur&eacute;e : <?php echo $StringDureePartie ?>  </h2>
<b><u>Parmètres partie :</u> D nominale = <?php echo $Dnom.' Mètres' ?> avec
c1: <?php echo $rowParametresPartie['c1Partie'] ?> /
c2 : <?php echo $rowParametresPartie['c2Partie'] ?>
</b>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChartPoint);
        google.charts.setOnLoadCallback(drawChartDistance);
        google.charts.setOnLoadCallback(drawChartForce);


// title: 'Points, Distances en mètres et force en g suivant impacts',

                      function drawChartPoint() {
                        var data = google.visualization.arrayToDataTable([
                          ['Impactnum1','Points','Dist','Dist moy','Force'],
                          <?php
                          $i=0;
                          while ($rowDonneesPartie = $reponseDonneesPartie->fetchArray()) {
                          // Distance min - Distance Max / Distance moyenne - Distance '
                          if ($i=0) {
                            $NbPoint = $rowDonneesPartie['Score'];
                          }
                          else {
                            $NbPoint = $rowDonneesPartie['Score'] - $Score;
                            //$NbPoint = $rowDonneesPartie['Score'];
                          }
                          $Tps= round($rowDonneesPartie['Tps']);
                          echo
                          "['n°".$rowDonneesPartie['NbImp']." / ".$Tps." s',"
                          .$NbPoint.","
                          .$rowDonneesPartie['Dist'].","
                          .$rowDonneesPartie['dmoy'].","
                          .$rowDonneesPartie['Force']."],"."\n";

                          //$NbPoint = $rowDonneesPartie['Score'];
                          $Score = $rowDonneesPartie['Score'];
                          $NbTotalImmpacts = $rowDonneesPartie['NbImp'];
                          $DistMoyFinale = $rowDonneesPartie['dmoy'];

                          $i=$i+1;

                          }
                          ?>
                          ]);


                        var options = {
                          title: 'nb Points / Impact, Distances en mètres et force en g suivant impacts',
                          titleTextStyle : {  color: 'green',
                                              fontName: 'Arial',
                                              fontSize: 22,
                                              bold: true,
                                              italic: true, },
                          backgroundColor: '#e9f0ea',
                          chartArea:{width:'80%',height:'75%',
                                    backgroundColor: {stroke : 'green', strokeWidth:3 },
                                  },
                          hAxis: {
                                  title: 'N° Impact  / Temps ds la Partie',
                                  titleTextStyle: {
                                     color: '#FF0000',
                                     fontName: 'Arial',
                                     fontSize: 20,
                                     bold: true,},
                                  gridlines : {minSpacing: 10}
                                  },
                          vAxis: {
                                  title :'Points /  Distance (m) / Force (g)',
                                  titleTextStyle: {
                                     color: '#FF0000',
                                     fontName: 'Arial',
                                     fontSize: 20,
                                     bold: true,},
                                  minValue: 0,
                                  format:'##,##',
                                  gridlines : {minSpacing: 10 }
                                },
                          width : '1200',
                          height : '600'
                        };

                        var chartPoint = new google.visualization.AreaChart(document.getElementById('chart_point'));
                        chartPoint.draw(data, options);
                      }

// title: 'Distances en mètres suivant impacts',

                      function drawChartDistance() {
                        var data = google.visualization.arrayToDataTable([
                          ['Impactnum1','Dist Max','Dist moy','Dist','Dist  min'],
                          <?php
                          while ($rowDonneesPartie = $reponseDonneesPartie->fetchArray()) {
                          // Distance min - Distance Max / Distance moyenne - Distance '
                          $Tps= round($rowDonneesPartie['Tps']);
                          echo
                          "['n°".$rowDonneesPartie['NbImp']." / ".$Tps." s',"
                          .$rowDonneesPartie['dMax'].","
                          .$rowDonneesPartie['dmoy'].","
                          .$rowDonneesPartie['Dist'].","
                          .$rowDonneesPartie['dmin']."],"."\n";

                          }
                          ?>
                          ]);


                        var options = {
                          title: 'Distances en mètres suivant impacts',
                          titleTextStyle : {  color: 'green',
                                              fontName: 'Arial',
                                              fontSize: 22,
                                              bold: true,
                                              italic: true, },
                          titleTextStyle : {  color: 'green',
                                              fontName: 'Arial',
                                              fontSize: 22,
                                              bold: true,
                                              italic: true, },
                          backgroundColor: '#e9f0ea',
                          chartArea:{width:'80%',height:'75%',
                                    backgroundColor: {stroke : 'green', strokeWidth:3 },
                                  },
                          hAxis: {
                                  title: 'N° Impact  / Temps ds la Partie',
                                  titleTextStyle: {
                                     color: '#FF0000',
                                     fontName: 'Arial',
                                     fontSize: 20,
                                     bold: true,},
                                  gridlines : {minSpacing: 10}
                                  },
                          vAxis: {
                                  title :'Distance en mètres',
                                  titleTextStyle: {
                                     color: '#FF0000',
                                     fontName: 'Arial',
                                     fontSize: 20,
                                     bold: true,},
                                  minValue: 0,
                                  format:'##,##',
                                  gridlines : {minSpacing: 10 }
                                },
                          width : '1200',
                          height : '600'
                        };

                        var chartDistance = new google.visualization.AreaChart(document.getElementById('chart_distance'));
                        chartDistance.draw(data, options);
                      }

// title: 'Force suivant impacts',

                      function drawChartForce() {
                        var data = google.visualization.arrayToDataTable([
                          ['Impactnum2','Force Max','Force moy','Force','Force min'],
                          <?php
                          while ($rowDonneesPartie = $reponseDonneesPartie->fetchArray()) {
                          // Distance min - Distance Max / Distance moyenne - Distance '
                          $Tps= round($rowDonneesPartie['Tps']);
                          echo
                          "['n°".$rowDonneesPartie['NbImp']." / ".$Tps." s',"
                          .$rowDonneesPartie['FMax'].","
                          .$rowDonneesPartie['FMoy'].","
                          .$rowDonneesPartie['Force'].","
                          .$rowDonneesPartie['Fmin']."],"."\n";

                          $ForceMoyFinale = $rowDonneesPartie['FMoy'];

                          }
                          ?>
                          ]);


                        var options = {
                          title: 'Force suivant impacts',
                          titleTextStyle : {  color: 'green',
                                              fontName: 'Arial',
                                              fontSize: 22,
                                              bold: true,
                                              italic: true, },
                          backgroundColor: '#e9f0ea',
                          chartArea:{width:'80%',height:'75%',
                                    backgroundColor: {stroke : 'green', strokeWidth:3 },
                                  },
                          hAxis: {title: 'N° Impact  / Temps ds la Partie',
                                  titleTextStyle: {
                                     color: '#FF0000',
                                     fontName: 'Arial',
                                     fontSize: 20,
                                     bold: true,},
                                  },
                          vAxis: {title :'Force en g',
                                  titleTextStyle: {
                                     color: '#FF0000',
                                     fontName: 'Arial',
                                     fontSize: 20,
                                     bold: true,},
                                  minValue: 0,
                                  format:'##,##',
                                  gridlines : {minSpacing: 10}
                                },
                          width : '1200',
                          height : '600'
                        };

                        var chartForce = new google.visualization.AreaChart(document.getElementById('chart_force'));
                        chartForce.draw(data, options);
                      }


</script>

        <h2>Nombre de Points, Distance et Force Suivant Impacts</h2>
<?php echo "<b><u>Rappel :</u> Score =   ".$Score." points pour ".$NbTotalImmpacts." impacts. Distance Moyenne Finale = ".$DistMoyFinale." mètres<b><br>"; ?>
        <div id="chart_point" style="width: 100%; height: 600px;" align="center"></div>
  <br>
        <h2>Distance de frappe suivant Impacts</h2>
<?php echo "<b><u>Rappel :</u> Score =   ".$Score." points pour ".$NbTotalImmpacts." impacts. Distance Moyenne Finale = ".$DistMoyFinale." mètres<b><br>"; ?>
        <div id="chart_distance" style="width: 100%; height: 600px;" align="center"></div>
  <br>

        <h2>Estimation de la Force suivant Impacts</h2>
<?php echo "<b><u>Rappel :</u> Score =   ".$Score." points pour ".$NbTotalImmpacts." impacts. Force Moyenne Finale = ".$ForceMoyFinale." g<b><br>"; ?>
        <div id="chart_force" style="width: 100%; height: 600px;" align="center" ></div>
  <br>

<?php include 'AbaqueChartsPointDistance.php'; ?>
