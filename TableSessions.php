<?php
include 'MenuDev.php';  // Ok.
include 'MenuIPassBall.php';  // Ok.
?>
<?php
/**
 * Exemple simple qui étend la classe SQLite3 et change les paramètres
 * __construct, puis, utilise la méthode de connexion pour initialiser la
 * base de données.
 */
include 'ConnexionBDDiPassBall.php';

// Lecture des donnees dans la table
$sql = "SELECT * FROM DonneesSession";
/*$reponse = $bd->query($sql, SQLITE3_BOTH, $err);*/
$reponse = $bd->query($sql);
if ($reponse === FALSE) {
    echo "La requete DonneesSessions a echouee pour la raison suivante: ".$err;
} else {
    echo "<b>TABLE Session :<b><br><br>";
    echo "<table style='width: 100%;'border='1'>";
    echo "<tbody>";
    echo "<tr>";
      echo "<td><b>IdSession</b></td>";
      echo "<td><b>DateSession</b></td>";
      echo "<td><b>IdPartieJoueur01</b></td>";
      echo "<td><b>IdPartieJoueur02</b></td>";
      echo "<td><b>IdPartieJoueur03</b></td>";
      echo "<td><b>IdPartieJoueur04</b></td>";
      echo "<td><b>IdPartieJoueur05</b></td>";
      echo "<td><b>IdPartieJoueur06</b></td>";
      echo "<td><b>IdPartieJoueur07</b></td>";
      echo "<td><b>IdPartieJoueur08</b></td>";
      echo "<td><b>IdPartieJoueur09</b></td>";
      echo "<td><b>Synthèse de la session</b></td>";
    echo "</tr>";



    while ($row = $reponse->fetchArray()) {
      echo "<tr>";
        echo "<td>".$row['IdSession']."</td>";
        echo "<td>".$row['DateSession']."</td>";
        echo "<td><a href='SynthesePartie.php?IdJ=".$row['IdJoueur']."&IdP=".$row['IdPartieJoueur01']."'>".$row['IdPartieJoueur01']."</a></td>";
        echo "<td><a href='SynthesePartie.php?IdJ=".$row['IdJoueur']."&IdP=".$row['IdPartieJoueur02']."'>".$row['IdPartieJoueur02']."</a></td>";
        echo "<td><a href='SynthesePartie.php?IdJ=".$row['IdJoueur']."&IdP=".$row['IdPartieJoueur03']."'>".$row['IdPartieJoueur03']."</a></td>";
        echo "<td><a href='SynthesePartie.php?IdJ=".$row['IdJoueur']."&IdP=".$row['IdPartieJoueur04']."'>".$row['IdPartieJoueur04']."</a></td>";
        echo "<td><a href='SynthesePartie.php?IdJ=".$row['IdJoueur']."&IdP=".$row['IdPartieJoueur05']."'>".$row['IdPartieJoueur05']."</a></td>";
        echo "<td><a href='SynthesePartie.php?IdJ=".$row['IdJoueur']."&IdP=".$row['IdPartieJoueur06']."'>".$row['IdPartieJoueur06']."</a></td>";
        echo "<td><a href='SynthesePartie.php?IdJ=".$row['IdJoueur']."&IdP=".$row['IdPartieJoueur07']."'>".$row['IdPartieJoueur07']."</a></td>";
        echo "<td><a href='SynthesePartie.php?IdJ=".$row['IdJoueur']."&IdP=".$row['IdPartieJoueur08']."'>".$row['IdPartieJoueur08']."</a></td>";
        echo "<td><a href='SynthesePartie.php?IdJ=".$row['IdJoueur']."&IdP=".$row['IdPartieJoueur09']."'>".$row['IdPartieJoueur09']."</a></td>";
        echo "<td><a href='SyntheseSession.php?IdSession=".$row['IdSession']."'>Synthèse de la session</a></td>";
      echo "</tr>";


        /*IdJoueur ,CodeJoueur , NomJoueur , PrenomJoueur , DateNaissanceJoueur , TelJoueur , MailJoueur ,OrigineCoordJoueur*/
    }
}
echo "</tbody>";
echo "</table>";
// Deconnexion
$bd = null;
?>
