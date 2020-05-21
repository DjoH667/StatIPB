<?php class MyDB extends SQLite3
{
    function __construct()
    {
        $this->open('iPassBall.V.0.22.db');
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

?>
