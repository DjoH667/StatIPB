<h1><a href="/iPassBall/">Retour sur --> /iPassBall</a></h1>
<br>
<h1><a href="/iPassBall/dev.iPassBall.com/">Retour sur --> /iPassBall/dev.iPassBall.com/</a></h1>
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
$sql = "SELECT * FROM Joueurs";
/*$reponse = $bd->query($sql, SQLITE3_BOTH, $err);*/
$reponse = $bd->query($sql);
if ($reponse === FALSE) {
    echo "La requete a echouee pour la raison suivante: ".$err;
} else {
    echo "Voici le contenu de la table Joueur:<br><br>";
    echo "<table style='width: 100%;'border='1'>";
    echo "<tbody>";
    echo "<tr>";
    echo "<td><b>Id</b></td>";
    echo "<td><b>Code</b></td>";
    echo "<td><b>Nom</b></td>";
    echo "<td><b>Prenom</b></td>";
    echo "<td><b>Date Naissance</b></td>";
    echo "<td><b>Tel</b></td>";
    echo "<td><b>Mail</b></td>";
    echo "<td><b>Origine Coord</b></td>";
    echo "<td><b>Club</b></td>";
    echo "<td><b>Date Creation</b></td>";
    echo "</tr>";



    while ($row = $reponse->fetchArray()) {
        echo "<tr>";
        echo "<td>".$row['IdJoueur']."</td>";
        echo "<td>".$row['CodeJoueur']."</td>";
        echo "<td>".$row['NomJoueur']."</td>";
        echo "<td>".$row['PrenomJoueur']."</td>";
        echo "<td>".$row['DateNaissance']."</td>";
        echo "<td>".$row['TelJoueur']."</td>";
        echo "<td>".$row['MailJoueur']."</td>";
        echo "<td>".$row['OrigineCoordJoueur']."</td>";
        echo "<td>".$row['ClubJoueur']."</td>";
        echo "<td>".$row['DateCreation']."</td>";
        echo "</tr>";


        /*IdJoueur ,CodeJoueur , NomJoueur , PrenomJoueur , DateNaissanceJoueur , TelJoueur , MailJoueur ,OrigineCoordJoueur*/
    }
}
echo "</tbody>";
echo "</table>";
// Deconnexion
$bd = null;
?>
