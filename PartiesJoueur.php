<?php

include 'MenuIPassBall.php';
include 'MenuStyleTable.php';
include_once 'Security.php';
?>
<?php

/* Variables passées en prametres dans l'url*/
    $id = app_get_int("IdJ");
    $nom = app_get_string("NomJ");
    $prenom = app_get_string("PrenomJ");

		 //echo "IdJoueur = ".$id."<br>";

     include 'ConnexionBDDiPassBall.php';

     // Lecture des donnees dans la table
     //$sql = "SELECT * FROM ParametresPartie where IdJoueur=".$id." ORDER BY DureePartie ASC, DatePartie ASC ";
     $sql = "SELECT * FROM SyntheseDonneesParties INNER JOIN ParametresPartie ON SyntheseDonneesParties.IdPartie =ParametresPartie.IdPartie  where SyntheseDonneesParties.idJoueur=".$id." ORDER BY DureePartie ASC, DatePartie ASC";
     /*$reponse = $bd->query($sql, SQLITE3_BOTH, $err);*/
     $reponse = $bd->query($sql);
     if ($reponse === FALSE) {
         echo "La requete a echouee pour la raison suivante: ".$err;
     } else {
         echo "<h1>Parties jouées par ".$prenom." ".$nom."</h1>";



         $Duree = 0;
         $i=0;
         $iDuree=-1;

         $iBoucleDureePrecedent = 1 ;

         $LigneGraphiquePoints = "";

         while ($row = $reponse->fetchArray()) {

           $i=$i+1;
 //echo "i=".$i."<br>";

           if ($row['DureePartie']>$Duree) {

             $iDuree=$iDuree+1;
             // echo "iDuree=".$iDuree."<br>";
             // echo "iBoucle Avant Graphique=".$iBoucleDuree."<br>";

             //echo "iBoucleDuréeInit=".$iBoucleDuree."<br>";
             //echo "iDuree + 1 = ".$iDuree."<br>";

             //echo "LigneGraphiquePoints DureePartie>Duree = ".$LigneGraphiquePoints."<br>";

             if ($row['DureePartie'] > 59 ) {

                $DureePartie = $row['DureePartie']/60;
                $StringDureePartie = $DureePartie." min";
             }
             else {
               $DureePartie = $row['DureePartie'];
               $StringDureePartie = $DureePartie." s";
             }


             include 'PartiesJoueurEnTete.php';
             $iBoucleDuree = 1 ;
             //echo "iBoucleDuréeInit=".$iBoucleDuree."<br>";



           }




             echo "<tr>";
             // echo "<td style='width: '> </td>";
             // echo "<td style='width: '> </td>";
             // echo "<td style='width: '> </td>";

             echo "<td style='width: '><a href='SynthesePartie.php?IdJ=".$row['IdJoueur']."&IdP=".$row['IdPartie']."'>".$row['IdPartie']."</a></td>";
             list($Annee, $Mois, $Jour) = explode('-',$row['DatePartie']);
             $AN=substr($Annee, 0, 2);
             echo "<td style='font-size: 12px;width: '><b>".$Jour." ".$Mois." ".$AN."<b></td>";

             echo "<td style='text-align: right; '><b>".$row['Score']."</b></td>";
             echo "<td style='text-align: right; '></td>";

             echo "<td style='text-align: right; '><b>".$row['NbImp']."</b></td>";
             $PtParImp = number_format($row['Score'] / $row['NbImp'], 2, ',', ' ');
             echo "<td style='text-align: right; '><b>".$PtParImp."</b></td>";
             echo "<td style='width: '></td>";

             echo "<td style='text-align: center; '><b>".$row['NbBG']."</b></td>";
             echo "<td style='text-align: center; '><b>".$row['NbBD']."</b></td>";
             echo "<td style='width: '></td>";

             echo "<td style='width: ; text-align: center;'><b>".($row['pG']*100)."%</b></td>";
             echo "<td style='width: ; text-align: center;'><b>".($row['pD']*100)."%</b></td>";
             echo "<td style='width: '> </td>";

             echo "<td style='width: ; text-align: center;'><b>".($row['pH']*100)."%</b></td>";
             echo "<td style='width: ; text-align: center;'><b>".($row['pB']*100)."%</b></td>";
             echo "<td style='width: '> </td>";


             $dmoy = number_format($row['dmoy'], 2, ',', ' ');
             $dmin = number_format($row['dmin'], 2, ',', ' ');
             $dmax = number_format($row['dMax'], 2, ',', ' ');

             echo "<td style='text-align: right; '><b>".$dmoy." m</b></td>";
             echo "<td style='font-size: 14px;text-align: right; '>".$dmin." m</td>";
             echo "<td style='font-size: 14px;text-align: right; '>".$dmax." m</td>";

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

             echo "<td style='width: 10px'> </td>";
             $Dominale = $row['DminPartie']/100;
             echo "<td style='font-size: 12px;width: '>".$Dominale." mètres</td>";
             echo "<td style='font-size: 12px;width: '>".$row['c1Partie']."</td>";
             echo "<td style='font-size: 12px;width: '>".$row['c2Partie']."</td>";

             // echo "<td style='width: '> </td>";
             // echo "<td style='width: '> </td>";
             // echo "<td style='width: '> </td>";
             echo "</tr>";

             //Doonnée pr graphiques
             //['PArtie','Score','NbImpact','Nb Pts / IMpact','D moy'],  number_format($number, 2, '.', '');
             $LigneGraphiqueScore = $LigneGraphiqueScore.
             "['P".$row['IdPartie']." / ".$Jour.".".$Mois.".".$AN."',"
             .$row['Score'].","
             .($row['NbImp']*10).","
             //.number_format($PtParImp, 2, '.', '')."],"."\n";
             .(number_format($dmoy, 2, '.', '')*10)."],"."\n";

             //['PArtie','Score','NbImpact','Nb Pts / IMpact','D moy'],  number_format($number, 2, '.', '');
             $LigneGraphiquePoints = $LigneGraphiquePoints.
             "['P".$row['IdPartie']." / ".$Jour.".".$Mois.".".$AN."',"
             //.$row['Score'].","
             .$row['NbImp'].","
             .number_format($PtParImp, 2, '.', '').","
             .number_format($dmoy, 2, '.', '')."],"."\n";

             $iBoucleDuree = $iBoucleDuree + 1 ;
             //echo "iBoucleDurée=".$iBoucleDuree."<br>";



             $Duree=$row['DureePartie'];
         }
     }
     echo "</tbody>";
     echo "</table>";
     echo "<br>";


     $iDuree = $iDuree +1;
     // echo "iDuree Avant Condition iBoucleDuree =".$iDuree."<br>";
     // echo "iBoucleDurée Avant Condition iBoucleDuree =".$iBoucleDuree."<br>";
     //echo "iDuree="."$iDuree"."<br>";
     //echo "<div id='chart_point_".$i.'" style='width: 100%; height: 500px;' align='center'></div>";
     //echo "LigneGraphiquePoints avant include HORS boucle = ".$LigneGraphiquePoints."<br>";

     if ($iBoucleDuree > 2) {

         include 'PartiesJoueurChartsScore.php';
         include 'PartiesJoueurChartsImpact.php';

         echo "<br>";
         //echo "iDuree Dans Condition=".$iDuree."<br>";
         echo "<div id='chart_Score".$iDuree."' style='width: 100%; height: 500px;' align='center'></div>";

         echo "<br>";
         echo "<div id='chart_point".$iDuree."' style='width: 100%; height: 500px;' align='center'></div>";

         echo "<hr size='5'color='green'>";

     }

     // Deconnexion
     $bd = null;
?>
