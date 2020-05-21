<?php
include 'MenuDev.php';  // Ok.
include 'MenuIPassBall.php';  // Ok.
?>

<?php

/* Variables passées en prametres dans l'url*/
$IdP = $_GET["IdP"];
$IdJ = $_GET["IdJ"];

echo "Synthèse IdPartie = ".$IdP." & IdJoueur = ".$IdJ."<br>";
echo "<a href='ResultatChronoPartie.php?IdJ=".$IdJ."&IdP=".$IdP."'>Chronologie de la Partie n°".$IdP." Par ".$IdJ."</a>";

include 'ConnexionBDDiPassBall.php';


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


/*$ Données Joueur*/
$sqlJoueur = "SELECT * FROM Joueurs where IdJoueur='".$rowDonneesPartie['IdJoueur']."'";

$reponseJoueur = $bd->query($sqlJoueur);

if ($reponseJoueur === FALSE)
    echo "La requete Joueur a echouee pour la raison suivante: ".$err;

$rowJoueur = $reponseJoueur->fetchArray();


$Joueur = $rowJoueur['NomJoueur']." ".$rowJoueur['PrenomJoueur'];

?>


<h1><p>Synthese de la partie du <?php echo $rowParametresPartie['DatePartie']?> de <b><?php echo $Joueur; ?> </b></p></h1>
<p><u>Paramètres de la partie :</u>
Dur&eacute;e : <?php echo $rowParametresPartie['DureePartie'].' secondes' ?> /
Dmin : <?php echo $rowParametresPartie['DminPartie'].' Mètre' ?> /
c1: <?php echo $rowParametresPartie['c1Partie'] ?> /
c2 : <?php echo $rowParametresPartie['c2Partie'] ?></p>



<div id="chart_div" align="center"></div>


<hr size='5'color='green'>


<?php

