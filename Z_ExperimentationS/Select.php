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

$db = new MyDB();


$result = $db->query('SELECT * FROM Joueurs');

var_dump($result->fetchArray());

/* Tableau numérique */
$row = $result->fetch_array(SQLITE3_NUM);
printf ("%s (%s)\n", $row[0], $row[1]);

/* Tableau associatif
$row = $result->fetch_array(SQLITE3_ASSOC);
printf ("%s (%s)\n", $row["IdJoueur"], $row["NomJoueur"]);

/* Tableau associatif et numérique
$row = $result->fetch_array(SQLITE3_BOTH);
printf ("%s (%s)\n", $row[0], $row["NomJoueur"]);

/* Libération des résultats */
$result->free();
/* Fermeture de la connexion */
/* $mysqli->close();*/
?>
