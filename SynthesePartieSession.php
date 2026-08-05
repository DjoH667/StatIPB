<?php

/* Variables passées en prametres dans l'url*/
//$IdP = $_GET["IdP"];
//$IdJ = $_GET["IdJ"];


//include 'ConnexionBDDiPassBall.php';


/*$ Parametres Partie*/

$sqlParametresPartie = "SELECT * FROM ParametresPartie where IdPartie='".$IdP."'";
$reponseParametresPartie = $bd->query($sqlParametresPartie);


if ($reponseParametresPartie === FALSE)
    echo "La requete ParametresPartie a echouee pour la raison suivante: ".$err;

$rowParametresPartie= $reponseParametresPartie->fetchArray();


/*$ Données Partie*/
$sqlDonneesPartie = "SELECT
IdPartie,IdJoueur,Tps, DTps,MAX(NbImp),Cible,NbPt,Score,PtParImp,Dist,dmoy,dmin,dMax,Force,Fmoy,Fmin,FMax,
NbHGG,NbHG,NbBGG,NbBG,NbBD,NbBDD,NbHD,NbHDD,NbHS,NbHaut,NbBas,NbExtG,NbExtD,NbCentreD,NbCentreG,NbGauche,NbDroite,
pHGG,pHG,pBGG,pBG,pBD,pBDD,pHD,pHDD,pH,pB,pExtG,pCG,pCD,pExtD,pG,pD FROM DonneesParties where IdPartie='".$IdP."'";

$reponseDonneesPartie = $bd->query($sqlDonneesPartie);

if ($reponseDonneesPartie === FALSE)
    echo "La requete DonneesParties a echouee pour la raison suivante: ".$err;

$rowDonneesPartie = $reponseDonneesPartie->fetchArray();

$IdJ=$rowDonneesPartie['IdJoueur'];

/*$ Données Joueur*/
$sqlJoueur = "SELECT * FROM Joueurs where IdJoueur='".$rowDonneesPartie['IdJoueur']."'";

$reponseJoueur = $bd->query($sqlJoueur);

if ($reponseJoueur === FALSE)
    echo "La requete Joueur a echouee pour la raison suivante: ".$err;

$rowJoueur = $reponseJoueur->fetchArray();

$NomJ=substr($rowJoueur['NomJoueur'], 0, 3);
$Joueur = $rowJoueur['PrenomJoueur']." ".$NomJ;

if ($rowParametresPartie['DureePartie'] > 60 ) {

   $DureePartie = $rowParametresPartie['DureePartie']/60;
   $StringDureePartie = $DureePartie." Minute(s)";
}
else {
  $DureePartie = $rowParametresPartie['DureePartie'];
  $StringDureePartie = $DureePartie." Secondes";
}

$Dnominal = $rowParametresPartie['DminPartie']/100;
$c1=$rowParametresPartie['c1Partie'];
$c2=$rowParametresPartie['c2Partie'];


list($Annee, $Mois, $Jour) = explode('-',$rowParametresPartie['DatePartie']);

?>


<h2>Synthèse Partie n° <?php echo $IdP ?> le <?php echo $Jour.'/'.$Mois.'/'.$Annee  ?> par <b><?php echo $Joueur; ?> </h2>
<!-- <p><b><u>Params de la partie :</u>
Dur&eacute;e : <?php echo $StringDureePartie ?> /
Dmin : <?php echo $Dnominal.' m' ?> </b>   avec
c1: <?php echo $rowParametresPartie['c1Partie'] ?> /
c2 : <?php echo $rowParametresPartie['c2Partie'] ?></p> -->



<div id="chart_div" align="center"></div>


<!-- <hr size='5'color='green'> -->
<?php
//echo "Synthèse IdPartie = ".$IdP." & IdJoueur = ".$IdJ."<br>";
//echo "<a href='ResultatChronoPartie.php?IdJ=".$IdJ."&IdP=".$IdP."'>Chronologie de la Partie n° ".$IdP."</a>";
?>

<?php

