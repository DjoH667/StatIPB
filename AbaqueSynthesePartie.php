<?php
//
include 'MenuIPassBall.php';  // Ok.
include_once 'Security.php';
?>
<html>
<body>
<H1>Abaque Point Distance</H1>

<?php
$Dmin = app_get_float("Dmin", 2);
$c1 = app_get_float("c1", 0.9);
$c2 = app_get_float("c2", 0.15);


include 'AbaqueChartsPointDistance.php';

?>
