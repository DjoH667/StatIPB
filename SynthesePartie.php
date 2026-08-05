<?php

include 'MenuIPassBall.php';  // Ok.
include_once 'Security.php';
?>

<?php

/* Variables passées en prametres dans l'url*/
$IdP = app_get_int("IdP");
$IdJ = app_get_int("IdJ");

include 'ConnexionBDDiPassBall.php';

include 'SynthesePartieSession.php';


$Dmin = $Dnominal;


include 'AbaqueChartsPointDistance.php';

?>