$ScorePrecedent = 0;



              if ($rowDonneesPartie['MAX(NbImp)'] == "") {
                  echo "Pas de données pour cette partie";
                  echo "<hr size='5'color='green'>";
              }
              else {

              echo "<div align='center'>";
              //echo "<table style='width: 92%; border-collapse: collapse; height: 180px; border-color: blacktransparent';'' border='5'>";
              echo "<table style='width: 1000px; border-collapse: collapse; height: 180px; border-color: black';'' border='0'>";
              echo "<tbody>";

              /* ******* */
              /* DEBUT ENTETE */
              /* ******* */
              echo "<tr>";

              echo "<td></td>";
              echo "<td></td>";
              echo "<td>CODE</td>";
              echo "<td></td>";

              echo "<td>SCORE</td>";
              echo "<td></td>";
              echo "<td></td>";
              echo "<td></td>";

              echo "<td>DUREE</td>";
              echo "<td colspan='2' style='font-size: 18px;'><a href='ResultatChronoPartie.php?IdJ=".$IdJ."&IdP=".$IdP."'>Chrono Partie ".$IdP."</a></td>";
              //echo "<td style='text-align: right;' ></td>";


              echo "</tr>";

              echo "<tr style=''>";
                echo "<td style='width: 8%; '> </td>";
                echo "<td style='width: 8%; '> </td>";

                echo "<td style='width: 100px; '><b style='color:red'>".$rowJoueur['CodeJoueur']."</b></td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: 100px; '><b style='color:red'>".$rowDonneesPartie['Score']."</b></td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: 100px; '></td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: 100px; '><b style='color:red'>".$StringDureePartie."</b></td>";

                echo "<td style='width: 8%; '>&nbsp;</td>";
                echo "<td style='width: 8%; '>&nbsp;</td>";
              echo "</tr>";
              /* ******* */
              /* FIN ENTETE */
              /* ******* */
              echo "<tr style=''>";
                echo "<td style=' '></td>";
                echo "<td style=' '></td>";
                echo "<td style=' '></td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                  $NbPtsParImpact = number_format($rowDonneesPartie['Score']/$rowDonneesPartie['MAX(NbImp)'], 2 , ',', ' ');
                echo "<td style='  border-color: transparent';><b style='color:red'>>>> ".$rowDonneesPartie['MAX(NbImp)']." Impacts</b></td>";
                  echo "<td style='width: 0.1%; text-align: center; '></td>";
                echo "<td style='  font-size: 15px;'>".$NbPtsParImpact." Pts/Impact</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style=' '>&nbsp;</td>";
                echo "<td style=' '>&nbsp;</td>";
                echo "<td style=' '>&nbsp;</td>";
              echo "</tr>";
              /* ******* */
              /* Cible HAUTES  */
              /* ******* */
              echo "<tr style='height: 100px;'>";
                echo "<td style=' '>&nbsp;</td>";
                echo "<td style=' '>&nbsp;</td>";
                echo "<td style='background-color: #f8cbad;  text-align: center;'><h3>1</h3></td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='background-color: #f2b084;  text-align: center; '><h3>2</h3></td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='background-color: #f2b084;  text-align: center;''><h3>2</h3></td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='background-color: #f8cbad;  text-align: center;'><h3>1</h3></td>";
                echo "<td style='  text-align: center; color: orange ;' colspan='2' ><strong>HAUT</strong></td>";
                //echo "<td style=' '>&nbsp;</td>";

              echo "</tr>";
                          /* ******* */
                          /* LIGNE IMPACT  */
                          /* ******* */
              echo "<tr style=''>";
                echo "<td style=' '>&nbsp;</td>";
                echo "<td style=' '></td>";
                echo "<td style='background-color: #f8cbad; text-align: center; '><b style='color:red'>".$rowDonneesPartie['NbHGG']." impact(s)</b>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='background-color: #f2b084; text-align: center; '><b style='color:red'>".$rowDonneesPartie['NbHG']." impact(s)</b>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='background-color: #f2b084; text-align: center; '><b style='color:red'>".$rowDonneesPartie['NbHD']." impact(s)</b>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='background-color: #f8cbad; text-align: center; '><b style='color:red'>".$rowDonneesPartie['NbHDD']." impact(s)</b>";
                echo "<td style='  text-align: center;' colspan='2'><b style='color:red'>".$rowDonneesPartie['NbHaut']." impact(s)</b>";
                //echo "<td style=' '>&nbsp;</td>";

              echo "</tr>";
                            /* ******* */
                            /* LIGNE POURCENTAGE  */
                            /* ******* */
              echo "<tr style=''>";
                echo "<td style=' '>&nbsp;</td>";
                echo "<td style=' '>&nbsp;</td>";
                echo "<td style='background-color: #f8cbad; text-align: center; '>".($rowDonneesPartie['pHGG']*100)."%";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='background-color: #f2b084; text-align: center; '>".($rowDonneesPartie['pHG']*100)."%";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='background-color: #f2b084; text-align: center; '>".($rowDonneesPartie['pHD']*100)."%";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='background-color: #f8cbad; text-align: center; '>".($rowDonneesPartie['pHDD']*100)."%";
                echo "<td style='  text-align: center;' colspan='2'>".($rowDonneesPartie['pH']*100)."%";
                //echo "<td style=' '>&nbsp;</td>";



                /* ******* */
                /* Ligne Separation  */
                /* ******* */

                echo "<tr style='height: 3px;'>";
                  echo "<td style=' height: 3px;'></td>";
                  echo "<td style=' height: 3px;'></td>";
                  echo "<td style=' height: 3px;'></td>";
                    echo "<td style='width: 0.1%; text-align: center;'></td>";
                  echo "<td style=' height: 3px;'></td>";
                    echo "<td style='width: 0.1%; text-align: center;'></td>";
                  echo "<td style=' height: 3px;'></td>";
                    echo "<td style='width: 0.1%; text-align: center;'></td>";
                  echo "<td style=' height: 3px;'></td>";
                  echo "<td style=' height: 3px;'></td>";
                  echo "<td style=' height: 3px;'></td>";
                echo "</tr>";





              echo "</tr>";
              /* ******* */
              /* Cible BASSES  */
              /* ******* */
              echo "<tr style='height: 60px;'>";
                echo "<td style=' '>&nbsp;</td>";
                echo "<td style=' '>&nbsp;</td>";
                echo "<td style='background-color: #e2efda;  text-align: center;'><h3>3</h3></td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='background-color: #a9d08e;  text-align: center;'><h3>5g</h3></td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='background-color: #a9d08e;  text-align: center;'><h3>5d</h3></td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='background-color: #e2efda;  text-align: center;'><h3>3</h3></td>";
                echo "<td style='  text-align: center; ;color: green;' colspan='2'><strong>BAS</strong></td>";
                //echo "<td style=' '>&nbsp;</td>";

              echo "</tr>";
                          /* ******* */
                          /* LIGNE IMPACT  */
                          /* ******* */
              echo "<tr style=''>";
                echo "<td style=' '>&nbsp;</td>";
                echo "<td style=' '>&nbsp;</td>";
                echo "<td style='background-color: #e2efda; text-align: center; '><b style='color:red'>".$rowDonneesPartie['NbBGG']." impact(s)</b>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='background-color: #a9d08e; text-align: center; '><b style='color:red'>".$rowDonneesPartie['NbBG']." impact(s)</b>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='background-color: #a9d08e; text-align: center; '><b style='color:red'>".$rowDonneesPartie['NbBD']." impact(s)</b>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='background-color: #e2efda; text-align: center; '><b style='color:red'>".$rowDonneesPartie['NbBDD']." impact(s)</b>";
                echo "<td style='  text-align: center;' colspan='2'><b style='color:red'>".$rowDonneesPartie['NbBas']." impact(s)</b>";
                //echo "<td style=' '>&nbsp;</td>";

              echo "</tr>";
                          /* ******* */
                          /* LIGNE POURCENTAGE  */
                          /* ******* */
              echo "<tr style=''>";
                echo "<td style=' '>&nbsp;</td>";
                echo "<td style=' '>&nbsp;</td>";
                echo "<td style='background-color: #e2efda; text-align: center; '>".($rowDonneesPartie['pBGG']*100)."%";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='background-color: #a9d08e; text-align: center; '>".($rowDonneesPartie['pBG']*100)."%";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='background-color: #a9d08e; text-align: center; '>".($rowDonneesPartie['pBD']*100)."%";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='background-color: #e2efda; text-align: center; '>".($rowDonneesPartie['pBDD']*100)."%";
                echo "<td style='  text-align: center;' colspan='2'>".($rowDonneesPartie['pB']*100)."%";
                //echo "<td style=' '>&nbsp;</td>";

              echo "</tr>";

              /* ******* */
              /* Ligne Separation  */
              /* ******* */

              echo "<tr style=''>";
                echo "<td style=' '>&nbsp;</td>";
                echo "<td style=' '>&nbsp;</td>";
                echo "<td style=' '>&nbsp;</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style=' '>&nbsp;</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style=' '>&nbsp;</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style=' '>&nbsp;</td>";
                echo "<td style=' '>&nbsp;</td>";
                echo "<td style=' '>&nbsp;</td>";
              echo "</tr>";

              /* ******* */
              /* SYNTHESE PAR QUART  */
              /* ******* */
              echo "<tr style=''>";
                echo "<td style=' '>&nbsp;</td>";
                echo "<td style=' '>&nbsp;</td>";
                echo "<td style='  text-align: center;'>Ext G</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='  text-align: center;'>Centre G</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='  text-align: center;'>Centre D</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='  text-align: center;'>Ext D</td>";
                echo "<td style=' '>&nbsp;</td>";
                echo "<td style=' '>&nbsp;</td>";
              echo "</tr>";
                          /* ******* */
                          /* LIGNE IMPACT  */
                          /* ******* */
              echo "<tr style=''>";
                echo "<td style=' '>&nbsp;</td>";
                echo "<td style=' '>&nbsp;</td>";
                echo "<td style='  text-align: center;'>&nbsp;<b style='color:red'>".$rowDonneesPartie['NbExtG']." impact(s)</b>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='  text-align: center;'>&nbsp;<b style='color:red'>".$rowDonneesPartie['NbCentreG']." impact(s)</b>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='  text-align: center;'>&nbsp;<b style='color:red'>".$rowDonneesPartie['NbCentreD']." impact(s)</b>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='  text-align: center;'>&nbsp;<b style='color:red'>".$rowDonneesPartie['NbExtD']." impact(s)</b>";
                echo "<td style=' '>&nbsp;</td>";
                echo "<td style=' '>&nbsp;</td>";
              echo "</tr>";
                          /* ******* */
                          /* LIGNE POURCENTAGE  */
                          /* ******* */
              echo "<tr style=''>";
                echo "<td style=' '>&nbsp;</td>";
                echo "<td style=' '>&nbsp;</td>";
                echo "<td style='  text-align: center;'>".($rowDonneesPartie['pExtG']*100)."%";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='  text-align: center;'>".($rowDonneesPartie['pCG']*100)."%";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='  text-align: center;'>".($rowDonneesPartie['pCD']*100)."%";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='  text-align: center;'>".($rowDonneesPartie['pExtD']*100)."%";
                echo "<td style=' '>&nbsp;</td>";
                echo "<td style=' '>&nbsp;</td>";
              echo "</tr>";

              echo "<tr style=''>";
                echo "<td style=' '>&nbsp;</td>";
                echo "<td style=' '>&nbsp;</td>";
                echo "<td style=' '>&nbsp;</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style=' '>&nbsp;</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style=' '>&nbsp;</td>";
                echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style=' '>&nbsp;</td>";
                echo "<td style=' '>&nbsp;</td>";
                echo "<td style=' '>&nbsp;</td>";
              echo "</tr>";
              /* ******* */
              /* SYNTHESE PAR DEMI  */
              /* ******* */
              echo "<tr style=''>";
                echo "<td style=' '>&nbsp;</td>";
                echo "<td style='  text-align: right;'>D Moy : </td>";
                echo "<td style='  text-align: left;'><a href='StatDistancePartie.php?IdJ=".$IdJ."&IdP=".$IdP."'>".$rowDonneesPartie['dmoy']." m</a></td>";
                //echo "<td style='  text-align: center;' colspan='1'>&nbsp;&nbsp;<strong>Gauche</strong></td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='  text-align: center; background-color:#a4b780;color: red ;' <b >GAUCHE</b></td>";
                echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='  text-align: center; background-color:#a4b780; color: blue ;' ><strong>DROITE</strong></td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                //echo "<td style='  text-align: center;' colspan='1'>&nbsp;&nbsp;<strong>Droite</strong></td>";
                echo "<td style='  text-align: right';><a href='StatDistancePartie.php?IdJ=".$IdJ."&IdP=".$IdP."'>".$rowDonneesPartie['FMoy']." g</a></td>";
                echo "<td style='  text-align: left'>: F moy</td>";
                echo "<td style=' '>&nbsp;</td>";
              echo "</tr>";
                          /* ******* */
                          /* LIGNE IMPACT  */
                          /* ******* */
              echo "<tr style=''>";
                echo "<td style=' '>&nbsp;</td>";
                echo "<td style='  text-align: right;'>D Min :</td>";
                echo "<td style='  text-align: left;'><a href='StatDistancePartie.php?IdJ=".$IdJ."&IdP=".$IdP."'>".$rowDonneesPartie['dmin']." m</a></td>";
                //echo "<td style='  text-align: center;' colspan='1'>&nbsp;&nbsp;<b style='color:red'>".$rowDonneesPartie['NbGauche'];
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='  text-align: center;' colspan='1'>&nbsp;&nbsp;<b style='color:red'>".$rowDonneesPartie['NbGauche']." impact(s)</b>";
                echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='  text-align: center;' colspan='1'>&nbsp;&nbsp;<b style='color:red'>".$rowDonneesPartie['NbDroite']." impact(s)</b>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                //echo "<td style='  text-align: center;' colspan='1'>&nbsp;&nbsp;Nb Impact :  ".$rowDonneesPartie['NbDroite'];
                echo "<td style='  text-align: right;'><a href='StatDistancePartie.php?IdJ=".$IdJ."&IdP=".$IdP."'>".$rowDonneesPartie['Fmin']." g</a></td>";
                echo "<td style='  text-align: left;'>: F min</td>";
                echo "<td style=' '>&nbsp;</td>";
              echo "</tr>";
                          /* ******* */
                          /* LIGNE POURCENTAGE  */
                          /* ******* */
              echo "<tr style=''>";
                echo "<td style=' '>&nbsp;</td>";
                echo "<td style=' text-align: right;'>D Max :</td>";
                echo "<td style='  text-align: left;'><a href='StatDistancePartie.php?IdJ=".$IdJ."&IdP=".$IdP."'>".$rowDonneesPartie['dMax']." m</a></td>";
                //echo "<td style='  text-align: center;' colspan='1'>".($rowDonneesPartie['pG']*100)."%";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='  text-align: center;' colspan='1'>".($rowDonneesPartie['pG']*100)."%";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='  text-align: center;' colspan='1'>".($rowDonneesPartie['pD']*100)."%";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                //echo "<td style='  text-align: center;' colspan='1'>".($rowDonneesPartie['pD']*100)."%";
                echo "<td style='  text-align: right;'><a href='StatDistancePartie.php?IdJ=".$IdJ."&IdP=".$IdP."'>".$rowDonneesPartie['FMax']." g</a></td>";
                echo "<td style='  text-align: left;'>: F Max</td>";
                echo "<td style=' '>&nbsp;</td>";
              echo "</tr>";

              echo "<tr style=''>";
                echo "<td style=' '>&nbsp;</td>";
                echo "<td style=' '>&nbsp;</td>";
                echo "<td style=' '>&nbsp;</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style=' '>&nbsp;</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style=' '>&nbsp;</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style=' '>&nbsp;</td>";
                echo "<td style=' '>&nbsp;</td>";
                echo "<td style=' '>&nbsp;</td>";
              echo "</tr>";

              echo "<tr style=''>";
                echo "<td style=' '>&nbsp;</td>";
                echo "<td style=' '>&nbsp;</td>";
                // echo "<td style=' '>&nbsp;</td>";
                //   echo "<td style='width: 0.1%; text-align: center;'></td>";

                if ($rowDonneesPartie['NbDroite'] > $rowDonneesPartie['NbGauche'] ) {

                  echo "<td colspan='7'><b style='color:red'>ATTENTION vos statistiques montrent que vous impactez plus a droite</b></td>";

                }
                else {
                    echo "<td colspan='7'>&nbsp;</td>";
                }


                echo "<td colspan='2' style='font-size: 18px;'><a href='ResultatChronoPartie.php?IdJ=".$IdJ."&IdP=".$IdP."'>Chrono Partie ".$IdP."</a></td>";
              echo "</tr>";

              echo "<tr style=''>";
                echo "<td style=' '>&nbsp;</td>";
                echo "<td style=' '>&nbsp;</td>";
                echo "<td style=' '>&nbsp;</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";

                  if ($rowDonneesPartie['NbDroite'] > $rowDonneesPartie['NbGauche'] ) {

                    echo "<td colspan='5'><b style='color:red'>ET la majorité des joueurs sont droitiers ...</b></td>";

                  }
                  else {
                    echo "<td colspan='5'>&nbsp;</td>";
                  }
              echo "<td style=' '>&nbsp;</td>";
              echo "<td style=' '>&nbsp;</td>";
              echo "</tr>";


              echo "</table>";
              echo "</tbody>";
              echo "<br>";
              echo "</div>";
              //echo "<div id='chart_div' style='width: 900px; height: 500px;'></div>";
                // echo "<hr size='5'color='green'>";
                // echo "<hr size='5'color='green'>";



            }


//$Dmin = 3;
//$c1 = 0.4;
//$c2 = 0.15;
?>
