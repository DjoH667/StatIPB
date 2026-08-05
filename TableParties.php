<?php

include 'MenuIPassBall.php';
include 'MenuStyleTable.php';
?>

<?php
/**
 * Exemple simple qui étend la classe SQLite3 et change les paramètres
 * __construct, puis, utilise la méthode de connexion pour initialiser la
 * base de données.
 */
include 'ConnexionBDDiPassBall.php';

// Lecture des donnees dans la table
//$sql = "SELECT * FROM ParametresPartie Order by IdPartie, DatePartie";
$sql = "SELECT * FROM SyntheseDonneesParties INNER JOIN ParametresPartie ON SyntheseDonneesParties.IdPartie = ParametresPartie.IdPartie ORDER BY DureePartie ASC, Score DESC, DatePartie ASC";
/*$reponse = $bd->query($sql, SQLITE3_BOTH, $err);*/
$reponse = $bd->query($sql);
if ($reponse === FALSE) {
    echo "La requete a echouee pour la raison suivante: ".$err;
} else {
    echo "<h1>PARTIES JOUEES  <br>";
    echo "<i style='color: white; text-transform: italic;font-size: 24px;'>";
    echo ">>> Par Durée Croissante / Score décroissant";
    echo "</i>";
    echo "</h1>";
    // echo "<table style='width: 1000px; margin-left:auto;margin-right:auto;' border='0'>";
    // echo "<tr>";
    // echo "<td><a href='#30'>>>Voir Parties de 30 s</a></td>";
    // echo "<td><a href='#1'>>>Voir Parties de 1 min</a></td>";
    // echo "<td><a href='#2'>>>Voir Parties de 2 min</a></td>";
    // echo "<td><a href='#3'>>>Voir Parties de 3 min</a></td>";
    // echo "<tr>";
    // echo "</table>";

    $Duree = 0;
    $i=0;
    $iDuree=0;
    $i30=0;
    $i60=0;
    $i120=0;
    $i180=0;
    $BarrePoint= 1000;

    //$CentainesPartie = 200;

    while ($row = $reponse->fetchArray()) {

        $sqlJoueur = "SELECT * FROM Joueurs where IdJoueur=".$row['IdJoueur'];
        /*$reponse = $bd->query($sql, SQLITE3_BOTH, $err);*/
        $reponseJoueur = $bd->query($sqlJoueur);

        $rowJoueur = $reponseJoueur->fetchArray();



        $i=$i+1;

        switch ($row['DureePartie']) {
              case 180:
                  $i180=$i180+1;

              break;

              case 120:
                  $i120=$i120+1;

              break;

              case 60:
                  $i60=$i60+1;

              break;

                case 30:
                  $i30=$i30+1;

                break;
            }


          if ($row['DureePartie']>$Duree) {

            $CentainesPartie = (intdiv($row['Score'],100)*100)+100;
            $CinquantainesPartie = (intdiv($row['Score'],100)*100)+50;
            //echo "<tr><td colspan=20 '>Avant IF  Score = ".$row['Score']." < CentainesPartie = ".$CentainesPartie."</td></tr>";

            switch ($row['DureePartie']) {
                  case 180:
                          // echo "RowDureePartie égal 180s<br>";
                          // echo "Duree égal ".$Duree."<br>";

                          //if ($row['DureePartie'] > 59 AND ) {

                         $DureePartie = $row['DureePartie']/60;
                         $StringDureePartie = $DureePartie." min";
                         $Ancre="<balise id='".$DureePartie."'>".$StringDureePartie."</balise>";

                  break;

                  case 120:
                          // echo "RowDureePartie égal 120s<br>";
                          // echo "Duree égal ".$Duree."<br>";

                          //if ($row['DureePartie'] > 59 AND ) {

                         $DureePartie = $row['DureePartie']/60;
                         $StringDureePartie = $DureePartie." min";
                         $Ancre="<balise id='".$DureePartie."'>".$StringDureePartie."</balise>";

                  break;

                  case 60:
                          // echo "RowDureePartie égal 60s<br>";
                          // echo "Duree égal ".$Duree."<br>";
                          // echo "CentainesPartie=".$CentainesPartie."<br>";
                          // echo "CinquantainesPartie=".$CinquantainesPartie."<br>";



                          //if ($row['DureePartie'] > 59 AND ) {

                         $DureePartie = $row['DureePartie']/60;
                         $StringDureePartie = $DureePartie." min";
                         $Ancre="<balise id='".$DureePartie."'>".$StringDureePartie."</balise>";

                  break;

                // }
                // else {

                    case 30:
                        // echo "RowDureePartie égal 30s<br>";
                        // echo "Duree égal ".$Duree."<br>";
                        // echo "CentainesPartie=".$CentainesPartie."<br>";
                        // echo "CinquantainesPartie=".$CinquantainesPartie."<br>";

                        $DureePartie = $row['DureePartie'];
                        $StringDureePartie = $DureePartie." s";
                        $Ancre="<balise id='".$DureePartie."'>".$StringDureePartie."</balise>";

                        // echo "<H2>Durée Partie = ".$StringDureePartie."</H2></td>";
                        //
                        // echo "<h4><u>Légende : </u><br>";
                        // //echo "C = Classement ; #p = n° de partie ; Imp = nombre d'impacts ; Pts / Imp = nb de points par impact <br>";
                        // echo "#P = n° de Partie >> Cliquez pour avoir le détail de la Partie<br>";
                        // echo "#S = n° de Session >> Cliquez pour avoir le détail de la Session<br>";
                        // echo "Code = Code Joueur >> Cliquer pour avoir le détail des parties du joueur<br>";
                        // echo "+++   Imp = nombre d'impacts ; Pts / Imp = nb de points par impact <br><br>";

                    break;


                }

                $Duree=$row['DureePartie'];

                // echo "------ Hors SWitch <br>";
                // echo "Total Parties = ".$i." / ";
                // echo "Total Parties 30s   = ".$i30." / ";
                // echo "Total Parties 1 min = ".$i60." / ";
                // echo "Total Parties 2 min = ".$i120." / ";
                // echo "Total Parties 3 min = ".$i180." <br> ";
                // echo "DureePartie égal ".$DureePartie."<br>";
                // echo "CentainesPartie=".$CentainesPartie."<br>";
                // echo "CinquantainesPartie=".$CinquantainesPartie."<br>";
                // echo "Score=".$row['Score']."<br>";

                //if ($Duree == $row['DureePartie'] ) {

                  //echo "<H2>Durée Partie = ".$StringDureePartie."</H2></td>";

                  echo "<table style='width: 100%; margin-left:auto;margin-right:auto;' border='0'>";
                  echo "<tr><td><H2>Durée Partie = ".$Ancre."</H2></td></tr>";
                  echo "</table>";
                  //echo "<table style='width: 1000px; margin-left:auto;margin-right:auto;' border='0'>";
                  // echo "<tr>";
                  // echo "<td><a href='#30'>>>Voir Parties de 30 s</a></td>";
                  // echo "<td><a href='#1'>>>Voir Parties de 1 min</a></td>";
                  // echo "<td><a href='#2'>>>Voir Parties de 2 min</a></td>";
                  // echo "<td><a href='#3'>>>Voir Parties de 3 min</a></td>";
                  // echo "<tr>";
                  //  echo "</table>";

                  echo "<h4><u>Légende : </u><br><br>";
                  //echo "C = Classement ; #p = n° de partie ; Imp = nombre d'impacts ; Pts / Imp = nb de points par impact <br>";
                  echo "<i style='color: black; text-transform: italic;'>";
                  echo "#C = Classement de la partie pour la durée<br>";
                  echo "#P = n° de Partie >> Cliquez pour avoir le détail de la Partie<br>";
                  echo "#S = n° de Session >> Cliquez pour avoir le détail de la Session<br>";
                  echo "Code = Code Joueur >> Cliquer pour avoir le détail des parties du joueur<br>";
                  echo "+++   Imp = nombre d'impacts ; Pts / Imp = nb de points par impact <br><br>";
                  echo "</i>";
                  echo "</h4>";
                //}

            //include 'TablePartiesJoueurEnTete.php';

          }

              if (($row['Score'] < $CinquantainesPartie) AND ($row['Score'] > 0) ) {
                //if ($row['Score'] < $CinquantainesPartie) {
                  //if ($row['Score'] > $CentainesPartie ) {

                //echo "<tr><td colspan=20 '>if 1 OK  Score = ".$row['Score']." < CentainesPartie = ".$CentainesPartie."</td></tr>";
                $CentaineP = $CentainesPartie;
                // echo "<br>";
                echo "<table style='width: 1000px; margin-left:auto;margin-right:auto;' border='0'>";
                // echo "<tr><td olspan=20 >AVANT CinquantainesPartie = ".$CinquantainesPartie." </td></tr>";
                // echo "<tr><td olspan=20 >AVANT CentainesPartie = ".$CentainesPartie." </td></tr>";
                echo "<tr>";
                echo "<td colspan=5><a href='#30'>>>Voir Parties de 30 s</a></td>";
                echo "<td colspan=5><a href='#1'>>>Voir Parties de 1 min</a></td>";
                echo "<td colspan=5><a href='#2'>>>Voir Parties de 2 min</a></td>";
                echo "<td colspan=5><a href='#3'>>>Voir Parties de 3 min</a></td>";
                echo "<tr>";
                echo "<tr><td colspan=20 ><h2>".$StringDureePartie." : Parties  < ".$CinquantainesPartie." points</h2></td></tr>";
                $CinquantainesPartie = $CinquantainesPartie - 100;
                    if ($CentainesPartie - $CinquantainesPartie > 50) {
                      $CentainesPartie=$CentainesPartie-100;
                    }
                //$CentainesPartie = $CentainesPartie - 100;
                // echo "<tr><td olspan=20 >APRES CALCUL CentainesPartie = ".$CentainesPartie." </td></tr>";
                // echo "<tr><td olspan=20 >APRES CALCUL CinquantainesPartie = ".$CinquantainesPartie." </td></tr>";

                echo "</table>";
                // echo "50<br>";
                //$CinquantainesPartie = $CinquantainesPartie - 100;
                if (($row['Score'] > $CentainesPartie)) {
                  include 'TablePartiesJoueurEnTete.php';
                }

                }

                if (($row['Score'] < $CentainesPartie) AND ($row['Score'] > $CinquantainesPartie) ) {

                  //echo "<tr><td colspan=20 '>if 1 OK  Score = ".$row['Score']." < CentainesPartie = ".$CentainesPartie."</td></tr>";
                  // echo "<br>";
                  echo "<table style='width: 1000px; margin-left:auto;margin-right:auto;' border='0'>";
                  // echo "<tr><td olspan=20 >AVANT CentainesPartie = ".$CentainesPartie." </td></tr>";
                  // echo "<tr><td olspan=20 >AVANT CinquantainesPartie = ".$CinquantainesPartie." </td></tr>";
                  echo "<tr>";
                  echo "<td colspan=5><a href='#30'>>>Voir Parties de 30 s</a></td>";
                  echo "<td colspan=5><a href='#1'>>>Voir Parties de 1 min</a></td>";
                  echo "<td colspan=5><a href='#2'>>>Voir Parties de 2 min</a></td>";
                  echo "<td colspan=5><a href='#3'>>>Voir Parties de 3 min</a></td>";
                  echo "<tr>";
                  echo "<tr><td colspan=20 ><h2>".$StringDureePartie." : Parties < ".$CentainesPartie." points</h2></td></tr>";

                  $CentainesPartie = $CentainesPartie - 100;
                  //if ($CentainesPartie-$CentainesPartie)
                  // echo "<tr><td olspan=20 >APRES CALCUL CinquantainesPartie = ".$CinquantainesPartie." </td></tr>";
                  // echo "<tr><td olspan=20 >APRES CALCUL CentainesPartie = ".$CentainesPartie." </td></tr>";

                  echo "</table>";
                  // echo "100<br>";
                  //$CentainesPartie = $CentainesPartie - 100;
                  include 'TablePartiesJoueurEnTete.php';

                }

                $C=$CentainesPartie;



        //echo "<tr style='background-color:#".$Couleur."'>";
        // echo "<td style='width: '> </td>";
        // echo "<td style='width: '> </td>";

        switch ($row['DureePartie']) {
              case 180:
              echo "<td style='width: '><b>".$i180."</b></td>";

              break;

              case 120:
              echo "<td style='width: '><b>".$i120."</b></td>";

              break;

              case 60:
              echo "<td style='width: '><b>".$i60."</b></td>";

              break;

              case 30:
              echo "<td style='width: '><b>".$i30."</b></td>";

              break;
            }


        echo "<td style='width: '><a href='SynthesePartie.php?IdJ=".$row['IdJoueur']."&IdP=".$row['IdPartie']."'>P".$row['IdPartie']."</a></td>";
        echo "<td style='width: '><a href='SyntheseSession.php?IdSession=".$row['IdSession']."'>S".$row['IdSession']."</a></td>";

        echo "<td style='width: '></td>";
        //echo "<td style='width: '><a href='PartiesJoueur.php?IdJ=".$row['IdJoueur']."&NomJ=".$row['NomJoueur']."&PrenomJ=".$row['PrenomJoueur']."'>".$row['IdJoueur']."</a></td>";
        echo "<td style='width: '><a href='PartiesJoueur.php?IdJ=".$row['IdJoueur']."&NomJ=".$rowJoueur['NomJoueur']."&PrenomJ=".$rowJoueur['PrenomJoueur']."'>".$rowJoueur['CodeJoueur']."</a></td>";
        echo "<td style='width: '>".$rowJoueur['PrenomJoueur']."</td>";

        $NomJ=substr($rowJoueur['NomJoueur'], 0, 3);
        echo "<td style='width: '>".$NomJ."</td>";

        echo "<td style='width: '><b></b></td>";

        echo "<td style='text-align: right; '><b>".$row['Score']."</b></td>";
        echo "<td style='text-align: right; '></td>";

        echo "<td style='text-align: right; '><b>".$row['NbImp']."</b></td>";
        $PtParImp = number_format($row['Score'] / $row['NbImp'], 2, ',', ' ');
        echo "<td style='text-align: right; '><b>".$PtParImp."</b></td>";
        echo "<td style='width: '></td>";

        $dmoy = number_format($row['dmoy'], 2, ',', ' ');
        $dmin = number_format($row['dmin'], 2, ',', ' ');
        $dmax = number_format($row['dMax'], 2, ',', ' ');

        echo "<td style='text-align: right; '><b>".$dmoy." m</b></td>";
        echo "<td style='text-align: right; '>".$dmin." m</td>";
        echo "<td style='text-align: right; '>".$dmax." m</td>";






        echo "<td style='width: '><b></b></td>";

        // if ($row['DureePartie'] > 59 ) {
        //
        //    $DureePartie = $row['DureePartie']/60;
        //    $StringDureePartie = $DureePartie." min";
        // }
        // else {
        //   $DureePartie = $row['DureePartie'];
        //   $StringDureePartie = $DureePartie." s";
        // }
        //
        // echo "<td style='width: '>".$StringDureePartie."</td>";

        // $Dnominale = $row['DminPartie']/100;
        // echo "<td style='width: '>".$Dnominale." mètres</td>";
        // $c1 = number_format($row['c1Partie'], 2, ',', ' ');
        // $c2 = number_format($row['c2Partie'], 2, ',', ' ');
        // echo "<td style='width: '>".$c1." / ".$c2."</td>";
        //
        // echo "<td style='width: '></td>";
        list($Annee, $Mois, $Jour) = explode('-',$row['DatePartie']);
        $AN=substr($Annee, 0, 2);
        echo "<td style='width: '>".$Jour." ".$Mois." ".$AN."</td>";

        echo "</tr>";





        //$Duree=$row['DureePartie'];

    }
}
echo "</tbody>";
echo "</table>";

