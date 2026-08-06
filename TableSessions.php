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
$sql = "SELECT * FROM DonneesSession ORDER BY IdSession DESC";
//$sql = "SELECT * FROM DonneesSession Order by DateSession";
/*$reponse = $bd->query($sql, SQLITE3_BOTH, $err);*/
$reponse = $bd->query($sql);
if ($reponse === FALSE) {
    echo "La requete DonneesSessions a echouee pour la raison suivante: ".$err;
} else {
    echo "<h1>SESSIONS JOUEES :<br>";
    echo "<i style='color: white; text-transform: italic;font-size: 24px;'>";
    echo ">>> Par date de Session décroissante";
    echo "</i>";
    echo "</h1>";


    echo "<h4><u>LEGENDE : </u><br><br>";

    //echo "<table style=''border='1'>";
echo "<i style='color: black; text-transform: italic;'>";
    echo "";
    echo "<b>#S</b>  = n° de Session <br>";
    echo ">> Cliquer pour avoir le détail de la Session et le détail de la Session<br>";
    echo "<br>";

    echo "";
    echo "J 0X = Joueur n°X dans le déroulement de la session<br>";
    echo "Dans le tableau, Trigramme du Joueur ayant participer a cette session <br>";
    echo " >> Cliquer pour avoir le détail de la Partie en question<br>";
    echo "<br>";

    echo "";
    echo "Classement <br>";
    echo ">> Cliquer pour avoir le classement et le détail de la Session<br>";
    echo "";
echo "</i>";
    //echo "</table>";

    echo "<br>";


    echo "<center>";
    //echo "<table style='width: 100%;'border='0'>";
    echo "<table style=''border='0'>";
    echo "<tbody>";
    echo "<thead>";
    echo "<tr>";
      echo "<td style='font-size: 12px;width: 12px'><b>#S</b></td>";
      echo "<td style='text-align: center;font-size: 18px;width: 80px'><b>Date</b></td>";

      echo "<td style='text-align: center;font-size: 18px;width: 60px'><b>J 01</b></td>";
      echo "<td style='text-align: center;font-size: 18px;width: 60px'><b>J 02</b></td>";
      echo "<td style='text-align: center;font-size: 18px;width: 60px'><b>J 03</b></td>";
      echo "<td style='text-align: center;font-size: 18px;width: 60px'><b>J 04</b></td>";
      echo "<td style='text-align: center;font-size: 18px;width: 60px'><b>J 05</b></td>";
      echo "<td style='text-align: center;font-size: 18px;width: 60px'><b>J 06</b></td>";
      echo "<td style='text-align: center;font-size: 18px;width: 60px'><b>J 07</b></td>";
      echo "<td style='text-align: center;font-size: 18px;width: 60px'><b>J 08</b></td>";
      echo "<td style='text-align: center;font-size: 18px;width: 60px'><b>J 09</b></td>";
      echo "<td style='text-align: center;font-size: 18px;width: 60px'><b>J 10</b></td>";
      echo "<td style='text-align: center;font-size: 18px;width: 60px'><b>J 11</b></td>";

      echo "<td style='text-align: center;font-size: 16px;width: 100px'><b>Classement</b></td>";
    echo "</tr>";
    echo "</thead>";

    function LireDureeSession($bd, $row)
    {
        for ($iJoueur = 1; $iJoueur <= 11; $iJoueur += 1) {
            $ChampPartie = sprintf('IdPartieJoueur%02d', $iJoueur);
            if (!empty($row[$ChampPartie])) {
                $IdPartie = (int) $row[$ChampPartie];
                $ReponseDuree = $bd->query("SELECT DureePartie FROM ParametresPartie WHERE IdPartie=".$IdPartie);
                if ($ReponseDuree !== false) {
                    $RowDuree = $ReponseDuree->fetchArray();
                    if ($RowDuree !== false && isset($RowDuree['DureePartie'])) {
                        return $RowDuree['DureePartie'];
                    }
                }
            }
        }

        return 0;
    }



    while ($row = $reponse->fetchArray()) {

      echo "<tr>";
        list($Annee, $Mois, $Jour) = explode('-',$row['DateSession']);
        $AN=substr($Annee, 0, 2);
        $DateSession = $Jour."/".$Mois."/".$Annee;
        $DureeSession = LireDureeSession($bd, $row);

        echo "<td style='text-align: right;font-size: 12px'><a href='SyntheseSession.php?IdSession=".$row['IdSession']."&DureeSession=".$DureeSession."&DateSession=".$DateSession."'>".$row['IdSession']."</a></td>";
        // echo "<td style='text-align: center;font-size: 18px'>".$row['IdSession']."</td>";


        echo "<td style='text-align: center;font-size: 18px'>".$Jour." ".$Mois." ".$AN."</td>";

        if ($row['IdPartieJoueur01']<>"")
                {
                $sqlDonnesJoueur = " SELECT MAX(Score),  Joueurs.IdJoueur, CodeJoueur, PrenomJoueur, NomJoueur   FROM Joueurs INNER JOIN DonneesParties ON Joueurs.IdJoueur = DonneesParties.IdJoueur where idPartie=".$row['IdPartieJoueur01'];

                $reponseDonnesJoueur = $bd->query($sqlDonnesJoueur);
                $rowDonnesJoueur = $reponseDonnesJoueur->fetchArray();
                //$DonnesJoueur= $rowDonnesJoueur['MAX(Score)']." Pts ".$rowDonnesJoueur['CodeJoueur']." / ".$rowDonnesJoueur['PrenomJoueur']." ".$rowDonnesJoueur['NomJoueur'];
                //$DonnesJoueur= $rowDonnesJoueur['CodeJoueur'].":".$rowDonnesJoueur['MAX(Score)'];
                $DonnesJoueur= $rowDonnesJoueur['CodeJoueur'];
                $IdJoueur = $rowDonnesJoueur['IdJoueur'];

                echo "<td style='text-align: center;font-size: 20px'><a href='SynthesePartie.php?IdJ=".$IdJoueur."&IdP=".$row['IdPartieJoueur01']."'>".$DonnesJoueur."</a></td>";

                $sqlParametresPartieJoueur = " SELECT * FROM ParametresPartie WHERE IdPartie=".$row['IdPartieJoueur01'];
                // echo "sqlParametresPartieJoueur = ". $sqlParametresPartieJoueur;
                // echo "<br>";
                $reponseParametresPartieJoueur = $bd->query($sqlParametresPartieJoueur);
                $rowParametresPartieJoueur = $reponseParametresPartieJoueur !== false ? $reponseParametresPartieJoueur->fetchArray() : false;

                if ($rowParametresPartieJoueur !== false && isset($rowParametresPartieJoueur['DureePartie'])) {
                    $DureeSession = $rowParametresPartieJoueur['DureePartie'];
                }
                // echo "DureeSession = ". $DureeSession;
                // echo "<br>";

                }
                else {

                  echo "<td></td>";

                }

        if ($row['IdPartieJoueur02']<>"")
                {
                $sqlDonnesJoueur = " SELECT MAX(Score),  Joueurs.IdJoueur, CodeJoueur, PrenomJoueur, NomJoueur   FROM Joueurs INNER JOIN DonneesParties ON Joueurs.IdJoueur = DonneesParties.IdJoueur where idPartie=".$row['IdPartieJoueur02'];

                $reponseDonnesJoueur = $bd->query($sqlDonnesJoueur);
                $rowDonnesJoueur = $reponseDonnesJoueur->fetchArray();
                //$DonnesJoueur= $rowDonnesJoueur['MAX(Score)']." Pts ".$rowDonnesJoueur['CodeJoueur']." / ".$rowDonnesJoueur['PrenomJoueur']." ".$rowDonnesJoueur['NomJoueur'];
                $DonnesJoueur= $rowDonnesJoueur['CodeJoueur'];
                $IdJoueur = $rowDonnesJoueur['IdJoueur'];

                echo "<td style='text-align: center;font-size: 20px'><a href='SynthesePartie.php?IdJ=".$IdJoueur."&IdP=".$row['IdPartieJoueur02']."'>".$DonnesJoueur."</a></td>";
                }
                else {

                  echo "<td></td>";

                }


        if ($row['IdPartieJoueur03']<>"")
                {
                $sqlDonnesJoueur = " SELECT MAX(Score),  Joueurs.IdJoueur, CodeJoueur, PrenomJoueur, NomJoueur   FROM Joueurs INNER JOIN DonneesParties ON Joueurs.IdJoueur = DonneesParties.IdJoueur where idPartie=".$row['IdPartieJoueur03'];
                $reponseDonnesJoueur = $bd->query($sqlDonnesJoueur);
                $rowDonnesJoueur = $reponseDonnesJoueur->fetchArray();
                //$DonnesJoueur= $rowDonnesJoueur['MAX(Score)']." Pts ".$rowDonnesJoueur['CodeJoueur']." / ".$rowDonnesJoueur['PrenomJoueur']." ".$rowDonnesJoueur['NomJoueur'];
                $DonnesJoueur= $rowDonnesJoueur['CodeJoueur'];
                $IdJoueur = $rowDonnesJoueur['IdJoueur'];

                echo "<td style='text-align: center;font-size: 20px'><a href='SynthesePartie.php?IdJ=".$IdJoueur."&IdP=".$row['IdPartieJoueur03']."'>".$DonnesJoueur."</a></td>";
                }
                else {

                  echo "<td></td>";

                }
        if ($row['IdPartieJoueur04']<>"")
                {
                $sqlDonnesJoueur = " SELECT MAX(Score),  Joueurs.IdJoueur, CodeJoueur, PrenomJoueur, NomJoueur   FROM Joueurs INNER JOIN DonneesParties ON Joueurs.IdJoueur = DonneesParties.IdJoueur where idPartie=".$row['IdPartieJoueur04'];
                $reponseDonnesJoueur = $bd->query($sqlDonnesJoueur);
                $rowDonnesJoueur = $reponseDonnesJoueur->fetchArray();
                //$DonnesJoueur= $rowDonnesJoueur['MAX(Score)']." Pts ".$rowDonnesJoueur['CodeJoueur']." / ".$rowDonnesJoueur['PrenomJoueur']." ".$rowDonnesJoueur['NomJoueur'];
                $DonnesJoueur= $rowDonnesJoueur['CodeJoueur'];
                $IdJoueur = $rowDonnesJoueur['IdJoueur'];

                echo "<td style='text-align: center;font-size: 20px'><a href='SynthesePartie.php?IdJ=".$IdJoueur."&IdP=".$row['IdPartieJoueur04']."'>".$DonnesJoueur."</a></td>";
                }
                else {

                  echo "<td></td>";

                }

        if ($row['IdPartieJoueur05']<>"")
                {
                $sqlDonnesJoueur = " SELECT MAX(Score),  Joueurs.IdJoueur, CodeJoueur, PrenomJoueur, NomJoueur   FROM Joueurs INNER JOIN DonneesParties ON Joueurs.IdJoueur = DonneesParties.IdJoueur where idPartie=".$row['IdPartieJoueur05'];

                $reponseDonnesJoueur = $bd->query($sqlDonnesJoueur);
                $rowDonnesJoueur = $reponseDonnesJoueur->fetchArray();
                //$DonnesJoueur= $rowDonnesJoueur['MAX(Score)']." Pts ".$rowDonnesJoueur['CodeJoueur']." / ".$rowDonnesJoueur['PrenomJoueur']." ".$rowDonnesJoueur['NomJoueur'];
                $DonnesJoueur= $rowDonnesJoueur['CodeJoueur'];
                $IdJoueur = $rowDonnesJoueur['IdJoueur'];

                echo "<td style='text-align: center;font-size: 20px'><a href='SynthesePartie.php?IdJ=".$IdJoueur."&IdP=".$row['IdPartieJoueur05']."'>".$DonnesJoueur."</a></td>";

                }
                else {

                  echo "<td></td>";

                }

        if ($row['IdPartieJoueur06']<>"")
                {
                $sqlDonnesJoueur = " SELECT MAX(Score),  Joueurs.IdJoueur, CodeJoueur, PrenomJoueur, NomJoueur   FROM Joueurs INNER JOIN DonneesParties ON Joueurs.IdJoueur = DonneesParties.IdJoueur where idPartie=".$row['IdPartieJoueur06'];

                $reponseDonnesJoueur = $bd->query($sqlDonnesJoueur);
                $rowDonnesJoueur = $reponseDonnesJoueur->fetchArray();
                //$DonnesJoueur= $rowDonnesJoueur['MAX(Score)']." Pts ".$rowDonnesJoueur['CodeJoueur']." / ".$rowDonnesJoueur['PrenomJoueur']." ".$rowDonnesJoueur['NomJoueur'];
                $DonnesJoueur= $rowDonnesJoueur['CodeJoueur'];
                $IdJoueur = $rowDonnesJoueur['IdJoueur'];

                echo "<td style='text-align: center;font-size: 20px'><a href='SynthesePartie.php?IdJ=".$IdJoueur."&IdP=".$row['IdPartieJoueur06']."'>".$DonnesJoueur."</a></td>";

                }
                else {

                  echo "<td></td>";

                }

        if ($row['IdPartieJoueur07']<>"")
                {
                $sqlDonnesJoueur = " SELECT MAX(Score),  Joueurs.IdJoueur, CodeJoueur, PrenomJoueur, NomJoueur   FROM Joueurs INNER JOIN DonneesParties ON Joueurs.IdJoueur = DonneesParties.IdJoueur where idPartie=".$row['IdPartieJoueur07'];

                $reponseDonnesJoueur = $bd->query($sqlDonnesJoueur);
                $rowDonnesJoueur = $reponseDonnesJoueur->fetchArray();
                //$DonnesJoueur= $rowDonnesJoueur['MAX(Score)']." Pts ".$rowDonnesJoueur['CodeJoueur']." / ".$rowDonnesJoueur['PrenomJoueur']." ".$rowDonnesJoueur['NomJoueur'];
                $DonnesJoueur= $rowDonnesJoueur['CodeJoueur'];
                $IdJoueur = $rowDonnesJoueur['IdJoueur'];

                echo "<td style='text-align: center;font-size: 20px'><a href='SynthesePartie.php?IdJ=".$IdJoueur."&IdP=".$row['IdPartieJoueur07']."'>".$DonnesJoueur."</a></td>";

                }
                else {

                  echo "<td></td>";

                }

        if ($row['IdPartieJoueur08']<>"")
                {
                $sqlDonnesJoueur = " SELECT MAX(Score),  Joueurs.IdJoueur, CodeJoueur, PrenomJoueur, NomJoueur   FROM Joueurs INNER JOIN DonneesParties ON Joueurs.IdJoueur = DonneesParties.IdJoueur where idPartie=".$row['IdPartieJoueur08'];

                $reponseDonnesJoueur = $bd->query($sqlDonnesJoueur);
                $rowDonnesJoueur = $reponseDonnesJoueur->fetchArray();
                //$DonnesJoueur= $rowDonnesJoueur['MAX(Score)']." Pts ".$rowDonnesJoueur['CodeJoueur']." / ".$rowDonnesJoueur['PrenomJoueur']." ".$rowDonnesJoueur['NomJoueur'];
                $DonnesJoueur= $rowDonnesJoueur['CodeJoueur'];
                $IdJoueur = $rowDonnesJoueur['IdJoueur'];

                echo "<td style='text-align: center;font-size: 20px'><a href='SynthesePartie.php?IdJ=".$IdJoueur."&IdP=".$row['IdPartieJoueur08']."'>".$DonnesJoueur."</a></td>";

                }
                else {

                  echo "<td></td>";

                }

        if ($row['IdPartieJoueur09']<>"")
                {
                $sqlDonnesJoueur = " SELECT MAX(Score),  Joueurs.IdJoueur, CodeJoueur, PrenomJoueur, NomJoueur   FROM Joueurs INNER JOIN DonneesParties ON Joueurs.IdJoueur = DonneesParties.IdJoueur where idPartie=".$row['IdPartieJoueur09'];

                $reponseDonnesJoueur = $bd->query($sqlDonnesJoueur);
                $rowDonnesJoueur = $reponseDonnesJoueur->fetchArray();
                //$DonnesJoueur= $rowDonnesJoueur['MAX(Score)']." Pts ".$rowDonnesJoueur['CodeJoueur']." / ".$rowDonnesJoueur['PrenomJoueur']." ".$rowDonnesJoueur['NomJoueur'];
                $DonnesJoueur= $rowDonnesJoueur['CodeJoueur'];
                $IdJoueur = $rowDonnesJoueur['IdJoueur'];

                echo "<td style='text-align: center;font-size: 20px'><a href='SynthesePartie.php?IdJ=".$IdJoueur."&IdP=".$row['IdPartieJoueur09']."'>".$DonnesJoueur."</a></td>";

                }
                else {

                  echo "<td></td>";

                }

          if ($row['IdPartieJoueur10']<>"")
                  {
                  $sqlDonnesJoueur = " SELECT MAX(Score),  Joueurs.IdJoueur, CodeJoueur, PrenomJoueur, NomJoueur   FROM Joueurs INNER JOIN DonneesParties ON Joueurs.IdJoueur = DonneesParties.IdJoueur where idPartie=".$row['IdPartieJoueur10'];

                  $reponseDonnesJoueur = $bd->query($sqlDonnesJoueur);
                  $rowDonnesJoueur = $reponseDonnesJoueur->fetchArray();
                  //$DonnesJoueur= $rowDonnesJoueur['MAX(Score)']." Pts ".$rowDonnesJoueur['CodeJoueur']." / ".$rowDonnesJoueur['PrenomJoueur']." ".$rowDonnesJoueur['NomJoueur'];
                  $DonnesJoueur= $rowDonnesJoueur['CodeJoueur'];
                  $IdJoueur = $rowDonnesJoueur['IdJoueur'];

                  echo "<td style='text-align: center;font-size: 20px'><a href='SynthesePartie.php?IdJ=".$IdJoueur."&IdP=".$row['IdPartieJoueur10']."'>".$DonnesJoueur."</a></td>";

                  }
                  else {

                    echo "<td></td>";

                  }

          if ($row['IdPartieJoueur11']<>"")
                  {
                  $sqlDonnesJoueur = " SELECT MAX(Score),  Joueurs.IdJoueur, CodeJoueur, PrenomJoueur, NomJoueur   FROM Joueurs INNER JOIN DonneesParties ON Joueurs.IdJoueur = DonneesParties.IdJoueur where idPartie=".$row['IdPartieJoueur11'];

                  $reponseDonnesJoueur = $bd->query($sqlDonnesJoueur);
                  $rowDonnesJoueur = $reponseDonnesJoueur->fetchArray();
                  //$DonnesJoueur= $rowDonnesJoueur['MAX(Score)']." Pts ".$rowDonnesJoueur['CodeJoueur']." / ".$rowDonnesJoueur['PrenomJoueur']." ".$rowDonnesJoueur['NomJoueur'];
                  $DonnesJoueur= $rowDonnesJoueur['CodeJoueur'];
                  $IdJoueur = $rowDonnesJoueur['IdJoueur'];

                  echo "<td style='text-align: center;font-size: 20px'><a href='SynthesePartie.php?IdJ=".$IdJoueur."&IdP=".$row['IdPartieJoueur11']."'>".$DonnesJoueur."</a></td>";

                  }
                  else {

                    echo "<td></td>";

                  }


        //$DateSession = $row['DateSession'];

        echo "<td style='text-align: center;font-size: 14px'><a href='SyntheseSession.php?IdSession=".$row['IdSession']."&DureeSession=".$DureeSession."&DateSession=".$DateSession."'>Classement</a></td>";
      echo "</tr>";


        /*IdJoueur ,CodeJoueur , NomJoueur , PrenomJoueur , DateNaissanceJoueur , TelJoueur , MailJoueur ,OrigineCoordJoueur*/
    }
}
echo "</tbody>";
echo "</table>";
echo "</center>";
// echo "<br>";
// echo "<hr size='5'color='green'>";
// Deconnexion
$bd = null;
?>
<br>
<br>
<br>
<br>
