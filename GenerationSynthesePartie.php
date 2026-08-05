<?php

include 'MenuDev.php';   // Ok.
include 'MenuIPassBall.php';  // Ok.
//include 'MenuStyleTable.php';
?>
<?php
/**
 * Exemple simple qui étend la classe SQLite3 et change les paramètres
 * __construct, puis, utilise la méthode de connexion pour initialiser la
 * base de données.
 */


include 'ConnexionBDDiPassBall.php';


//********
// PARTIES JOUEES

    // Lecture des donnees dans la table
    $Sql = "SELECT MAX(IdPartie) FROM ParametresPartie";

    /*$reponse = $bd->query($sql, SQLITE3_BOTH, $err);*/
    $Reponse = $bd->query($Sql);

    if ($Reponse === FALSE) {
        echo "La requete DonneesSessions a echouee pour la raison suivante: ".$err;
    }
    else {

    $Row = $Reponse->fetchArray();


    echo "<table style='width: 900px ; margin-left:auto;margin-right:auto;' border='0'";
    //echo "<tbody>";
    //echo "<thead>";

    echo "<tr>";

    echo "<td style='width: 450px'>";
    echo "Nombre de Parties ds table Partie = ";
    echo "</td>";

    echo "<td style='width: 450px'>";
    echo $Row['MAX(IdPartie)'];
    echo "</td>";

    $idPartieMin = $Row['MAX(IdPartie)'];

    echo "</tr>";
    }





// NOMBRE de parties dans Synthèse Sessions

    // Lecture des donnees dans la table
    $Sql = "SELECT MAX(IdPartie) FROM SyntheseDonneesParties";

    /*$reponse = $bd->query($sql, SQLITE3_BOTH, $err);*/
    $Reponse = $bd->query($Sql);

    if ($Reponse === FALSE) {
        echo "La requete SyntheseDonneesParties a echouee pour la raison suivante: ".$err;
    }
    else {

    $Row = $Reponse->fetchArray();
    echo "<tr>";

    echo "<td style=''>";
    echo "Nombre de Parties dans table Synthese = ";
    echo "</td>";

    echo "<td style=''>";
    echo $Row['MAX(IdPartie)'];
    echo "</td>";

    $idPartieMax = $Row['MAX(IdPartie)'];

    echo "</tr>";

    }





    echo "</table>";

    echo "<br>";






