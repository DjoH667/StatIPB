<h1><a href="/iPassBall/">Retour sur --> /iPassBall</a></h1>
<br>
<h1><a href="/iPassBall/dev.iPassBall.com/10 Essais/">Retour sur --> /iPassBall/dev.iPassBall.com/10 Essais/</a></h1>
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
$sql = "SELECT * FROM ParametresPartie Order by DatePartie, IdPartie";
/*$reponse = $bd->query($sql, SQLITE3_BOTH, $err);*/
$reponse = $bd->query($sql);
if ($reponse === FALSE) {
    echo "La requete a echouee pour la raison suivante: ".$err;
} else {
    echo "Voici le contenu de la table Parties:<br><br>";
    echo "<table style='width: 100%;'border='1'>";
    echo "<tbody>";
    echo "<tr>";
    echo "<td><b>IdPartie</b></td>";
    echo "<td><b>DatePartie</b></td>";
    echo "<td><b>IdJoueur</b></td>";
    echo "<td><b>NomJoueur</b></td>";
    echo "<td><b>PrenomJoueur</b></td>";
    echo "<td><b>DureePartie</b></td>";
    echo "<td><b>DminPartie</b></td>";
    echo "<td><b>c1Partie</b></td>";
    echo "<td><b>c2Partie</b></td>";
    echo "</tr>";



    while ($row = $reponse->fetchArray()) {
        echo "<tr>";
        echo "<td>".$row['IdPartie']."</td>";
        echo "<td>".$row['DatePartie']."</td>";
        echo "<td>".$row['IdJoueur']."</td>";
        echo "<td>NomJoueur</td>";
        echo "<td>PrenomJoueur</td>";
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
