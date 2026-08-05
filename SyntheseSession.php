<?php

include 'MenuIPassBall.php';  // Ok.
include_once 'Security.php';
//include 'MenuStyleTable.php';

?>

<?php
/**
 * Exemple simple qui étend la classe SQLite3 et change les paramètres
 * __construct, puis, utilise la méthode de connexion pour initialiser la
 * base de données.
 */
include 'ConnexionBDDiPassBall.php';


$IdSession = app_get_int("IdSession");
//echo "<br>IdSession = ".$IdSession;

$DureeSession = app_get_int("DureeSession");

$DateSession = app_get_string("DateSession");

/*$ Données SynthèseDonnéesPartie*/
$sqlResultatsSession = "SELECT * FROM SyntheseDonneesParties WHERE IdSession=".$IdSession." ORDER BY Score DESC";
//echo $sqlResultatsSession;

/*$reponse = $bd->query($sql, SQLITE3_BOTH, $err);*/
$reponse = $bd->query($sqlResultatsSession);
if ($reponse === FALSE) {
    echo "La requete a echouee pour la raison suivante: ".$err;
} else {

    if ($DureeSession > 60 ) {

       $DureePartie = $DureeSession/60;
       $StringDureePartie = $DureePartie." Minute(s)";
    }
    else {
      $DureePartie = $DureeSession;
      $StringDureePartie = $DureePartie." Secondes";
    }

    echo "<h1>&nbspClassement Session n°".$IdSession." du ".$DateSession." <br>&nbsp>>> Durée des parties : ".$StringDureePartie." </h1>";

    echo "<h4><u>LEGENDE : </u><br><br>";
    echo "<i style='color: black; text-transform: italic;'>";
    echo "C : Classement ; #p = n° de partie ;<br>";
    echo "Imp = nombre d'impacts ; Pts / Imp = nb de points par impact <br>";
    echo "5g: Nb de Cibles '5'gauche touchées ; 5d : Nb de Cible '5'droite	touchées<br>";
    echo "G : Nb de Cibles de Gauche touchées; D : Nb de cibles de Droite touchées<br>";
    echo "H	: Nb de Cibles 'Hautes' ; B : Nb de cibles 'Basses' touchées</h4><br>";
    echo "</i>";



    echo "<table style='width: ; margin-left:auto;margin-right:auto;' border='0'";
    echo "<tbody>";
    echo "<thead>";
    echo "<tr>";
    /*IdSession ,IdPartie , NomJoueur , PrenomJoueur , Score , Nb Impact , Dmoy ,Dmin , Dmax , NbBG, NbBD*/
    //echo "<td style='width: 30px'>#S</td>";
    echo "<td style='width: 25px; text-align: center;'><b>C</b></td>";
    echo "<td style='width: 10px'></td>";
    echo "<td style='width: 30px; text-align: center;'>#p</td>";


    echo "<td style='width: 50px'><b>Code</b></td>";
    echo "<td style='width: 100px'>Prénom</td>";
    echo "<td style='width: 50px'><b>Score</b></td>";
    echo "<td style='width: 15px'> </td>";

    echo "<td style='width: 50px; font-size: 14px;text-align: center;'><b>Nb Imp</b></td>";
    echo "<td style='width: 80px; font-size: 15px;text-align: center;'><b>Pts / Imp</td><b>";
    echo "<td style='width: 15px'> </td>";

    echo "<td style='width: 50px; text-align: center;'><b>5g</b></td>";
    echo "<td style='width: 50px; text-align: center;'><b>5d</b></td>";
    echo "<td style='width: 15px'> </td>";

    echo "<td style='width: 50px; text-align: center;'><b>G</b></td>";
    echo "<td style='width: 50px; text-align: center;'><b>D</b></td>";
    echo "<td style='width: 15px'> </td>";

    echo "<td style='width: 50px; text-align: center;'><b>H</b></td>";
    echo "<td style='width: 50px; text-align: center;'><b>B</b></td>";
    echo "<td style='width: 15px'> </td>";

    echo "<td style='width: 80px'><b>D moy</b></td>";
    echo "<td style='width: 60px'>D min</td>";
    echo "<td style='width: 60px'>D Max</td>";



    echo "</thead>";
    echo "</tr>";

    // Init des valeurs min et max
    $ImpMin = 0;
    $ImpMax = 0;

    $PtsImpMin = 0;
    $PtsImpMax = 0;

    $CinqGMin = 0;
    $CinqGMax = 0;

    $CinqDMin = 0;
    $CinqDMax = 0;

    $GMin = 0;
    $GMax = 0;

    $DMin = 0;
    $DMax = 0;



    $i=1;

    while ($row = $reponse->fetchArray()) {
        /*IdSession ,IdPartie , NomJoueur , PrenomJoueur , Score , Nb Impact , Dmoy ,Dmin , Dmax , NbBG, NbBD*/

        if (($i % 2) == 0) echo "<tr style='background-color: #a4b780;'>"; else echo "<tr style='background-color: #e9f0ea;'>";
        //echo "<tr style='background-color: #a4b780;'>";
        //echo "<td style='width: '><a href='PartiesJoueur.php?IdJ=".$row['IdJoueur']."&NomJ=".$row['NomJoueur']."&PrenomJ=".$row['PrenomJoueur']."'>".$row['IdJoueur']."</a></td>";

        //echo "<td style='text-align: right; '>".$row['IdSession']."</td>";
        echo "<td style='text-align: center;text-align: right; '><b>".$i."</b></td>";
        echo "<td style='width: '> </td>";
        echo "<td style='text-align: right; '>".$row['IdPartie']."</td>";


        // Info Joueur
$sqlJoueur = "SELECT * FROM Joueurs WHERE IdJoueur=".$row['IdJoueur'];
$reponseJ = $bd->query($sqlJoueur);
$rowJ = $reponseJ->fetchArray();

        $InitialeNom=substr($rowJ['NomJoueur'], 0,1);
        echo "<td style='width: ;text-align: right;'><b>".$rowJ['CodeJoueur']."</td>";

        echo "<td style='width: '>".$rowJ['PrenomJoueur']." ".$InitialeNom."</td>";
        echo "<td style='text-align: right; '><b>".$row['Score']."</b></td>";
        echo "<td style='text-align: right; '></td>";

        echo "<td style='text-align: right; '><b>".$row['NbImp']."</b></td>";
        $PtParImp = number_format($row['Score'] / $row['NbImp'], 2, ',', ' ');
        echo "<td style='text-align: right; '><b>".$PtParImp."</b></td>";
        echo "<td style='width: '></td>";

        echo "<td style='text-align: center; '><b>".$row['NbBG']."</b></td>";
        echo "<td style='text-align: center; '><b>".$row['NbBD']."</b></td>";
        echo "<td style='width: '></td>";

        echo "<td style='width: ; text-align: right;'><b>".($row['pG']*100)."%</b></td>";
        echo "<td style='width: ; text-align: right;'><b>".($row['pD']*100)."%</b></td>";
        echo "<td style='width: '> </td>";

        echo "<td style='width: ; text-align: right;'><b>".($row['pH']*100)."%</b></td>";
        echo "<td style='width: ; text-align: right;'><b>".($row['pB']*100)."%</b></td>";
        echo "<td style='width: '> </td>";


        $dmoy = number_format($row['dmoy'], 2, ',', ' ');
        $dmin = number_format($row['dmin'], 2, ',', ' ');
        $dmax = number_format($row['dMax'], 2, ',', ' ');

        echo "<td style='text-align: right; '><b>".$dmoy." m</b></td>";
        echo "<td style='text-align: right; font-size: 15px;'>".$dmin." m</td>";
        echo "<td style='text-align: right; font-size: 15px;'>".$dmax." m</td>";

        $i=$i+1;

        echo "</tr>";


        /*IdJoueur ,CodeJoueur , NomJoueur , PrenomJoueur , DateNaissanceJoueur , TelJoueur , MailJoueur ,OrigineCoordJoueur*/
    }
}
echo "</tbody>";
echo "</table>";
echo "<br>";