echo "<br>";
echo "<br>";
echo "<br>";

echo "<table style='width: 700px; margin-left:auto;margin-right:auto;' border='0'";
echo "<tbody>";
echo "<thead>";

echo "<tr>";
echo "<td colspan=2 ><h2>Récapitulatif</h2></td>";
echo "</tr>";

echo "</thead>";

echo "<tr>";
echo "<td style='width: 500px'><b>Nombre de Parties de 30s</b></td>";
echo "<td style='width: 200px'><b>".$i30."</b></td>";
echo "</tr>";

echo "<tr>";
echo "<td style='width: '><b>Nombre de Parties de 1 min</b></td>";
echo "<td style='width: '><b>".$i60."</b></td>";
echo "</tr>";

echo "<tr>";
echo "<td style='width: '><b>Nombre de Parties de 2 min</b></td>";
echo "<td style='width: '><b>".$i120."</b></td>";
echo "</tr>";

echo "<tr>";
echo "<td style='width: '><b>Nombre de Parties de 3 min</b></td>";
echo "<td style='width: '><b>".$i180."</b></td>";
echo "</tr>";

echo "<thead>";

echo "<tr>";
echo "<td style='width: '><h2>Nombre Total de Parties </h2></td>";
echo "<td style='width: '><h2>".$i."</h2></td>";
echo "</tr>";

echo "</thead>";

echo "</tbody>";
echo "</table>";

// echo "<h2>Total Parties = ".$i."</h2>";
// echo "<h2>Total Parties 30s   = ".$i30."</h2>";
// echo "<h2>Total Parties 1 min = ".$i60."</h2>";
// echo "<h2>Total Parties 2 min = ".$i120."</h2>";
// echo "<h2>Total Parties 3 min = ".$i180."</h2>";

//echo "<hr size='5'color='green'>";
// Deconnexion
$bd = null;
?>