$ScorePrecedent = 0;



              if ($rowDonneesPartie['MAX(NbImp)'] == "") {
                  echo "Pas de données pour cette partie";
                  echo "<hr size='5'color='green'>";
              }
              else {

              echo "<div>";
              echo "<table style='width: 92%; border-collapse: collapse; height: 180px; border-color: transparent';'' border='5'>";
              echo "<tbody>";
              /* ******* */
              /* DEBUT ENTETE */
              /* ******* */
              echo "<tr style='height: 18px;'>";
                echo "<td style='width: 8%; height: 18px; border-color: transparent';><b>".$rowDonneesPartie['MAX(NbImp)']." Impacts</b></td>";
                echo "<td style='width: 8%; height: 18px;'> </td>";

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
                echo "<td style='width: 8%; height: 18px;'> </td>";
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
                echo "<td style='background-color: #f8cbad; width: 8%; text-align: center;'>1</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='background-color: #f2b084; width: 8%; text-align: center; '>2</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='background-color: #f2b084; width: 8%; text-align: center;''>2</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='background-color: #f8cbad; width: 8%; text-align: center;'>1</td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: 8%; height: 18px; text-align: center;'><strong>HAUT</strong></td>";
              echo "</tr>";
                          /* ******* */
                          /* LIGNE IMPACT  */
                          /* ******* */
              echo "<tr style='height: 18px;'>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: 8%; height: 18px;'></td>";
                echo "<td style='background-color: #f8cbad; text-align: center; width: 8%;'>Nb Impact :  ".$rowDonneesPartie['NbHGG'];
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='background-color: #f2b084; text-align: center; width: 8%;'>Nb Impact :  ".$rowDonneesPartie['NbHG'];
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='background-color: #f2b084; text-align: center; width: 8%;'>Nb Impact :  ".$rowDonneesPartie['NbHD'];
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='background-color: #f8cbad; text-align: center; width: 8%;'>Nb Impact :  ".$rowDonneesPartie['NbHDD'];
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: 8%; height: 18px; text-align: center;'>Nb Impact :  ".$rowDonneesPartie['NbHaut'];
              echo "</tr>";
                            /* ******* */
                            /* LIGNE POURCENTAGE  */
                            /* ******* */
              echo "<tr style='height: 18px;'>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='background-color: #f8cbad; text-align: center; width: 8%;'>".($rowDonneesPartie['pHGG']*100)."%";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='background-color: #f2b084; text-align: center; width: 8%;'>".($rowDonneesPartie['pHG']*100)."%";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='background-color: #f2b084; text-align: center; width: 8%;'>".($rowDonneesPartie['pHD']*100)."%";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='background-color: #f8cbad; text-align: center; width: 8%;'>".($rowDonneesPartie['pHDD']*100)."%";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: 8%; height: 18px; text-align: center;'>".($rowDonneesPartie['pH']*100)."%";


                /* ******* */
                /* Ligne Separation  */
                /* ******* */

                echo "<tr style='height: 3px;'>";
                  echo "<td style='width: 8%; height: 3px;'></td>";
                  echo "<td style='width: 8%; height: 3px;'></td>";
                  echo "<td style='width: 8%; height: 3px;'></td>";
                    echo "<td style='width: 0.1%; text-align: center;'></td>";
                  echo "<td style='width: 8%; height: 3px;'></td>";
                    echo "<td style='width: 0.1%; text-align: center;'></td>";
                  echo "<td style='width: 8%; height: 3px;'></td>";
                    echo "<td style='width: 0.1%; text-align: center;'></td>";
                  echo "<td style='width: 8%; height: 3px;'></td>";
                  echo "<td style='width: 8%; height: 3px;'></td>";
                  echo "<td style='width: 8%; height: 3px;'></td>";
                echo "</tr>";





              echo "</tr>";
              /* ******* */
              /* Cible BASSES  */
              /* ******* */
              echo "<tr style='height: 100px;'>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='background-color: #e2efda; width: 8%; text-align: center;'>3</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='background-color: #a9d08e; width: 8%; text-align: center;'>5</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='background-color: #a9d08e; width: 8%; text-align: center;'>5</td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='background-color: #e2efda; width: 8%; text-align: center;'>3</td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: 8%; height: 18px; text-align: center;'><strong>BAS</strong></td>";
              echo "</tr>";
                          /* ******* */
                          /* LIGNE IMPACT  */
                          /* ******* */
              echo "<tr style='height: 18px;'>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='background-color: #e2efda; text-align: center; width: 8%;'>Nb Impact :  ".$rowDonneesPartie['NbBGG'];
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='background-color: #a9d08e; text-align: center; width: 8%;'>Nb Impact :  ".$rowDonneesPartie['NbBG'];
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='background-color: #a9d08e; text-align: center; width: 8%;'>Nb Impact :  ".$rowDonneesPartie['NbBD'];
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='background-color: #e2efda; text-align: center; width: 8%;'>Nb Impact :  ".$rowDonneesPartie['NbBDD'];
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: 8%; height: 18px; text-align: center;'>&nbsp;Nb Impact :  ".$rowDonneesPartie['NbBas'];
              echo "</tr>";
                          /* ******* */
                          /* LIGNE POURCENTAGE  */
                          /* ******* */
              echo "<tr style='height: 18px;'>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='background-color: #e2efda; text-align: center; width: 8%;'>".($rowDonneesPartie['pBGG']*100)."%";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='background-color: #a9d08e; text-align: center; width: 8%;'>".($rowDonneesPartie['pBG']*100)."%";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='background-color: #a9d08e; text-align: center; width: 8%;'>".($rowDonneesPartie['pBD']*100)."%";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='background-color: #e2efda; text-align: center; width: 8%;'>".($rowDonneesPartie['pBDD']*100)."%";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: 8%; height: 18px; text-align: center;'>".($rowDonneesPartie['pB']*100)."%";
              echo "</tr>";

              /* ******* */
              /* Ligne Separation  */
              /* ******* */

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
                echo "<td style='width: 8%; height: 18px;'><a href='StatForcePartie.php?IdJ=".$IdJ."&IdP=".$IdP."'>Force moyenne : ".$rowDonneesPartie['FMoy']."</a></td>";
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
                echo "<td style='width: 8%; height: 18px;'><a href='StatForcePartie.php?IdJ=".$IdJ."&IdP=".$IdP."'>Force min : ".$rowDonneesPartie['Fmin']."</a></td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: 8%; height: 18px; text-align: center;'>&nbsp;Nb Impact :  ".$rowDonneesPartie['NbExtG'];
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: 8%; height: 18px; text-align: center;'>&nbsp;Nb Impact :  ".$rowDonneesPartie['NbCentreG'];
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: 8%; height: 18px; text-align: center;'>&nbsp;Nb Impact :  ".$rowDonneesPartie['NbCentreD'];
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: 8%; height: 18px; text-align: center;'>&nbsp;Nb Impact :  ".$rowDonneesPartie['NbExtD'];
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
              echo "</tr>";
                          /* ******* */
                          /* LIGNE POURCENTAGE  */
                          /* ******* */
              echo "<tr style='height: 18px;'>";
                echo "<td style='width: 8%; height: 18px;'><a href='StatForcePartie.php?IdJ=".$IdJ."&IdP=".$IdP."'>Force Max : ".$rowDonneesPartie['FMax']."</a></td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: 8%; height: 18px; text-align: center;'>".($rowDonneesPartie['pExtG']*100)."%";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: 8%; height: 18px; text-align: center;'>".($rowDonneesPartie['pCG']*100)."%";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: 8%; height: 18px; text-align: center;'>".($rowDonneesPartie['pCD']*100)."%";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: 8%; height: 18px; text-align: center;'>".($rowDonneesPartie['pExtD']*100)."%";
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
                echo "<td style='width: 8%; height: 18px;'><a href='StatDistancePartie.php?IdJ=".$IdJ."&IdP=".$IdP."'>D moyenne : ".$rowDonneesPartie['dmoy']." mètres</a></td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                //echo "<td style='width: 8%; height: 18px; text-align: center;' colspan='1'>&nbsp;&nbsp;<strong>Gauche</strong></td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: 8%; height: 18px; text-align: center;' colspan='1'>&nbsp;&nbsp;<strong>Gauche</strong></td>";
                echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: 8%; height: 18px; text-align: center;' colspan='1'>&nbsp;&nbsp;<strong>Droite</strong></td>";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                //echo "<td style='width: 8%; height: 18px; text-align: center;' colspan='1'>&nbsp;&nbsp;<strong>Droite</strong></td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
              echo "</tr>";
                          /* ******* */
                          /* LIGNE IMPACT  */
                          /* ******* */
              echo "<tr style='height: 18px;'>";
                echo "<td style='width: 8%; height: 18px;'><a href='StatDistancePartie.php?IdJ=".$IdJ."&IdP=".$IdP."'>D min : ".$rowDonneesPartie['dmin']." mètres</a></td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                //echo "<td style='width: 8%; height: 18px; text-align: center;' colspan='1'>&nbsp;&nbsp;Nb Impact :  ".$rowDonneesPartie['NbGauche'];
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: 8%; height: 18px; text-align: center;' colspan='1'>&nbsp;&nbsp;Nb Impact :  ".$rowDonneesPartie['NbGauche'];
                echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: 8%; height: 18px; text-align: center;' colspan='1'>&nbsp;&nbsp;Nb Impact :  ".$rowDonneesPartie['NbDroite'];
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                //echo "<td style='width: 8%; height: 18px; text-align: center;' colspan='1'>&nbsp;&nbsp;Nb Impact :  ".$rowDonneesPartie['NbDroite'];
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
              echo "</tr>";
                          /* ******* */
                          /* LIGNE POURCENTAGE  */
                          /* ******* */
              echo "<tr style='height: 18px;'>";
                echo "<td style='width: 8%; height: 18px;'><a href='StatDistancePartie.php?IdJ=".$IdJ."&IdP=".$IdP."'>D Max : ".$rowDonneesPartie['dMax']." mètres</a></td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
                //echo "<td style='width: 8%; height: 18px; text-align: center;' colspan='1'>".($rowDonneesPartie['pG']*100)."%";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: 8%; height: 18px; text-align: center;' colspan='1'>".($rowDonneesPartie['pG']*100)."%";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                echo "<td style='width: 8%; height: 18px; text-align: center;' colspan='1'>".($rowDonneesPartie['pD']*100)."%";
                  echo "<td style='width: 0.1%; text-align: center;'></td>";
                //echo "<td style='width: 8%; height: 18px; text-align: center;' colspan='1'>".($rowDonneesPartie['pD']*100)."%";
                echo "<td style='width: 8%; height: 18px;'>&nbsp;</td>";
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

              echo "<tr style='height: 18px;'>";
                echo "<td style='width: 8%; height: 18px;'><a href='ResultatChronoPartie.php?IdJ=".$IdJ."&IdP=".$IdP."'>Chronologie de la Partie</a></td>";
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
              echo "</div>";
              //echo "<div id='chart_div' style='width: 900px; height: 500px;'></div>";
              echo "<hr size='5'color='green'>";



            }


