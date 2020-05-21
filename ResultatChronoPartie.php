<?php
include 'MenuDev.php';  // Ok.
include 'MenuIPassBall.php';  // Ok.
?>
<?php

/* Variables passées en prametres dans l'url*/
$IdP = $_GET["IdP"];
$IdJ = $_GET["IdJ"];


echo "IdPartie = ".$IdP." & IdJoueur = ".$IdJ."<br>";
echo "<a href='SynthesePartie.php?IdJ=".$IdP."&IdP=".$IdJ."'>Synthese  de la Partie n°".$IdP." Par ".$IdJ."</a>";

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
$Joueur = $rowJoueur['NomJoueur']." ".$rowJoueur['PrenomJoueur'];

$rowParametresPartie= $reponseParametresPartie->fetchArray();


?>

<h1><p>Chronologie de la partie du <?php echo $rowParametresPartie['DatePartie']?> de <b><?php echo $Joueur; ?> </b></p></h1>
<p><u>Paramètres de la partie :</u>
Dur&eacute;e : <?php echo $rowParametresPartie['DureePartie'].' secondes' ?> /
Dmin : <?php echo $rowParametresPartie['DminPartie'].' Mètre' ?> /
c1: <?php echo $rowParametresPartie['c1Partie'] ?> /
c2 : <?php echo $rowParametresPartie['c2Partie'] ?></p>


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

              echo "<table style='width: 92%; border-collapse: collapse; height: 180px; border-color: transparent';'' border='1'>";
              echo "<tbody>";
              /* ******* */
              /* DEBUT ENTETE */
              /* ******* */
              echo "<tr style='height: 18px;'>";
                echo "<td style='width: 8%; height: 18px; border-color: transparent';><b>Impact N°".$rowDonneesPartie['NbImp']." à ".$rowDonneesPartie['Dist']." mètres</b></td>";
                $PointMarques = $rowDonneesPartie['Score'] - $ScorePrecedent;
                echo "<td style='width: 8%; height: 18px;'>+ ".$PointMarques." Points</td>";
                echo "<td style='width: 8%; height: 18px;'><b>Code Joueur : ".$rowJoueur['CodeJoueur']."</b></td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: 8%; height: 18px;'><b>SCORE = ".$rowDonneesPartie['Score']."</b></td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: 8%; height: 18px;'></td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: 8%; height: 18px;'><b>TEMPS : ".$rowDonneesPartie['Tps']."</b></td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
              echo "</tr>";
              /* ******* */
              /* FIN ENTETE */
              /* ******* */
              echo "<tr style='height: 18px;'>";
                echo "<td style='width: 8%; height: 18px;'>Après ".$rowDonneesPartie['DTps']." s du précédent impact</td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
              echo "</tr>";
              /* ******* */
              /* Cible HAUTES  */
              /* ******* */
              echo "<tr style='height: 100px;'>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='background-color: #f8cbad; width: 8%; text-align: center;'>";
                if ($bHGG == TRUE) {
                  echo " <span style='color: #ff0000;'><img src='Images/BallonFootTransparent100px.png' alt='TOUCHE !''></span></td>";
                } else {
                  echo "<h1>1</h1></td>";
                }
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='background-color: #f2b084; width: 8%; text-align: center; '>";
                if ($bHG == TRUE) {
                  echo " <span style='color: #ff0000;'><img src='Images/BallonFootTransparent100px.png' alt='TOUCHE !''></span></td>";
                } else {
                  echo "<h1>2</h1></td>";
                }
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='background-color: #f2b084; width: 8%; text-align: center;''>";
                if ($bHD == TRUE) {
                  echo " <span style='color: #ff0000;'><img src='Images/BallonFootTransparent100px.png' alt='TOUCHE !''></span></td>";
                } else {
                  echo "<h1>2</h1></td>";
                }
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='background-color: #f8cbad; width: 8%; text-align: center;'>";
                if ($bHDD == TRUE) {
                  echo " <span style='color: #ff0000;'><img src='Images/BallonFootTransparent100px.png' alt='TOUCHE !''></span></td>";
                } else {
                  echo "<h1>1</h1></td>";
                }
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: 8%; height: 18px; text-align: center;'><strong>HAUT</strong></td>";
              echo "</tr>";
                          /* ******* */
                          /* LIGNE IMPACT  */
                          /* ******* */
              echo "<tr style='height: 18px;'>";
              echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
              echo "<td style='width: 8%; height: 18px;'></td>";
              echo "<td style='background-color: #f8cbad; text-align: center; width: 8%;'>Nb Impact :  ".$rowDonneesPartie['NbHGG']."</td>";
                echo "<td style='width: 0.1%; text-align: center;'></td>";
              echo "<td style='background-color: #f2b084; text-align: center; width: 8%;'>Nb Impact :  ".$rowDonneesPartie['NbHG']."</td>";
                echo "<td style='width: 0.1%; text-align: center;'></td>";
              echo "<td style='background-color: #f2b084; text-align: center; width: 8%;'>Nb Impact :  ".$rowDonneesPartie['NbHD']."</td>";
                echo "<td style='width: 0.1%; text-align: center;'></td>";
              echo "<td style='background-color: #f8cbad; text-align: center; width: 8%;'>Nb Impact :  ".$rowDonneesPartie['NbHDD']."</td>";
              echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
              echo "<td style='width: 8%; height: 18px; text-align: center;'>Nb Impact :  ".$rowDonneesPartie['NbHaut']."</td>";
              echo "</tr>";
                            /* ******* */
                            /* LIGNE POURCENTAGE  */
                            /* ******* */
              echo "<tr style='height: 18px;'>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='background-color: #f8cbad; text-align: center; width: 8%;'>".(100*$rowDonneesPartie['pHGG'])."%</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='background-color: #f2b084; text-align: center; width: 8%;'>".(100*$rowDonneesPartie['pHG'])."%</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='background-color: #f2b084; text-align: center; width: 8%;'>".(100*$rowDonneesPartie['pHD'])."%</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='background-color: #f8cbad; text-align: center; width: 8%;'>".(100*$rowDonneesPartie['pHDD'])."%</td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: 8%; height: 18px; text-align: center;'>".(100*$rowDonneesPartie['pH'])."%</td>";
              echo "</tr>";
              /* ******* */
              /* Cible BASSES  */
              /* ******* */
              echo "<tr style='height: 100px;'>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='background-color: #e2efda; width: 8%; text-align: center;'>";
                if ($bBGG == TRUE) {
                  echo " <span style='color: #ff0000;'><img src='Images/BallonFootTransparent100px.png' alt='TOUCHE !''></span></td>";
                } else {
                  echo "<h1>3</h1></td>";
                }
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='background-color: #a9d08e; width: 8%; text-align: center;'>";
                if ($bBG == TRUE) {
                  echo " <span style='color: #ff0000;'><img src='Images/BallonFootTransparent100px.png' alt='TOUCHE !''></span></td>";
                } else {
                  echo "<h1>5</h1></td>";
                }
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='background-color: #a9d08e; width: 8%; text-align: center;'>";
                if ($bBD == TRUE) {
                  echo " <span style='color: #ff0000;'><img src='Images/BallonFootTransparent100px.png' alt='TOUCHE !''></span></td>";
                } else {
                  echo "<h1>5</h1></td>";
                }
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='background-color: #e2efda; width: 8%; text-align: center;'>";
                if ($bBDD == TRUE) {
                  echo " <span style='color: #ff0000;'><img src='Images/BallonFootTransparent100px.png' alt='TOUCHE !''></span></td>";
                } else {
                  echo "<h1>3</h1></td>";
                }
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: 8%; height: 18px; text-align: center;'><strong>BAS</strong></td>";
              echo "</tr>";

                          /* ******* */
                          /* LIGNE IMPACT  */
                          /* ******* */
              echo "<tr style='height: 18px;'>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='background-color: #e2efda; text-align: center; width: 8%;'>Nb Impact :  ".$rowDonneesPartie['NbBGG']."</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='background-color: #a9d08e; text-align: center; width: 8%;'>Nb Impact :  ".$rowDonneesPartie['NbBG']."</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='background-color: #a9d08e; text-align: center; width: 8%;'>Nb Impact :  ".$rowDonneesPartie['NbBD']."</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='background-color: #e2efda; text-align: center; width: 8%;'>Nb Impact :  ".$rowDonneesPartie['NbBDD']."</td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: 8%; height: 18px; text-align: center;'>&nbsp;Nb Impact :  ".$rowDonneesPartie['NbBas']."</td>";
              echo "</tr>";
                          /* ******* */
                          /* LIGNE POURCENTAGE  */
                          /* ******* */
              echo "<tr style='height: 18px;'>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='background-color: #e2efda; text-align: center; width: 8%;'>".(100*$rowDonneesPartie['pBGG'])."%</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='background-color: #a9d08e; text-align: center; width: 8%;'>".(100*$rowDonneesPartie['pBG'])."%</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='background-color: #a9d08e; text-align: center; width: 8%;'>".(100*$rowDonneesPartie['pBD'])."%</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='background-color: #e2efda; text-align: center; width: 8%;'>".(100*$rowDonneesPartie['pBDD'])."%</td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: 8%; height: 18px; text-align: center;'>".(100*$rowDonneesPartie['pB'])."%</td>";
              echo "</tr>";

              echo "<tr style='height: 18px;'>";
                  echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                  echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                  echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                    echo "<td style='width: 0.1%; text-align: center;'></td>";
                  echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                    echo "<td style='width: 0.1%; text-align: center;'></td>";
                  echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                    echo "<td style='width: 0.1%; text-align: center;'></td>";
                  echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                  echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                  echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
              echo "</tr>";
              /* ******* */
              /* SYNTHESE PAR QUART  */
              /* ******* */
              echo "<tr style='height: 18px;'>";
                echo "<td style='width: 8%; height: 18px;'>Force moyenne : ".$rowDonneesPartie['FMoy']."</td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: 8%; height: 18px; text-align: center;'>Ext G</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: 8%; height: 18px; text-align: center;'>Centre G</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: 8%; height: 18px; text-align: center;'>Centre D</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: 8%; height: 18px; text-align: center;'>Ext D</td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
              echo "</tr>";
                          /* ******* */
                          /* LIGNE IMPACT  */
                          /* ******* */
              echo "<tr style='height: 18px;'>";
                echo "<td style='width: 8%; height: 18px;'>Force min : ".$rowDonneesPartie['Fmin']."</td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: 8%; height: 18px; text-align: center;'>&nbsp;Nb Impact :  ".$rowDonneesPartie['NbExtG']."</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: 8%; height: 18px; text-align: center;'>&nbsp;Nb Impact :  ".$rowDonneesPartie['NbCentreG']."</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: 8%; height: 18px; text-align: center;'>&nbsp;Nb Impact :  ".$rowDonneesPartie['NbCentreD']."</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: 8%; height: 18px; text-align: center;'>&nbsp;Nb Impact :  ".$rowDonneesPartie['NbExtD']."</td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
              echo "</tr>";
                          /* ******* */
                          /* LIGNE POURCENTAGE  */
                          /* ******* */
              echo "<tr style='height: 18px;'>";
                echo "<td style='width: 8%; height: 18px;'>Force Max : ".$rowDonneesPartie['FMax']."</td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: 8%; height: 18px; text-align: center;'>".(100*$rowDonneesPartie['pExtG'])."%</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: 8%; height: 18px; text-align: center;'>".(100*$rowDonneesPartie['pCG'])."%</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: 8%; height: 18px; text-align: center;'>".(100*$rowDonneesPartie['pCD'])."%</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: 8%; height: 18px; text-align: center;'>".(100*$rowDonneesPartie['pExtD'])."%</td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
              echo "</tr>";

              echo "<tr style='height: 18px;'>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
              echo "</tr>";
              /* ******* */
              /* SYNTHESE PAR DEMI  */
              /* ******* */
              echo "<tr style='height: 18px;'>";
                echo "<td style='width: 8%; height: 18px;'>D moyenne : ".$rowDonneesPartie['dmoy']." mètres</td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: 8%; height: 18px; text-align: center;' colspan='1'>&nbsp;&nbsp;<strong>Gauche</strong></td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: 8%; height: 18px; text-align: center;' colspan='1'>&nbsp;&nbsp;<strong>Droite</strong></td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
              echo "</tr>";
                          /* ******* */
                          /* LIGNE IMPACT  */
                          /* ******* */
              echo "<tr style='height: 18px;'>";
                echo "<td style='width: 8%; height: 18px;'>D min : ".$rowDonneesPartie['dmin']." mètres</td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: 8%; height: 18px; text-align: center;' colspan='1'>&nbsp;&nbsp;Nb Impact :  ".$rowDonneesPartie['NbGauche']."</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: 8%; height: 18px; text-align: center;' colspan='1'>&nbsp;&nbsp;Nb Impact :  ".$rowDonneesPartie['NbDroite']."</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
              echo "</tr>";
                          /* ******* */
                          /* LIGNE POURCENTAGE  */
                          /* ******* */
              echo "<tr style='height: 18px;'>";
                echo "<td style='width: 8%; height: 18px;'>D Max : ".$rowDonneesPartie['dMax']." mètres</td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: 8%; height: 18px; text-align: center;' colspan='1'>".(100*$rowDonneesPartie['pG'])."%</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: 8%; height: 18px; text-align: center;' colspan='1'>".(100*$rowDonneesPartie['pD'])."%</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
              echo "</tr>";

              echo "<tr style='height: 18px;'>";
                echo "<td style='width: 8%; height: 18px;'></td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
              echo "</tr>";

              echo "<tr style='height: 18px;'>";
                echo "<td style='width: 8%; height: 18px;'><a href='SynthesePartie.php?IdJ=".$IdP."&IdP=".$IdJ."'>Synthese  de la Partie n°".$IdP." Par ".$IdJ."</a></td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
              echo "</tr>";

              echo "</table>";
              echo "</tbody>";

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
