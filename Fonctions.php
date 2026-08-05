<?php
//$Dmin = 2;
//$c1 = 0.4;
//$c2 = 0.15;

$Vc5 = 5;
$Vc3 = 3;
$Vc2 = 2;
$Vc1 = 1;


function VCD($Dm,$Vc,$c,$d) {
    //return $Vc + round($c * ($d/100 - $Dm)*$Vc,0, PHP_ROUND_HALF_UP) ;
    $Inter =round(($d/100 - $Dm),0, PHP_ROUND_HALF_UP);
    return $Vc + round($c * $Inter * $Vc ,0, PHP_ROUND_HALF_UP) ;
}

function InitialeVCD($Dm,$Vc,$c,$d) {
    //return $Vc + round($c * (round(($d/100 - $Dm),0, PHP_ROUND_HALF_UP);) * $Vc ,0, PHP_ROUND_HALF_UP) ; ;
    $Inter =($d/100 - $Dm);
    return $Vc + round($c * $Inter * $Vc ,0, PHP_ROUND_HALF_UP) ;
}

function CatieVCD($Dm,$Vc,$c,$d) {
    //return $Vc + round($c * ($d/100 - $Dm)*$Vc,0, PHP_ROUND_HALF_UP) ;
    $Inter =round(($d/100 - $Dm),0, PHP_ROUND_HALF_UP);
    return $Vc + round($c * $Inter * $Vc ,0, PHP_ROUND_HALF_UP) ;
}

function ParaboleVCD($Dm,$Vc,$c,$c1,$c2,$d) {
    //return $Vc + round($c * ($d/100 - $Dm)*$Vc,0, PHP_ROUND_HALF_UP) ;
    //
    $Inter =($d/100 - $Dm);
  if ($c==$c2){
    return $Vc + round($c * $Inter * $Vc ,0, PHP_ROUND_HALF_UP) ;
  } elseif ($c==$c1) {
        if (($d/100) <= $Dm){
          return $Vc + round($c* 3 * $Inter * $Vc ,0, PHP_ROUND_HALF_UP) ;
        } else {
          return $Vc + round($c * $Inter * $Inter * $Vc ,0, PHP_ROUND_HALF_UP) ;
        }

  } else {
    return $Vc;
  }
}

function ExpVCD($Dm,$Vc,$c,$d) {
      //return $Vc + round($c * ($d/100 - $Dm)*$Vc,0, PHP_ROUND_HALF_UP) ;
      $Inter =round(($d/100 - $Dm),0, PHP_ROUND_HALF_UP);
      return $Vc + round($c * $Inter * $Vc ,0, PHP_ROUND_HALF_UP) ;
  }




?>
