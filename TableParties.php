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
$sql = "SELECT * FROM ParametresPartie Order by DatePartie, IdPartie";
/*$reponse = $bd->query($sql, SQLITE3_BOTH, $err);*/
$reponse = $bd->query($sql);
if ($reponse === FALSE) {
    echo "La requete a echouee pour la raison suivante: ".$err;
} else {
    echo "<b>TABLE PARTIES :<b><br><br>";
    echo "<table style='width: 100%;'border='1'>";
    echo "<tbody>";
    echo "<tr>";
    echo "<td><b>IdPartie</b></td>";
    echo "<td><b>DatePartie</b></td>";
    echo "<td><b>IdJoueur</b></td>";
    echo "<td><b>CodeJoueur</b></td>";
    echo "<td><b>NomJoueur</b></td>";
    echo "<td><b>PrenomJoueur</b></td>";
    echo "<td><b>DureePartie</b></td>";
    echo "<td><b>DminPartie</b></td>";
    echo "<td><b>c1Partie</b></td>";
    echo "<td><b>c2Partie</b></td>";
    echo "</tr>";



    while ($row = $reponse->fetchArray()) {

        $sqlJoueur = "SELECT * FROM Joueurs where IdJoueur=".$row['IdJoueur'];
        /*$reponse = $bd->query($sql, SQLITE3_BOTH, $err);*/
        $reponseJoueur = $bd->query($sqlJoueur);

        $rowJoueur = $reponseJoueur->fetchArray();

        //$Couleur = bin2hex(substr($rowJoueur['NomJoueur'], 0, 3)) + bin2hex(substr($rowJoueur['PrenomJoueur'], 0, 3)) + bin2hex($rowJoueur['CodeJoueur']);
        $Couleur = 1 - bin2hex($rowJoueur['IdJoueur']);

        echo "<tr style='background-color:#".$Couleur."'>";

        echo "<td><a href='SynthesePartie.php?IdJ=".$row['IdJoueur']."&IdP=".$row['IdPartie']."'>".$row['IdPartie']."</a></td>";
        echo "<td>".$row['DatePartie']."</td>";
        echo "<td><a href='PartiesJoueur.php?IdJ=".$row['IdJoueur']."&NomJ=".$row['NomJoueur']."&PrenomJ=".$row['PrenomJoueur']."'>".$row['IdJoueur']."</a></td>";
        echo "<td><a href='PartiesJoueur.php?IdJ=".$row['IdJoueur']."&NomJ=".$row['NomJoueur']."&PrenomJ=".$row['PrenomJoueur']."'>".$rowJoueur['CodeJoueur']."</a></td>";
        echo "<td><a href='PartiesJoueur.php?IdJ=".$row['IdJoueur']."&NomJ=".$row['NomJoueur']."&PrenomJ=".$row['PrenomJoueur']."'>".$rowJoueur['NomJoueur']."</a></td>";
        echo "<td><a href='PartiesJoueur.php?IdJ=".$row['IdJoueur']."&NomJ=".$row['NomJoueur']."&PrenomJ=".$row['PrenomJoueur']."'>".$rowJoueur['PrenomJoueur']."</a></td>";
        echo "<td>".$row['DureePartie']."</td>";
        echo "<td>".$row['DminPartie']."</td>";
        echo "<td>".$row['c1Partie']."</td>";
        echo "<td>".$row['c2Partie']."</td>";
        echo "</tr>";



    }
}
echo "</tbody>";
echo "</table>";
// Deconnexion
$bd = null;
?>
