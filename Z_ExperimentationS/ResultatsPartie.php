<h1><a href="/iPassBall/">Retour sur --> /iPassBall</a></h1>
<br>
<h1><a href="/iPassBall/dev.iPassBall.com/">Retour sur --> /iPassBall/dev.iPassBall.com/</a></h1>
<br>
<?php
/**
 * Exemple simple qui étend la classe SQLite3 et change les paramètres
 * __construct, puis, utilise la méthode de connexion pour initialiser la
 * base de données.
 */
class MyDB extends SQLite3
{
    function __construct()
    {
        $this->open('iPassBall.V.0.2.db');
    }
}

/*
try {
    $bd = new MyDB();
} catch (Exception $e) {
    die("La creation ou l'ouverture de la base [$base] a echouee ".
         "pour la raison suivante: ".$e->getMessage());
}
*/
$bd = new MyDB();
// Lecture des donnees dans la table
/*$sqlParametresPartie = "SELECT * FROM ParametresPartie where IdJoueur='1'";*/
$sqlParametresPartie = "SELECT * FROM ParametresPartie ";
$sqlJoueur = "SELECT * FROM Joueurs where IdJoueur='1'";
$sqlDonneesPartie = "SELECT * FROM DonneesPartie where IdJoueur='1'";
/*$reponse = $bd->query($sql, SQLITE3_BOTH, $err);*/
$reponseParametresPartie = $bd->query($sqlParametresPartie);
$reponseJoueur = $bd->query($sqlJoueur);
$reponseDonneesPartie = $bd->query($sqlDonneesPartie);

if ($reponseParametresPartie === FALSE)
    echo "La requete ParametresPartie a echouee pour la raison suivante: ".$err;

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
<p>Joueur :  <?php echo $Joueur; ?>
</p>

<p>Dur&eacute;e : <?php echo $rowParametresPartie['DureePartie'].' Minute' ?></p>
<p>Dmin : <?php echo $rowParametresPartie['DminPartie'].' Mètre' ?></p>
<p>C1: <?php echo $rowParametresPartie['c1Partie'] ?></p>
<p>C2 : <?php echo $rowParametresPartie['c2Partie'] ?></p>