//$Dmin = 3;
//$c1 = 0.4;
//$c2 = 0.15;
?>
<!--Load the AJAX API-->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


<script type="text/javascript">

  // Load the Visualization API and the corechart package.
  google.charts.load('current', {'packages':['corechart']});

  // Set a callback to run when the Google Visualization API is loaded.
  google.charts.setOnLoadCallback(drawChart);

  // Callback that creates and populates a data table,
  // instantiates the pie chart, passes in the data and
  // draws it.
  function drawChart() {

    // Create the data table.
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Topping');
    data.addColumn('number', 'Nb Impact : ');
    data.addColumn('number', 'Nb Impact : ');
    data.addRows([
      ['Cible 5pt G', 5,'color: #f8cbad'],
      ['Cible 5pt D', 2,'color: #f8cbad'],
      ['Cible 3pt G', 6,'color: #f56bad'],
      ['Cible 3pt D', 9,'color: #f8c78d'],
      ['Cible 2pt G', 5,'color: #f8cbad'],
      ['Cible 2pt D', 1,'color: #f8cbad']
    ]);

    // Set chart options
    var options = {
      'title':'Repartition / Cible',
      'width':800,
      'height':600,

    };

    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.BarChart(document.getElementById('BarChart'));
    chart.draw(data, options);
  }
</script>

<h1>Chart BarChart</h1>
<div id="BarChart" align="center" ></div>
<!--Div that will hold the pie chart-->
<!--//nclude 'AbaqueTableauPointDistance.php';
?>-->