include 'SyntheseSessionGraphI.php';

echo "<br>";

include 'SyntheseSessionGraphII.php';

echo "<br>";

echo "<hr size='5'color='green'>";








//echo "<br>sqlDonneesSession = ".$sqlDonneesSession;

$reponseResultatsSession = $bd->query($sqlResultatsSession);

if ($reponseResultatsSession === FALSE)
    echo "La requete DonneesSession a echouee pour la raison suivante: ".$err;

$rowResultatsSession = $reponseResultatsSession->fetchArray();


//echo "<br>IdSession = ".$IdSession;
/*$ Données Partie*/
$sqlDonneesSession = "SELECT * FROM DonneesSession where IdSession=".$IdSession."";

//echo "<br>sqlDonneesSession = ".$sqlDonneesSession;

$reponseDonneesSession = $bd->query($sqlDonneesSession);

if ($reponseDonneesSession === FALSE)
    echo "La requete DonneesSession a echouee pour la raison suivante: ".$err;

$rowDonneesSession = $reponseDonneesSession->fetchArray();

//echo "<br>rowDonneesSession = ".$rowDonneesSession[1];
list($Annee, $Mois, $Jour) = explode('-',$rowDonneesSession['DateSession']);

echo "<br><h1>Données de la Session n°".$IdSession." du ".$Jour."/".$Mois."/".$Annee."</h1>";
// echo "<hr size='5'color='green'>";
// echo "<hr size='5'color='green'>";

for ($joueur = 2 ; $joueur <= 9; $joueur+=1) {

//echo "<br>joueur = ".$joueur;
$IdP = $rowDonneesSession[$joueur];


$sql = "SELECT IdJoueur FROM ParametresPartie where IdPartie=".$IdP;
//echo $sql."<br>";
//echo "<br>sqlDonneesSession = ".$sqlDonneesSession;

//$reponse = $bd->query($sql);

  if ($IdP <> ""){

    //echo $sql."<br>";
    $reponse = $bd->query($sql);
    $row = $reponse->fetchArray();

    $IdJ = $row['IdJoueur'];
    //echo "IdJoueur: ".$IdJ;

    //echo "<br>IdP = ".$rowDonneesSession[$joueur]."<br>";
          if ($rowDonneesSession[$joueur]<>""){
          include 'SynthesePartieSession.php';
          }
    //echo "La requete ParametresPartie a echouee pour la raison suivante: ".$err;
  }

}
?>
