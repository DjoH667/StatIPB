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
$NomJ=substr($rowJoueur['NomJoueur'], 0, 3);
$Joueur = $rowJoueur['PrenomJoueur']." ".$NomJ;

$rowParametresPartie= $reponseParametresPartie->fetchArray();

if ($rowParametresPartie['DureePartie'] > 60 ) {

   $DureePartie = $rowParametresPartie['DureePartie']/60;
   $StringDureePartie = $DureePartie." Minute(s)";
}
else {
  $DureePartie = $rowParametresPartie['DureePartie'];
  $StringDureePartie = $DureePartie." Secondes";
}

$Dnominal = $rowParametresPartie['DminPartie']/100;

list($Annee, $Mois, $Jour) = explode('-',$rowParametresPartie['DatePartie']);


//echo "IdPartie = ".$IdP." & IdJoueur = ".$IdJ."<br>";
echo "<a href='SynthesePartie.php?IdJ=".$IdJ."&IdP=".$IdP."'>Synthese  de la Partie n°".$IdP." Par ".$Joueur."</a>";

?>

<h1><p>Chrono Partie n° <?php echo $IdP ?> du <?php echo $Jour.'/'.$Mois.'/'.$Annee  ?> par <b><?php echo $Joueur; ?> </b></p></h1>
<h2>
Dur&eacute;e : <?php echo $StringDureePartie ?> /
Distance nominale : <?php echo $Dnominal.' Mètres' ?> /
c1: <?php echo $rowParametresPartie['c1Partie'] ?> /
c2 : <?php echo $rowParametresPartie['c2Partie'] ?></h2>


<hr size='5'color='green'>
<?php

$ScorePrecedent = 0;




