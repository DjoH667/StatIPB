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
$sql = "SELECT * FROM Joueurs order by CodeJoueur";
/*$reponse = $bd->query($sql, SQLITE3_BOTH, $err);*/
$reponse = $bd->query($sql);
if ($reponse === FALSE) {
    echo "La requete a echouee pour la raison suivante: ".$err;
} else {

    echo "<h1>JOUEURS :<br>";
    echo "<i style='color: white; text-transform: italic;font-size: 24px;'>";
    echo ">>> Par Prénom croissant";
    echo "</i>";
    echo "</h1>";

    echo "<h4><u>LEGENDE : </u><br><br>";

    //echo "<table style=''border='1'>";
  echo "<i style='color: black; text-transform: italic;'>";
    echo "";
    echo "<b>#Parties de</b><br>";
    echo ">> Cliquer pour avoir le détail des parties du joueur concerné par la ligne<br>";
    echo "<br>";

    echo "";
    echo "Code : <br>Trigramme constitué par 1ere lettre Prenom, 1ere lettre Nom  et Année de naissance<br>";
    echo "Exemple : Jean Dupont née en 2007 >>> Trigramme = JD7 <br>";
    echo "<br>";

    echo "";
    echo "#Fiche J de : Fiche Joueur de <br>";
    echo ">> Cliquer pour voir les informations sur le jouer concerné par la ligne <br>";
    echo "";
  echo "</i>";
    echo "<br>";


    echo "<table style='width: ; margin-left:auto;margin-right:auto;' border='0'";
    echo "<tbody>";
    echo "<thead>";
    echo "<tr>";
    /*IdJoueur ,CodeJoueur , NomJoueur , PrenomJoueur , DateNaissanceJoueur , TelJoueur , MailJoueur ,OrigineCoordJoueur*/
    // echo "<td style='width: 8%'> </td>";
    // echo "<td style='width: 8%'> </td>";
    // echo "<td style='width: 8%'> </td>";
    // echo "<td style='width: 8%'> </td>";
    echo "<td style='width: 100px'><b>#Parties</b></td>";
    echo "<td style='width: 30px'><b>Code</b></td>";
    echo "<td style='width: 100px'><b>#Fiche J</b></td>";
    echo "<td style='width: 100px'><b>Prenom</b></td>";
    echo "<td style='width: 100px'><b>Nom</b></td>";
    echo "<td style='width: 70px'><b>Année</b></td>";
    //echo "<td style='width: 8%'><b>Tel</b></td>";
    //echo "<td style='width: 8%'><b>Mail</b></td>";
    //echo "<td style='width: 8%'><b>Origine Coord</b></td>";
    echo "<td style='width: 100px'><b>Club</b></td>";
    echo "<td style='width: 100px'><b>Poste</b></td>";
    echo "<td style='width: 100px'><b>Pied</b></td>";
    //echo "<td style='width: 8%'><b>Date Creation</b></td>";
    // echo "<td style='width: 8%'> </td>";
    // echo "<td style='width: 8%'> </td>";
    // echo "<td style='width: 8%'> </td>";
    // echo "<td style='width: 8%'> </td>";
    echo "</thead>";
    echo "</tr>";

    $PremiereLettrePrenom = 'A';

    while ($row = $reponse->fetchArray()) {

        $PremiereLettrePrenom=substr($row['PrenomJoueur'], 0, 1);

        if($PremiereLettrePrenomPrecedent<>$PremiereLettrePrenom) {
          echo "<tr style='height: '>";
          echo "<td colspan=9><b style='color:red'>> ".$PremiereLettrePrenom."</b></td>";
          echo "</tr>";
        }

        /*IdJoueur ,CodeJoueur , NomJoueur , PrenomJoueur , DateNaissanceJoueur , TelJoueur , MailJoueur ,OrigineCoordJoueur*/
        echo "<tr>";
        // echo "<td style='width: '> </td>";
        // echo "<td style='width: '> </td>";
        // echo "<td style='width: '> </td>";
        // echo "<td style='width: '> </td>";
        echo "<td style='width: '><a href='PartiesJoueur.php?IdJ=".$row['IdJoueur']."&NomJ=".$row['NomJoueur']."&PrenomJ=".$row['PrenomJoueur']."'>Parties de</a></td>";
        echo "<td style='width: '><b>".$row['CodeJoueur']."</b></td>";
        //echo "<td style='width: '><a href='PartiesJoueur.php?IdJ=".$row['IdJoueur']."&NomJ=".$row['NomJoueur']."&PrenomJ=".$row['PrenomJoueur']."'>".$row['CodeJoueur']."</a></td>";
        echo "<td style='width: '><a href='FicheJoueur.php?IdJ=".$row['IdJoueur']."&NomJ=".$row['NomJoueur']."&PrenomJ=".$row['PrenomJoueur']."'>Fiche J de</a></td>";
        //echo "<td style='width: '><a href='FicheJoueur.php?IdJ=".$row['IdJoueur']."&NomJ=".$row['NomJoueur']."&PrenomJ=".$row['PrenomJoueur']."'>".$row['PrenomJoueur']."</a></td>";
        echo "<td style='width: '><b>".$row['PrenomJoueur']."</b></a></td>";
        //echo "<td style='width: '><a href='FicheJoueur.php?IdJ=".$row['IdJoueur']."&NomJ=".$row['NomJoueur']."&PrenomJ=".$row['PrenomJoueur']."'>".$row['NomJoueur']."</a></td>";
        $NomJ=substr($row['NomJoueur'], 0, 3);
        echo "<td style='width: '><b>".$NomJ."</b></a></td>";
        list($Annee, $Mois, $Jour) = explode('-',$row['DateNaissance']);
        echo "<td style='width: '>".$Annee."</td>";
        //echo "<td style='width: '>".$row['TelJoueur']."</td>";
        //echo "<td style='width: '>".$row['MailJoueur']."</td>";
        //echo "<td style='width: '>".$row['OrigineCoordJoueur']."</td>";
        echo "<td style='width: '>".$row['ClubJoueur']."</td>";
        echo "<td style='width: '>".$row['PosteJoueur']."</td>";
        echo "<td style='width: '>".$row['PiedJoueur']."</td>";
        //echo "<td style='width: '>".$row['DateCreation']."</td>";
        // echo "<td style='width: '> </td>";
        // echo "<td style='width: '> </td>";
        // echo "<td style='width: '> </td>";
        // echo "<td style='width: '> </td>";
        echo "</tr>";

        $PremiereLettrePrenomPrecedent= $PremiereLettrePrenom;

        /*IdJoueur ,CodeJoueur , NomJoueur , PrenomJoueur , DateNaissanceJoueur , TelJoueur , MailJoueur ,OrigineCoordJoueur*/
    }
}
echo "</tbody>";
echo "</table>";
echo "<br>";
echo "<hr size='5'color='green'>";
// Deconnexion
$bd = null;
?>
