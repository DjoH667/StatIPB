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
        $this->open('IpassBall.db');
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
    echo "Voici le contenu de la table Jouer:<br>";
    while ($row = $reponse->fetchArray()) {
        echo $row['IdJoueur']." - ".$row['NomJoueur']."<br>";
    }
}

// Deconnexion
$bd = null;
?>