while ($rowDonneesPartie = $reponseDonneesPartie->fetchArray()) {


              switch ($rowDonneesPartie['Cible']) {
                  case "HDD":
                      $bHDD  = True;
                      break;
                  case "BDD":
                      $bBDD = True;
                      break;
                  case "HD":
                      $bHD = True;
                      break;
                  case "BD":
                      $bBD = True;
                      break;
                  case "HG":
                      $bHG = True;
                      break;
                  case "BG":
                      $bBG = True;
                      break;
                  case "HGG":
                      $bHGG = True;
                      break;
                  case "BGG":
                      $bBGG = True;
                      break;
              }
              echo "<div align='center'>";
              echo "<table style='width: 1000px; border-collapse: collapse; height: 180px; border-color: black';'' border='0'>";
              //echo "<table style='width: 92%; border-collapse: collapse; height: 180px; border-color: transparent'; border='1'>";
              echo "<tbody>";
              /* ******* */
              /* DEBUT ENTETE */
              /* ******* */
              echo "<tr style='height: 10px;'>";
                echo "<td style='width: 8%; '><b>P".$IdP."<b></td>";
                echo "<td style='width: 8%; '></td>";

                echo "<td style='width: 100px; '></td>";
                  echo "<td style='width: 0.1%; '></td>";
                echo "<td style='width: 100px; '></td>";
                  echo "<td style='width: 0.1%; '></td>";
                  echo "<td style='width: 100px; '></td>";
                    echo "<td style='width: 0.1%; '></td>";
                  echo "<td style='width: 100px; '></td>";

                 echo "<td style='width: 8%; '></td>";
                 echo "<td style='width: 8%; '></td>";
              echo "</tr>";

              echo "<tr style='height: 18px;'>";
                echo "<td style='width: ; height: 18px;text-align: right;'>Imp N°</td>";
                $PointMarques = $rowDonneesPartie['Score'] - $ScorePrecedent;
                echo "<td style='width: ; height: 18px;'><b style='color:red'>".$rowDonneesPartie['NbImp']."</b></td>";

                echo "<td style='width: ; height: 18px; border-color: transparent';><b style='color:red'>> à ".$rowDonneesPartie['Dist']." mètres</b></td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: ; height: 18px;'><b style='color:red'>> + ".$PointMarques." Points</b></td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td colspan='3' ><b style='color:red'>>>Après ".$rowDonneesPartie['DTps']." s précédent Imp(act)</b></td>";
                // echo "<td style='width: 100px; '></td>";
                //   echo "<td style='width: 0.1%; '></td>";
                // echo "<td style='width: 100px; '></td>";

                echo "<td style='width: ; '></td>";
                echo "<td style='width: ; '></td>";

              echo "</tr>";

              echo "<tr style='height: 18px;'>";
                echo "<td style='width: ; height: 18px;'></td>";
                echo "<td style='width: ; height: 18px;'></td>";

                //echo "<td style='width: ; height: 18px;'><b>Code Joueur : ".$rowJoueur['CodeJoueur']."</b></td>";
                echo "<td style='width: ; height: 18px;'><b>".$rowJoueur['CodeJoueur']."</b></td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: ; height: 18px;'><b>SCORE = ".$rowDonneesPartie['Score']."</b></td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: ; height: 18px;'></td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                //echo "<td style='width: ; height: 18px;'><b>TEMPS : ".$rowDonneesPartie['Tps']." s</b></td>";
                echo "<td style='width: ; height: 18px;'><b>Tps : ".$rowDonneesPartie['Tps']." s</b></td>";

                echo "<td style='width: ; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: ; height: 18px;'>&nbsp;</td>";
              echo "</tr>";
              /* ******* */
              /* FIN ENTETE */
              /* ******* */
              echo "<tr style='height: 18px;'>";
                echo "<td style='width: ; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: ; height: 18px;'>&nbsp;</td>";

                echo "<td style='width: ; height: 18px;'>&nbsp;</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: ; height: 18px;'>&nbsp;</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: ; height: 18px;'>&nbsp;</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                // echo "<td style='width: ; height: 18px;'>&nbsp;</td>";
                //
                // echo "<td style='width: ; height: 18px;'>&nbsp;</td>";
                // echo "<td style='width: ; height: 18px;'>&nbsp;</td>";
                echo "<td colspan='3' style='text-align: right;'><a href='SynthesePartie.php?IdJ=".$IdJ."&IdP=".$IdP."'>Synthese P".$IdP." Par ".$Joueur."</a></td>";
              echo "</tr>";
              /* ******* */
              /* Cible HAUTES  */
              /* ******* */
              echo "<tr style='height: 100px;'>";
                echo "<td style='width: ; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: ; height: 18px;'>&nbsp;</td>";

                echo "<td style='background-color: #f8cbad; width: ; text-align: center;'>";
                if ($bHGG == TRUE) {
                  echo " <span style='color: #ff0000;'><img src='Images/BallonFootTransparent100px.png' alt='TOUCHE !''></span></td>";
                } else {
                  echo "<h3>1</h3></td>";
                }
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='background-color: #f2b084; width: ; text-align: center; '>";
                if ($bHG == TRUE) {
                  echo " <span style='color: #ff0000;'><img src='Images/BallonFootTransparent100px.png' alt='TOUCHE !''></span></td>";
                } else {
                  echo "<h3>2</h3></td>";
                }
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='background-color: #f2b084; width: ; text-align: center;''>";
                if ($bHD == TRUE) {
                  echo " <span style='color: #ff0000;'><img src='Images/BallonFootTransparent100px.png' alt='TOUCHE !''></span></td>";
                } else {
                  echo "<h3>2</h3></td>";
                }
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='background-color: #f8cbad; width: ; text-align: center;'>";
                if ($bHDD == TRUE) {
                  echo " <span style='color: #ff0000;'><img src='Images/BallonFootTransparent100px.png' alt='TOUCHE !''></span></td>";
                } else {
                  echo "<h3>1</h3></td>";
                }

                echo "<td style='width: ; height: 18px; text-align: center;'><strong>HAUT</strong></td>";
                echo "<td style='width: ; height: 18px;'>&nbsp;</td>";
              echo "</tr>";
                          /* ******* */
                          /* LIGNE IMPACT  */
                          /* ******* */
              echo "<tr style='height: 18px;'>";
              echo "<td style='width: ; height: 18px;'>&nbsp;</td>";

              echo "<td style='width: ; height: 18px;'></td>";
              echo "<td style='background-color: #f8cbad; text-align: center; width: ;'><b>".$rowDonneesPartie['NbHGG']." impact(s)</td>";
                echo "<td style='width: 0.1%; text-align: center;'></td>";
              echo "<td style='background-color: #f2b084; text-align: center; width: ;'><b>".$rowDonneesPartie['NbHG']." impact(s)</td>";
                echo "<td style='width: 0.1%; text-align: center;'></td>";
              echo "<td style='background-color: #f2b084; text-align: center; width: ;'><b>".$rowDonneesPartie['NbHD']." impact(s)</td>";
                echo "<td style='width: 0.1%; text-align: center;'></td>";
              echo "<td style='background-color: #f8cbad; text-align: center; width: ;'><b>".$rowDonneesPartie['NbHDD']." impact(s)</td>";

              echo "<td style='width: ; height: 18px; text-align: center;'><b>".$rowDonneesPartie['NbHaut']." impact(s)</td>";
              echo "<td style='width: ; height: 18px;'>&nbsp;</td>";
              echo "</tr>";
                            /* ******* */
                            /* LIGNE POURCENTAGE  */
                            /* ******* */
              echo "<tr style='height: 18px;'>";
                echo "<td style='width: ; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: ; height: 18px;'>&nbsp;</td>";

                echo "<td style='background-color: #f8cbad; text-align: center; width: ;'>".(100*$rowDonneesPartie['pHGG'])."%</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='background-color: #f2b084; text-align: center; width: ;'>".(100*$rowDonneesPartie['pHG'])."%</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='background-color: #f2b084; text-align: center; width: ;'>".(100*$rowDonneesPartie['pHD'])."%</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='background-color: #f8cbad; text-align: center; width: ;'>".(100*$rowDonneesPartie['pHDD'])."%</td>";

                echo "<td style='width: ; height: 18px; text-align: center;'>".(100*$rowDonneesPartie['pH'])."%</td>";
                echo "<td style='width: ; height: 18px;'>&nbsp;</td>";
              echo "</tr>";
              /* ******* */
              /* Cible BASSES  */
              /* ******* */
              echo "<tr style='height: 100px;'>";
                echo "<td style='width: ; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: ; height: 18px;'>&nbsp;</td>";

                echo "<td style='background-color: #e2efda; width: ; text-align: center;'>";
                if ($bBGG == TRUE) {
                  echo " <span style='color: #ff0000;'><img src='Images/BallonFootTransparent100px.png' alt='TOUCHE !''></span></td>";
                } else {
                  echo "<h3>3</h3></td>";
                }
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='background-color: #a9d08e; width: ; text-align: center;'>";
                if ($bBG == TRUE) {
                  echo " <span style='color: #ff0000;'><img src='Images/BallonFootTransparent100px.png' alt='TOUCHE !''></span></td>";
                } else {
                  echo "<h3>5</h3></td>";
                }
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='background-color: #a9d08e; width: ; text-align: center;'>";
                if ($bBD == TRUE) {
                  echo " <span style='color: #ff0000;'><img src='Images/BallonFootTransparent100px.png' alt='TOUCHE !''></span></td>";
                } else {
                  echo "<h3>5</h3></td>";
                }
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='background-color: #e2efda; width: ; text-align: center;'>";
                if ($bBDD == TRUE) {
                  echo " <span style='color: #ff0000;'><img src='Images/BallonFootTransparent100px.png' alt='TOUCHE !''></span></td>";
                } else {
                  echo "<h3>3</h3></td>";
                }

                echo "<td style='width: ; height: 18px; text-align: center;'><strong>BAS</strong></td>";
                echo "<td style='width: ; height: 18px;'>&nbsp;</td>";
              echo "</tr>";

                          /* ******* */
                          /* LIGNE IMPACT  */
                          /* ******* */
              echo "<tr style='height: 18px;'>";
                echo "<td style='width: ; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: ; height: 18px;'>&nbsp;</td>";

                echo "<td style='background-color: #e2efda; text-align: center; width: ;'><b>".$rowDonneesPartie['NbBGG']." impact(s)</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='background-color: #a9d08e; text-align: center; width: ;'><b>".$rowDonneesPartie['NbBG']." impact(s)</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='background-color: #a9d08e; text-align: center; width: ;'><b>".$rowDonneesPartie['NbBD']." impact(s)</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='background-color: #e2efda; text-align: center; width: ;'><b>".$rowDonneesPartie['NbBDD']." impact(s)</td>";

                echo "<td style='width: ; height: 18px; text-align: center;'><b>".$rowDonneesPartie['NbBas']." impact(s)</td>";
                echo "<td style='width: ; height: 18px;'>&nbsp;</td>";
              echo "</tr>";
                          /* ******* */
                          /* LIGNE POURCENTAGE  */
                          /* ******* */
              echo "<tr style='height: 18px;'>";
                echo "<td style='width: ; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: ; height: 18px;'>&nbsp;</td>";

                echo "<td style='background-color: #e2efda; text-align: center; width: ;'>".(100*$rowDonneesPartie['pBGG'])."%</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='background-color: #a9d08e; text-align: center; width: ;'>".(100*$rowDonneesPartie['pBG'])."%</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='background-color: #a9d08e; text-align: center; width: ;'>".(100*$rowDonneesPartie['pBD'])."%</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='background-color: #e2efda; text-align: center; width: ;'>".(100*$rowDonneesPartie['pBDD'])."%</td>";

                echo "<td style='width: ; height: 18px; text-align: center;'>".(100*$rowDonneesPartie['pB'])."%</td>";
                echo "<td style='width: ; height: 18px;'>&nbsp;</td>";
              echo "</tr>";

              echo "<tr style='height: 18px;'>";
                  echo "<td style='width: ; height: 18px;'>&nbsp;</td>";
                  echo "<td style='width: ; height: 18px;'>&nbsp;</td>";

                  echo "<td style='width: ; height: 18px;'>&nbsp;</td>";
                    echo "<td style='width: 0.1%; text-align: center;'></td>";
                  echo "<td style='width: ; height: 18px;'>&nbsp;</td>";
                    echo "<td style='width: 0.1%; text-align: center;'></td>";
                  echo "<td style='width: ; height: 18px;'>&nbsp;</td>";
                    echo "<td style='width: 0.1%; text-align: center;'></td>";
                  echo "<td style='width: ; height: 18px;'>&nbsp;</td>";

                  echo "<td style='width: ; height: 18px;'>&nbsp;</td>";
                  echo "<td style='width: ; height: 18px;'>&nbsp;</td>";
              echo "</tr>";
              /* ******* */
              /* SYNTHESE PAR QUART  */
              /* ******* */
              echo "<tr style='height: 18px;'>";
                echo "<td style='width: ; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: ; height: 18px;'>&nbsp;</td>";

                echo "<td style='width: ; height: 18px; text-align: center;'>Ext G</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: ; height: 18px; text-align: center;'>Centre G</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: ; height: 18px; text-align: center;'>Centre D</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: ; height: 18px; text-align: center;'>Ext D</td>";

                echo "<td style='width: ; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: ; height: 18px;'>&nbsp;</td>";
              echo "</tr>";
                          /* ******* */
                          /* LIGNE IMPACT  */
                          /* ******* */
              echo "<tr style='height: 18px;'>";
                  echo "<td style='width: ; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: ; height: 18px;'>&nbsp;</td>";

                echo "<td style='width: ; height: 18px; text-align: center;'><b>".$rowDonneesPartie['NbExtG']." impact(s)</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: ; height: 18px; text-align: center;'><b>".$rowDonneesPartie['NbCentreG']." impact(s)</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: ; height: 18px; text-align: center;'><b>".$rowDonneesPartie['NbCentreD']." impact(s)</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: ; height: 18px; text-align: center;'><b>".$rowDonneesPartie['NbExtD']." impact(s)</td>";

                echo "<td style='width: ; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: ; height: 18px;'>&nbsp;</td>";
              echo "</tr>";
                          /* ******* */
                          /* LIGNE POURCENTAGE  */
                          /* ******* */
              echo "<tr style='height: 18px;'>";
                echo "<td style='width: ; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: ; height: 18px;'>&nbsp;</td>";

                echo "<td style='width: ; height: 18px; text-align: center;'>".(100*$rowDonneesPartie['pExtG'])."%</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: ; height: 18px; text-align: center;'>".(100*$rowDonneesPartie['pCG'])."%</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: ; height: 18px; text-align: center;'>".(100*$rowDonneesPartie['pCD'])."%</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: ; height: 18px; text-align: center;'>".(100*$rowDonneesPartie['pExtD'])."%</td>";

                echo "<td style='width: ; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: ; height: 18px;'>&nbsp;</td>";
              echo "</tr>";

              echo "<tr style='height: 18px;'>";
                echo "<td style='width: ; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: ; height: 18px;'>&nbsp;</td>";

                echo "<td style='width: ; height: 18px;'>&nbsp;</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: ; height: 18px;'>&nbsp;</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: ; height: 18px;'>&nbsp;</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: ; height: 18px;'>&nbsp;</td>";

                echo "<td style='width: ; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: ; height: 18px;'>&nbsp;</td>";
              echo "</tr>";
              /* ******* */
              /* SYNTHESE PAR DEMI  */
              /* ******* */
              echo "<tr style='height: 18px;'>";
                echo "<td style='width: ; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: ; height: 18px;text-align: right;'>D moy :</td>";

                echo "<td style='width: ; height: 18px; text-align: left;'>".$rowDonneesPartie['dmoy']." mètres</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: ; height: 18px; text-align: center;' colspan='1'>&nbsp;&nbsp;<strong>Gauche</strong></td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: ; height: 18px; text-align: center;' colspan='1'>&nbsp;&nbsp;<strong>Droite</strong></td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: ; height: 18px; text-align: right;'>".$rowDonneesPartie['FMoy']." g</td>";

                echo "<td style='width: ; height: 18px;'text-align: left;> : F moy</td>";
                echo "<td style='width: ; height: 18px;'>&nbsp;</td>";
              echo "</tr>";
                          /* ******* */
                          /* LIGNE IMPACT  */
                          /* ******* */
              echo "<tr style='height: 18px;'>";
                echo "<td style='width: ; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: ; height: 18px;text-align: right;'>D min :</td>";

                echo "<td style='width: ; height: 18px; text-align: left;'>".$rowDonneesPartie['dmin']." mètres</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: ; height: 18px; text-align: center;' colspan='1'><b>".$rowDonneesPartie['NbGauche']." impact(s)</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: ; height: 18px; text-align: center;' colspan='1'><b>".$rowDonneesPartie['NbDroite']." impact(s)</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: ; height: 18px; text-align: right;'>".$rowDonneesPartie['Fmin']." g </td>";

                echo "<td style='width: ; height: 18px;'text-align: left;> : F min</td>";
                echo "<td style='width: ; height: 18px;'>&nbsp;</td>";
              echo "</tr>";
                          /* ******* */
                          /* LIGNE POURCENTAGE  */
                          /* ******* */
              echo "<tr style='height: 18px;'>";
                echo "<td style='width: ; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: ; height: 18px;text-align: right;'>D Max :</td>";

                echo "<td style='width: ; height: 18px; text-align: left;'>".$rowDonneesPartie['dMax']." mètres</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: ; height: 18px; text-align: center;' colspan='1'>".(100*$rowDonneesPartie['pG'])."%</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: ; height: 18px; text-align: center;' colspan='1'>".(100*$rowDonneesPartie['pD'])."%</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: ; height: 18px; text-align: right;'>".$rowDonneesPartie['FMax']." g</td>";

                echo "<td style='width: ; height: 18px;'text-align: left;> : F Max</td>";
                echo "<td style='width: ; height: 18px;'>&nbsp;</td>";
              echo "</tr>";

              echo "<tr style='height: 18px;'>";
                echo "<td style='width: ; height: 18px;'></td>";
                echo "<td style='width: ; height: 18px;'>&nbsp;</td>";

                echo "<td style='width: ; height: 18px;'>&nbsp;</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: ; height: 18px;'>&nbsp;</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: ; height: 18px;'>&nbsp;</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: ; height: 18px;'>&nbsp;</td>";

                echo "<td style='width: ; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: ; height: 18px;'>&nbsp;</td>";
              echo "</tr>";

              echo "<tr style='height: 18px;'>";
                echo "<td style='width: ; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: ; height: 18px;'>&nbsp;</td>";

                echo "<td style='width: ; height: 18px;'>&nbsp;</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: ; height: 18px;'>&nbsp;</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: ; height: 18px;'>&nbsp;</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                // echo "<td style='width: ; height: 18px;'>&nbsp;</td>";

                echo "<td colspan='3' style='text-align: right;'><a href='SynthesePartie.php?IdJ=".$IdJ."&IdP=".$IdP."'>Synthese P".$IdP." Par ".$Joueur."</a></td>";
              echo "</tr>";

              echo "</tbody>";
              echo "</table>";
              echo "</div>";


              echo "<br>";
              echo "<hr size='5'color='green'>";

              $bHDD  = FALSE;
              $bBDD = FALSE;
              $bHD = FALSE;
              $bBD = FALSE;
              $bHG = FALSE;
              $bBG = FALSE;
              $bHGG = FALSE;
              $bBGG = FALSE;

              $ScorePrecedent = $rowDonneesPartie['Score'];
            }

?>