if ($idPartieMin>$idPartieMax) {


$SqlInsert = "INSERT INTO SyntheseDonneesParties (IdSession,IdPartie,IdJoueur,".
  "Tps,DTps,NbImp,".
  "Score,".
  "Dist,dmoy,dmin,dMax,Force,FMoy,Fmin,FMax,".
  "NbHGG,NbHG,NbBGG,NbBG,NbBD,NbBDD,NbHD,NbHDD,".
  "NbHS,".
  "NbHaut,NbBas,NbExtG,NbExtD,NbCentreD,NbCentreG,NbGauche,NbDroite,".
  "pHGG,pHG,pBGG,pBG,pBD,pBDD,pHD,pHDD,".
  "pH,pB,pExtG,pCG,pCD,pExtD,pG,pD".
  ") VALUES ";

for ($idpartie = $idPartieMax; $idpartie <= $idPartieMin; $idpartie+=1) {

echo $SqlInsert."<br>";
$sql = "Select IdSession,IdPartie,IdJoueur,Tps,DTps,MAX(NbImp),Score,Dist,dmoy,dmin,dMax,Force,FMoy,Fmin,FMax,NbHGG,NbHG,NbBGG,NbBG,NbBD,NbBDD,NbHD,NbHDD,NbHS,NbHaut,NbBas,NbExtG,NbExtD,NbCentreD,NbCentreG,NbGauche,NbDroite,pHGG,pHG,pBGG,pBG,pBD,pBDD,pHD,pHDD,pH,pB,pExtG,pCG,pCD,pExtD,pG,pD from DonneesParties ".
" WHERE idpartie =".$idpartie;

//echo $sql."<br>";

$reponse = $bd->query($sql);
$row = $reponse->fetchArray();
//echo "Idsession=".$row['IdSession']." IdPartie=".$row['IdPartie']." IdJoueur=".$row['IdJoueur']."<br>";

echo "("
.$row['IdSession'].",".$row['IdPartie'].",".$row['IdJoueur'].",".
$row['Tps'].",".$row['DTps'].",".$row['MAX(NbImp)'].",".
$row['Score'].",".
$row['Dist'].",".$row['dmoy'].",".$row['dmin'].",".$row['dMax'].",".$row['Force'].",".$row['FMoy'].",".$row['Fmin'].",".$row['FMax'].",".
$row['NbHGG'].",".$row['NbHG'].",".$row['NbBGG'].",".$row['NbBG'].",".$row['NbBD'].",".$row['NbBDD'].",".$row['NbHD'].",".$row['NbHDD'].",".
$row['NbHS'].",".
$row['NbHaut'].",".$row['NbBas'].",".$row['NbExtG'].",".$row['NbExtD'].",".$row['NbCentreD'].",".$row['NbCentreG'].",".$row['NbGauche'].",".$row['NbDroite'].",".
$row['pHGG'].",".$row['pHG'].",".$row['pBGG'].",".$row['pBG'].",".$row['pBD'].",".$row['pBDD'].",".$row['pHD'].",".$row['pHDD'].",".
$row['pH'].",".$row['pB'].",".$row['pExtG'].",".$row['pCG'].",".$row['pCD'].",".$row['pExtD'].",".$row['pG'].",".$row['pD'].
");";

//");";

// Lecture des donnees dans la table
// $sql = "INSERT INTO SyntheseDonneesParties (IdSession,IdPartie,IdJoueur,Tps,DTps,NbImp,Cible,NbPt,Score,PtParImp,dist,dmoy,dmin,dMax,Force,Fmoy,Fmin,FMax, NbHGG,NbHG,NbBGG,NbBG,NbBD,NbBDD,NbHD,NbHDD,NbHS,NbHaut,NbBas,NbExtG,NbExtD,NbCentreD,NbCentreG,NbGauche,NbDroite, pHGG,pHG,pBGG,pBG,pBD,pBDD,pHD,pHDD,pH,pB,pExtG,pCG,pCD,pExtD,pG,pD) ".
// "Select IdSession,IdPartie,IdJoueur,Tps,DTps,MAX(NbImp),Cible,NbPt,Score,PtParImp,dist,dmoy,dmin,dMax,Force,Fmoy,Fmin,FMax, NbHGG,NbHG,NbBGG,NbBG,NbBD,NbBDD,NbHD,NbHDD,NbHS,NbHaut,NbBas,NbExtG,NbExtD,NbCentreD,NbCentreG,NbGauche,NbDroite, pHGG,pHG,pBGG,pBG,pBD,pBDD,pHD,pHDD,pH,pB,pExtG,pCG,pCD,pExtD,pG,pD from DonneesParties".
// " WHERE idpartie =".$idpartie;

// $sql = "INSERT INTO SyntheseDonneesParties (IdSession,IdPartie,IdJoueur)".
// " VALUES (1,".$idpartie.",1)";
//
// // $sql = "Select IdSession,IdPartie,IdJoueur,Tps,DTps,MAX(NbImp),Cible,NbPt,Score,PtParImp,dist,dmoy,dmin,dMax,Force,Fmoy,Fmin,FMax, NbHGG,NbHG,NbBGG,NbBG,NbBD,NbBDD,NbHD,NbHDD,NbHS,NbHaut,NbBas,NbExtG,NbExtD,NbCentreD,NbCentreG,NbGauche,NbDroite, pHGG,pHG,pBGG,pBG,pBD,pBDD,pHD,pHDD,pH,pB,pExtG,pCG,pCD,pExtD,pG,pD from DonneesParties".
// // " WHERE idpartie =".$idpartie;
//
// echo $idpartie." SQL = ".$sql."<br>";
//
// /*$reponse = $bd->query($sql, SQLITE3_BOTH, $err);*/
// //$reponse = $bd->query($sql);
// //$bd->exec($sql);
//
// //$bd->exec($sql, $err);
// $reponse = $bd->query($sql);
// //$reponse = $bd->exec($sql);
//
// //$row = $reponse->fetchArray();
//
// if ($reponse === FALSE) {
//     echo "La requête a échouée pour la raison suivante : ".$err."<br>";
// } else {
//     //echo "Idsession=".$row['IdSession']." IdPartie=".$row['IdPartie']." IdJoueur=".$row['IdJoueur']."<br>";
//     echo " IdPartie= ".$idpartie."<br>";
//     echo "Un nouvel enregistrement a été ajouté à la base";
//     echo "<br>";
// }


echo "<br>";
}

} else {

echo "<h2>>>> Les tables sont en phase</h2>";

}


// Deconnexion
$bd = null;
?>
