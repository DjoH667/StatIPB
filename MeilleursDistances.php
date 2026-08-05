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
$Sql = "SELECT IdSession, IdPartie, NbImp, IdJoueur, Cible, Dist FROM DonneesParties where Cible='BG' OR Cible='BD' ORDER BY Dist DESC LIMIT 100 ";
//echo $Sql."<br>";

echo "<h1>";
echo "Classement des 100 Passes Les Plus Longues";
echo "</h1>";


/*$reponse = $bd->query($sql, SQLITE3_BOTH, $err);*/
$Reponse = $bd->query($Sql);

if ($Reponse === FALSE) {
    echo "La requete DonneesSessions a echouee pour la raison suivante: ".$err;
}
else {



$i=0;

  while ($Row = $Reponse->fetchArray()) {

if ($i%10==0){


Include 'MeilleursDistancesEnTete.php';

}

$i=$i+1;
                // Lecture des donnees dans la table
                $SqlJoueur = "SELECT * FROM Joueurs where IdJoueur=".$Row['IdJoueur'];
                //echo $SqlJoueur;
                /*$reponse = $bd->query($sql, SQLITE3_BOTH, $err);*/
                $ReponseJoueur = $bd->query($SqlJoueur);

                if ($ReponseJoueur === FALSE) {
                    echo "La requete DonneesSessions a echouee pour la raison suivante: ".$err;
                }
                else {

                $RowJoueur = $ReponseJoueur->fetchArray();
                }

                // Lecture des donnees dans la table
                $SqlPartie = "SELECT * FROM SyntheseDonneesParties where IdPartie=".$Row['IdPartie'];
                //echo $SqlPartie;
                /*$reponse = $bd->query($sql, SQLITE3_BOTH, $err);*/
                $ReponsePartie = $bd->query($SqlPartie);

                if ($ReponsePartie === FALSE) {
                    echo "La requete DonneesSessions a echouee pour la raison suivante: ".$err;
                }
                else {

                $RowPartie = $ReponsePartie->fetchArray();
                }

            // //echo "<a href='MeilleursDistances.php'>";
            // echo "Cible ".$Row['Cible']." atteinte à ".$Row['Dist']." mètres par ".$RowJoueur['CodeJoueur'];
            // //echo "Passe la plus longue sur cible 5g ou 5d : ".$Row['MAX(Dist)']." mètres par ".$RowJoueur['CodeJoueur']." Le ".$RowPartie['DatePartie'];
            // //echo "</a>";
            // echo "<br>";

            echo "<tr>";
            // echo "<td style='width: 15px'> </td>";
            // echo "<td style='width: 15px'> </td>";
            echo "<td style='text-align: right; '><b>".$i."</b></td>";
            echo "<td style='text-align: right; '></td>";

            //echo "<td style='text-align: right;'><b>IdJoueur</b></td>";
            echo "<td style='text-align: right; '>".$Row['Dist']." m</td>";
            echo "<td style='text-align: right; '>".$RowJoueur['CodeJoueur']."</td>";

            echo "<td style='text-align: right; '></td>";
            echo "<td style='text-align: right; '><a href='SynthesePartie.php?IdJ=".$row['IdJoueur']."&IdP=".$Row['IdPartie']."'>".$Row['IdPartie']."</a></td>";
            echo "<td style='text-align: right; '>".$Row['NbImp']."/".$RowPartie['NbImp']."</td>";
            echo "<td style='text-align: right; '><a href='SyntheseSession.php?IdSession=".$Row['IdSession']."'>".$Row['IdSession']."</a></td>";
            echo "<td style='text-align: right; '></td>";

            // echo "<td style='text-align: right; '><b>Nom</b></td>";
            //
            // echo "<td style='text-align: right;'><b></b></td>";
            //
            // echo "<td style='text-align: right; '><b>Score</b></td>";
            // echo "<td style='text-align: right; '> </td>";
            //
            // echo "<td style='text-align: right; '><b>Imp</b></td>";
            // echo "<td style='text-align: right; '>Pts / Imp</td>";
            // echo "<td style='text-align: right; '> </td>";
            //
            // echo "<td style='text-align: right;'><b>D moy</b></td>";
            // echo "<td style='text-align: right; '><b>D min</b></td>";
            // echo "<td style='text-align: right; '><b>D Max</b></td>";
            //
            //
            // echo "<td style='text-align: right; '><b></b></td>";
            //
            // //echo "<td style='text-align: right; '><b>Duree</b></td>";
            // echo "<td style='text-align: right; '><b>D Nominale</b></td>";
            // echo "<td style='text-align: right; '><b>c1/c2</b></td>";
            //
            // echo "<td style='text-align: right; '></td>";
            // echo "<td style='text-align: right; '><b>Date</b></td>";

            echo "</tr>";

            }




}

echo "</tbody>";
echo "</table>";
echo "<br>";
//echo "<hr size='5'color='green'>";
// Deconnexion
$bd = null;
?>