<?php
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

              echo "<table style='width: 92.7431%; border-collapse: collapse; height: 180px; border-color: transparent';'' border='1'>";
              echo "<tbody>";
              /* ******* */
              /* DEBUT ENTETE */
              /* ******* */
              echo "<tr style='height: 18px;'>";
              echo "<td style='width: 12%; height: 18px; border-color: transparent';>Impact N°".$rowDonneesPartie['NbImp']."</td>";
              echo "<td style='width: 12%; height: 18px;'>&nbsp;</td>";
              echo "<td style='width: 12%; height: 18px;'>Code Joueur ".$rowJoueur['CodeJoueur']."</td>";
              echo "<td style='width: 12%; height: 18px;'>Score = ".$rowDonneesPartie['Score']."</td>";
              echo "<td style='width: 12%; height: 18px;'></td>";
              echo "<td style='width: 12%; height: 18px;'>Temps : ".$rowDonneesPartie['Tps']."</td>";
              echo "<td style='width: 10%; height: 18px;'>&nbsp;</td>";
              echo "<td style='width: 10%; height: 18px;'>&nbsp;</td>";
              echo "</tr>";
              /* ******* */
              /* FIN ENTETE */
              /* ******* */
              echo "<tr style='height: 18px;'>";
              echo "<td style='width: 12%; height: 18px;'>&nbsp;</td>";
              echo "<td style='width: 12%; height: 18px;'>&nbsp;</td>";
              echo "<td style='width: 12%; height: 18px;'>&nbsp;</td>";
              echo "<td style='width: 12%; height: 18px;'>&nbsp;</td>";
              echo "<td style='width: 12%; height: 18px;'>&nbsp;</td>";
              echo "<td style='width: 12%; height: 18px;'>&nbsp;</td>";
              echo "<td style='width: 10%; height: 18px;'>&nbsp;</td>";
              echo "<td style='width: 10%; height: 18px;'>&nbsp;</td>";
              echo "</tr>";
              /* ******* */
              /* Cible HAUTES  */
              /* ******* */
              echo "<tr style='height: 18px;'>";
              echo "<td style='width: 12%; height: 18px;'>&nbsp;</td>";
              echo "<td style='width: 12%; height: 18px;'>&nbsp;</td>";
              echo "<td style='background-color: #f8cbad; width: 12%; text-align: center;'>1";
              if ($bHGG == TRUE) {
                echo "--> <span style='color: #ff0000;'><strong>TOUCHE</strong></span></td>";
              } else {
                echo "</td>";
              }
              echo "<td style='background-color: #f2b084; width: 12%; text-align: center; '>2";
              if ($bHG == TRUE) {
                echo "--> <span style='color: #ff0000;'><strong>TOUCHE</strong></span></td>";
              } else {
                echo "</td>";
              }
              echo "<td style='background-color: #f2b084; width: 12%; text-align: center;''>2";
              if ($bHD == TRUE) {
                echo "--> <span style='color: #ff0000;'><strong>TOUCHE</strong></span></td>";
              } else {
                echo "</td>";
              }
              echo "<td style='background-color: #f8cbad; width: 12%; text-align: center;'>1";
              if ($bHDD == TRUE) {
                echo "--> <span style='color: #ff0000;'><strong>TOUCHE</strong></span></td>";
              } else {
                echo "</td>";
              }
              echo "<td style='width: 10%; height: 18px;'>&nbsp;</td>";
              echo "<td style='width: 10%; height: 18px; text-align: center;'><strong>HAUT</strong></td>";
              echo "</tr>";
                          /* ******* */
                          /* LIGNE IMPACT  */
                          /* ******* */
              echo "<tr style='height: 18px;'>";
              echo "<td style='width: 12%; height: 18px;'>&nbsp;</td>";
              echo "<td style='width: 12%; height: 18px;'>&nbsp;</td>";
              echo "<td style='background-color: #f8cbad; text-align: center; width: 12%;'>Nb Impact ".$rowDonneesPartie['nHGG']."</td>";
              echo "<td style='background-color: #f2b084; text-align: center; width: 12%;'>Nb Impact ".$rowDonneesPartie['nHG']."</td>";
              echo "<td style='background-color: #f2b084; text-align: center; width: 12%;'>Nb Impact ".$rowDonneesPartie['nHD']."</td>";
              echo "<td style='background-color: #f8cbad; text-align: center; width: 12%;'>Nb Impact ".$rowDonneesPartie['nHDD']."</td>";
              echo "<td style='width: 10%; height: 18px;'>&nbsp;</td>";
              echo "<td style='width: 10%; height: 18px; text-align: center;'>Nb Impact ".$rowDonneesPartie['nHaut']."</td>";
              echo "</tr>";
                            /* ******* */
                            /* LIGNE POURCENTAGE  */
                            /* ******* */
              echo "<tr style='height: 18px;'>";
              echo "<td style='width: 12%; height: 18px;'>&nbsp;</td>";
              echo "<td style='width: 12%; height: 18px;'>&nbsp;</td>";
              echo "<td style='background-color: #f8cbad; text-align: center; width: 12%;'>".$rowDonneesPartie['pHGG']."</td>";
              echo "<td style='background-color: #f2b084; text-align: center; width: 12%;'>".$rowDonneesPartie['pHG']."</td>";
              echo "<td style='background-color: #f2b084; text-align: center; width: 12%;'>".$rowDonneesPartie['pHD']."</td>";
              echo "<td style='background-color: #f8cbad; text-align: center; width: 12%;'>".$rowDonneesPartie['pHDD']."</td>";
              echo "<td style='width: 10%; height: 18px;'>&nbsp;</td>";
              echo "<td style='width: 10%; height: 18px; text-align: center;'>".$rowDonneesPartie['pH']."</td>";
              echo "</tr>";
              /* ******* */
              /* Cible BASSES  */
              /* ******* */
              echo "<tr style='height: 18px;'>";
              echo "<td style='width: 12%; height: 18px;'>&nbsp;</td>";
              echo "<td style='width: 12%; height: 18px;'>&nbsp;</td>";
              echo "<td style='background-color: #e2efda; width: 12%; text-align: center;'>3";
              if ($bBGG == TRUE) {
                echo "--> <span style='color: #ff0000;'><strong>TOUCHE</strong></span></td>";
              } else {
                echo "</td>";
              }
              echo "<td style='background-color: #a9d08e; width: 12%; text-align: center;'>5";
              if ($bBG == TRUE) {
                echo "--> <span style='color: #ff0000;'><strong>TOUCHE</strong></span></td>";
              } else {
                echo "</td>";
              }
              echo "<td style='background-color: #a9d08e; width: 12%; text-align: center;'>5";
              if ($bBD == TRUE) {
                echo "--> <span style='color: #ff0000;'><strong>TOUCHE</strong></span></td>";
              } else {
                echo "</td>";
              }
              echo "<td style='background-color: #e2efda; width: 12%; text-align: center;'>3";
              if ($bBDD == TRUE) {
                echo "--> <span style='color: #ff0000;'><strong>TOUCHE</strong></span></td>";
              } else {
                echo "</td>";
              }
              echo "<td style='width: 10%; height: 18px;'>&nbsp;</td>";
              echo "<td style='width: 10%; height: 18px; text-align: center;'><strong>BAS</strong></td>";
              echo "</tr>";
                          /* ******* */
                          /* LIGNE IMPACT  */
                          /* ******* */
              echo "<tr style='height: 18px;'>";
              echo "<td style='width: 12%; height: 18px;'>&nbsp;</td>";
              echo "<td style='width: 12%; height: 18px;'>&nbsp;</td>";
              echo "<td style='background-color: #e2efda; text-align: center; width: 12%;'>Nb Impact ".$rowDonneesPartie['nBGG']."</td>";
              echo "<td style='background-color: #a9d08e; text-align: center; width: 12%;'>Nb Impact ".$rowDonneesPartie['nBG']."</td>";
              echo "<td style='background-color: #a9d08e; text-align: center; width: 12%;'>Nb Impact ".$rowDonneesPartie['nBD']."</td>";
              echo "<td style='background-color: #e2efda; text-align: center; width: 12%;'>Nb Impact ".$rowDonneesPartie['nBDD']."</td>";
              echo "<td style='width: 10%; height: 18px;'>&nbsp;</td>";
              echo "<td style='width: 10%; height: 18px; text-align: center;'>&nbsp;Nb Impact ".$rowDonneesPartie['nBas']."</td>";
              echo "</tr>";
                          /* ******* */
                          /* LIGNE POURCENTAGE  */
                          /* ******* */
              echo "<tr style='height: 18px;'>";
              echo "<td style='width: 12%; height: 18px;'>&nbsp;</td>";
              echo "<td style='width: 12%; height: 18px;'>&nbsp;</td>";
              echo "<td style='background-color: #e2efda; text-align: center; width: 12%;'>".$rowDonneesPartie['pBGG']."</td>";
              echo "<td style='background-color: #a9d08e; text-align: center; width: 12%;'>".$rowDonneesPartie['pBG']."</td>";
              echo "<td style='background-color: #a9d08e; text-align: center; width: 12%;'>".$rowDonneesPartie['pBD']."</td>";
              echo "<td style='background-color: #e2efda; text-align: center; width: 12%;'>".$rowDonneesPartie['pBDD']."</td>";
              echo "<td style='width: 10%; height: 18px;'>&nbsp;</td>";
              echo "<td style='width: 10%; height: 18px; text-align: center;'>".$rowDonneesPartie['pB']."</td>";
              echo "</tr>";
              echo "<tr style='height: 18px;'>";
              echo "<td style='width: 12%; height: 18px;'>&nbsp;</td>";
              echo "<td style='width: 12%; height: 18px;'>&nbsp;</td>";
              echo "<td style='width: 12%; height: 18px;'>&nbsp;</td>";
              echo "<td style='width: 12%; height: 18px;'>&nbsp;</td>";
              echo "<td style='width: 12%; height: 18px;'>&nbsp;</td>";
              echo "<td style='width: 12%; height: 18px;'>&nbsp;</td>";
              echo "<td style='width: 10%; height: 18px;'>&nbsp;</td>";
              echo "<td style='width: 10%; height: 18px;'>&nbsp;</td>";
              echo "</tr>";
              /* ******* */
              /* SYNTHESE PAR QUART  */
              /* ******* */
              echo "<tr style='height: 18px;'>";
              echo "<td style='width: 12%; height: 18px;'>&nbsp;</td>";
              echo "<td style='width: 12%; height: 18px;'>&nbsp;</td>";
              echo "<td style='width: 12%; height: 18px; text-align: center;'>Ext G</td>";
              echo "<td style='width: 12%; height: 18px; text-align: center;'>Centre G</td>";
              echo "<td style='width: 12%; height: 18px; text-align: center;'>Centre D</td>";
              echo "<td style='width: 12%; height: 18px; text-align: center;'>Ext D</td>";
              echo "<td style='width: 10%; height: 18px;'>&nbsp;</td>";
              echo "<td style='width: 10%; height: 18px;'>&nbsp;</td>";
              echo "</tr>";
                          /* ******* */
                          /* LIGNE IMPACT  */
                          /* ******* */
              echo "<tr style='height: 18px;'>";
              echo "<td style='width: 12%; height: 18px;'>&nbsp;</td>";
              echo "<td style='width: 12%; height: 18px;'>&nbsp;</td>";
              echo "<td style='width: 12%; height: 18px; text-align: center;'>&nbsp;Nb Impact ".$rowDonneesPartie['nExtG']."</td>";
              echo "<td style='width: 12%; height: 18px; text-align: center;'>&nbsp;Nb Impact ".$rowDonneesPartie['nCentreG']."</td>";
              echo "<td style='width: 12%; height: 18px; text-align: center;'>&nbsp;Nb Impact ".$rowDonneesPartie['nCentreD']."</td>";
              echo "<td style='width: 12%; height: 18px; text-align: center;'>&nbsp;Nb Impact ".$rowDonneesPartie['nExtD']."</td>";
              echo "<td style='width: 10%; height: 18px;'>&nbsp;</td>";
              echo "<td style='width: 10%; height: 18px;'>&nbsp;</td>";
              echo "</tr>";
                          /* ******* */
                          /* LIGNE POURCENTAGE  */
                          /* ******* */
              echo "<tr style='height: 18px;'>";
              echo "<td style='width: 12%; height: 18px;'>&nbsp;</td>";
              echo "<td style='width: 12%; height: 18px;'>&nbsp;</td>";
              echo "<td style='width: 12%; height: 18px; text-align: center;'>".$rowDonneesPartie['pExtG']."</td>";
              echo "<td style='width: 12%; height: 18px; text-align: center;'>".$rowDonneesPartie['pCentreG']."</td>";
              echo "<td style='width: 12%; height: 18px; text-align: center;'>".$rowDonneesPartie['pCentreD']."</td>";
              echo "<td style='width: 12%; height: 18px; text-align: center;'>".$rowDonneesPartie['pExtD']."</td>";
              echo "<td style='width: 10%; height: 18px;'>&nbsp;</td>";
              echo "<td style='width: 10%; height: 18px;'>&nbsp;</td>";
              echo "</tr>";
              echo "<tr style='height: 18px;'>";
              echo "<td style='width: 12%; height: 18px;'>&nbsp;</td>";
              echo "<td style='width: 12%; height: 18px;'>&nbsp;</td>";
              echo "<td style='width: 12%; height: 18px;'>&nbsp;</td>";
              echo "<td style='width: 12%; height: 18px;'>&nbsp;</td>";
              echo "<td style='width: 12%; height: 18px;'>&nbsp;</td>";
              echo "<td style='width: 12%; height: 18px;'>&nbsp;</td>";
              echo "<td style='width: 10%; height: 18px;'>&nbsp;</td>";
              echo "<td style='width: 10%; height: 18px;'>&nbsp;</td>";
              echo "</tr>";
              /* ******* */
              /* SYNTHESE PAR DEMI  */
              /* ******* */
              echo "<tr style='height: 18px;'>";
              echo "<td style='width: 12%; height: 18px;'>&nbsp;</td>";
              echo "<td style='width: 12%; height: 18px;'>&nbsp;</td>";
              echo "<td style='width: 24%; height: 18px; text-align: center;' colspan='2'>&nbsp;&nbsp;<strong>Gauche</strong></td>";
              echo "<td style='width: 24%; height: 18px; text-align: center;' colspan='2'>&nbsp;&nbsp;<strong>Droite</strong></td>";
              echo "<td style='width: 10%; height: 18px;'>&nbsp;</td>";
              echo "<td style='width: 10%; height: 18px;'>&nbsp;</td>";
              echo "</tr>";
                          /* ******* */
                          /* LIGNE IMPACT  */
                          /* ******* */
              echo "<tr style='height: 18px;'>";
              echo "<td style='width: 12%; height: 18px;'>&nbsp;</td>";
              echo "<td style='width: 12%; height: 18px;'>&nbsp;</td>";
              echo "<td style='width: 24%; height: 18px; text-align: center;' colspan='2'>&nbsp;&nbsp;Nb Impact ".$rowDonneesPartie['nGauche']."</td>";
              echo "<td style='width: 24%; height: 18px; text-align: center;' colspan='2'>&nbsp;&nbsp;Nb Impact ".$rowDonneesPartie['nDroite']."</td>";
              echo "<td style='width: 10%; height: 18px;'>&nbsp;</td>";
              echo "<td style='width: 10%; height: 18px;'>&nbsp;</td>";
              echo "</tr>";
                          /* ******* */
                          /* LIGNE POURCENTAGE  */
                          /* ******* */
              echo "<tr style='height: 18px;'>";
              echo "<td style='width: 12%; height: 18px;'>&nbsp;</td>";
              echo "<td style='width: 12%; height: 18px;'>&nbsp;</td>";
              echo "<td style='width: 24%; height: 18px; text-align: center;' colspan='2'>".$rowDonneesPartie['pGauche']."</td>";
              echo "<td style='width: 24%; height: 18px; text-align: center;' colspan='2'>".$rowDonneesPartie['pDroite']."</td>";
              echo "<td style='width: 10%; height: 18px;'>&nbsp;</td>";
              echo "<td style='width: 10%; height: 18px;'>&nbsp;</td>";
              echo "</tr>";
              echo "<tr style='height: 18px;'>";
              echo "<td style='width: 12%; height: 18px;'>&nbsp;</td>";
              echo "<td style='width: 12%; height: 18px;'>&nbsp;</td>";
              echo "<td style='width: 12%; height: 18px;'>&nbsp;</td>";
              echo "<td style='width: 12%; height: 18px;'>&nbsp;</td>";
              echo "<td style='width: 12%; height: 18px;'>&nbsp;</td>";
              echo "<td style='width: 12%; height: 18px;'>&nbsp;</td>";
              echo "<td style='width: 10%; height: 18px;'>&nbsp;</td>";
              echo "<td style='width: 10%; height: 18px;'>&nbsp;</td>";
              echo "</tr>";
              echo "</table>";
              echo "</tbody>";
              echo "<br>";

              $bHDD  = FALSE;
              $bBDD = FALSE;
              $bHD = FALSE;
              $bBD = FALSE;
              $bHG = FALSE;
              $bBG = FALSE;
              $bHGG = FALSE;
              $bBGG = FALSE;
            }

?>
