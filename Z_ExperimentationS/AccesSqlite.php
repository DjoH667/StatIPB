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
        $this->open('mysqlitedb2.db');
    }
}

$db = new MyDB();

/*$db->exec('CREATE TABLE foo (bar STRING)');*/
$db->exec("INSERT INTO foo (bar) VALUES ('Ceci est un test 2')");

$result = $db->query('SELECT bar FROM foo');
var_dump($result->fetchArray());
?>
