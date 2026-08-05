<?php

include 'MenuDev.php';   // Ok.
include 'MenuIPassBall.php';  // Ok.
include_once 'Security.php';

//$Dmin = 2;
//$c1 = 0.4;
//$c2 = 0.15;

// $Vc5 = 5;
// $Vc3 = 3;
// $Vc2 = 2;
// $Vc1 = 1;


// $c1=0.9;
// $c2=0.15;
//
// $Dm=2;


// $Vc5 = $_GET["Vc5"];
// $Vc3 = $_GET["Vc3"];
// $Vc2 = $_GET["Vc2"];
// $Vc1 = $_GET["Vc1"];

$Vc5 = app_get_float("Vc5", 5);
$Vc3 = app_get_float("Vc3", 3);
$Vc2 = app_get_float("Vc2", 2);
$Vc1 = app_get_float("Vc1", 1);


// $c1 = $_GET["c1Select"];
// $c2 = $_GET["c2Select"];
//
// $Dm = $_GET["DmiSelect"];

$c1 = app_get_float("c1Select", 0.9);
$c2 = app_get_float("c2Select", 0.15);
$Dm = app_get_float("DmiSelect", 2);



function VCD($Dm,$Vc,$c,$d) {
    // formule cpp : #define CALCUL_OF_POINT(pointRef, Dmeas, Dnom, coeff) (pointRef + round(((coeff * round(Dmeas - Dnom)) * pointRef)))
    //return $Vc + round($c * ($d - $Dm)*$Vc,0, PHP_ROUND_HALF_UP) ;
    $Inter =round(($d - $Dm),0, PHP_ROUND_HALF_UP);
    return $Vc + round($c * $Inter * $Vc ,0, PHP_ROUND_HALF_UP) ;
}


function PointsCible($CibleTouchee) {

      //'**************************
      //' Nb de points selon cible touchée
      //'**************************

      if (($CibleTouchee=='1') or ($CibleTouchee=='7')){
        return 1;
      } elseif (($CibleTouchee=='2') or ($CibleTouchee=='8')) {
        return 3;
      } elseif (($CibleTouchee=='3') or ($CibleTouchee=='5')) {
        return 2;
      } elseif (($CibleTouchee=='4') or ($CibleTouchee=='6')) {
        return 5;
      } else {
        return 0;
      }

}


function FacteurC($CibleTouchee,$c1,$c2)
{

      //'**************************
      //' Facteur c selon cible touchée
      //'**************************

      if ( ($CibleTouchee=='1') or ($CibleTouchee=='7') or ($CibleTouchee=='2') or ($CibleTouchee=='5') or ($CibleTouchee=='3') or ($CibleTouchee=='8') ){
        return $c2 ;
      } elseif ( ($CibleTouchee=='4') or ($CibleTouchee=='6') ) {
        return $c1 ;
      } else {
        return 0;
      }

}

?>

<html>
<body>
<H1>Calcul du score ET Ligne logs selon Distance</H1>

<!-- <H2>Constantes en vigueur :</H2> -->
<form action="CalculScoreLigneLog.php" method="get">

<table style="width: 100%; border-collapse: collapse; height:;" border="0">

  <tr style='height: ;'>
    <td style='; height: 6px;' colspan=8><H2>Constantes en vigueur :</H2></td>
  </tr>

  <tr style='height: ;'>
    <td style='width: 12%; height: 15px;'></td>
    <td style='width: 12%; height: 15px;'></td>

    <td style='width: 12%; height: 15px;'><H2><?php Echo "Valeur Cible 5 = ".$Vc5; ?></H2></td>
    <td style='width: 12%; height: 15px;'><H2><?php Echo "Valeur Cible 3 = ".$Vc3; ?></H2></td>
    <td style='width: 12%; height: 15px;'><H2><?php Echo "Valeur Cible 2 = ".$Vc2; ?></H2></td>
    <td style='width: 12%; height: 15px;'><H2><?php Echo "Valeur Cible 1 = ".$Vc1; ?></H2></td>

    <td style='width: 12%; height: 15px;'></td>
    <td style='width: 12%; height: 15px;'></td>

  </tr>

  <tr style='height: ;'>
    <td style='width:  height: 6px;'></td>
    <td style='width:  height: 6px;'></td>

    <td style='width:  height: 6px;'>Changer Valeur Cible 5 sur  :
      <select name="Vc5" size="1">
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5" selected>5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
      </select>
    </td>
    <td style='width:  height: 6px;'>Changer Valeur Cible 3 sur  :
      <select name="Vc3" size="1">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3" selected>3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
      </select>
    </td>
    <td style='width:  height: 6px;'>Changer Valeur Cible 2 sur  :
      <select name="Vc2" size="1">
        <option value="1">1</option>
        <option value="2" selected>2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
      </select>
    <td style='width:  height: 6px;'>Changer Valeur Cible 1 sur  :
      <select name="Vc1" size="1">
        <option value="1" selected>1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
      </select>

    <td style='width:  height: 6px;'></td>
    <td style='width:  height: 6px;'></td>

  </tr>

  <tr style='height: 30px;'>
    <td style='width:  ; height: 15px;'></td>
    <td style='width:  ; height: 15px;'></td>

    <td style='width:  ; height: 15px;'></td>
    <td style='width:  ; height: 15px;'></td>
    <td style='width:  ; height: 15px;'></td>
    <td style='width:  ; height: 15px;'></td>

    <td style='width:  ; height: 15px;'></td>
    <td style='width:  ; height: 15px;'></td>

  </tr>

  <tr style='height: ;'>
    <td style='width:  ; height: 15px;'></td>
    <td style='width:  ; height: 15px;'></td>

    <td style='width:  ; height: 15px;'><H2><?php Echo "D Nom = ".$Dm; ?> m</H2></td>
    <td style='width:  ; height: 15px;'><H2><?php Echo "c1 = ".$c1; ?></H2></td>
    <td style='width:  ; height: 15px;'><H2><?php Echo "c2 = ".$c2; ?></H2></td>
    <td style='width:  ; height: 15px;'></td>

    <td style='width:  ; height: 15px;'></td>
    <td style='width:  ; height: 15px;'></td>

  </tr>



  <tr style='height: ;'>
    <td style='width:  height: 6px;'></td>
    <td style='width:  height: 6px;'></td>

    <td style='width:  height: 6px;'>Changer D Nom sur  :
      <select name="DmiSelect" size="1">
        <option value="1"><H2> 1 mètre</option>
        <option value="1.5"> 1,5 mètre</option>
        <option value="2" selected> 2 mètre</option>
        <option value="2.5"> 2,5 mètre</option>
        <option value="3"> 3 mètre</option>
        <option value="3.5"> 3,5 mètre</option>
        <option value="4"> 4 mètre</option>
        <option value="4.5"> 4,5 mètre</option>
        <option value="5"> 5 mètre</option>
      </select>
    </td>
    <td style='width:  height: 6px;'>Changer c1 sur  :
      <select name="c1Select" size="1">
        <option value="0.30"> 0.30</option>
        <option value="0.35"> 0.35</option>
        <option value="0.40"> 0.40</option>
        <option value="0.45"> 0.45</option>
        <option value="0.50"> 0.50</option>
        <option value="0.55"> 0.55</option>
        <option value="0.60"> 0.60</option>
        <option value="0.65"> 0.65</option>
        <option value="0.70"> 0.70</option>
        <option value="0.75"> 0.75</option>
        <option value="0.80"> 0.80</option>
        <option value="0.85"> 0.85</option>
        <option value="0.90" selected> 0.90</option>
        <option value="0.95"> 0.95</option>
        <option value="1.00"> 1.00</option>
      </select>
    </td>
    <td style='width:  height: 6px;'>Changer c2 sur  :
      <select name="c2Select" size="1">
        <option value="0.15" selected> 0.15 </option>
        <option value="0.20"> 0.20</option>
        <option value="0.25"> 0.25</option>
        <option value="0.30"> 0.30</option>
      </select>
    </td>
    <td style='width:  height: 6px;'><input type="submit" name="ChangerConstantes" value="Changer Constantes"></td>

    <td style='width:  height: 6px;'></td>
    <td style='width:  height: 6px;'></td>

  </tr>

<!-- </table>

</form> -->





<!-- <form action="CalculScoreLigneLog.php" method="get"> -->

  <!-- <table style="width: 100%; border-collapse: collapse; height:;" border="1">
  <tbody> -->

    <tr style='height: ;'>
      <td style='; height: 6px;' colspan=8><H2>Renseigner :</H2></td>
      <!-- <td style='; height: 6px;'><H2>Renseigner</H2></td>

      <td style='; height: 6px;'><H2><?php  ?></H2></td>
      <td style='; height: 6px;'><H2><?php  ?></H2></td>
      <td style='; height: 6px;'><H2><?php  ?></H2></td>
      <td style='; height: 6px;'><H2><?php  ?></H2></td>

      <td style='; height: 6px;'></td>
      <td style='; height: 6px;'></td> -->

    </tr>

    <tr style='height: ;'>
      <td style='; height: 12px;'></td>
      <td style='; height: 12px;'></td>

      <td style='; height: 12px;'>
        <textarea id="LigneSLog" name="LigneSLog" rows="20" cols="40" >LigneS des Log à transformer</textarea>
      </td>
      <td style='; height: 12px;'>
        <!-- <input type="text" id="LigneLog" name="LigneLog" value="Ligne Log à renseigner"><br> -->
      </td>
      <td style='; height: 12px;'>
          <input type="submit" name="AfficherLigne" value="Afficher Ligne Log Recalculée">
      </td>
      <td style='; height: 12px;'>
        <input type="reset">
      </td>

      <td style='; height: 12px;'></td>
      <td style='; height: 12px;'></td>

    </tr>


    <tr style='height: ;'>
      <td style='; height: 6px;'></td>
      <td style='; height: 6px;'></td>

      <td style='; height: 6px;' colspan=2 ><b>Logs initiales</b></td>
      <td style='; height: 6px;' colspan=2 ><b>Logs Transformées</b></td>
      <!-- <td style='; height: 6px;'><H2><</H2></td>
      <td style='; height: 6px;'><H2></H2></td> -->

      <td style='; height: 6px;'></td>
      <td style='; height: 6px;'></td>

    </tr>

    <tr style='height: ;'>
      <td style='; height: 12px;'></td>
      <td style='; height: 12px;'></td>

      <td style='; height: 12px; vertical-align: top;' colspan='2'>
        <?php

        $LigneSLog = app_get_string("LigneSLog");

        $Ligne= explode("\n", $LigneSLog);

        $i= 0;

        while ($Ligne[$i]<>"") {

        //for ($i= 0; $i <= 10; $i+=1) {

        //Echo "LigneSLogInit[".$i."]=".$Ligne[$i]."<br>";
        Echo app_escape($Ligne[$i])."<br>";

        $i+=1;


        }
        ?>
      </td>

      <td style='; height: 12px; vertical-align: top;'  colspan='2'>
        <?php

        $LigneSLog = app_get_string("LigneSLog");

        // $c1=0.9;
        // $c2=0.15;
        //
        // $Dm=2;

        $Ligne= explode("\n", $LigneSLog);


        $i= 0;
        $Decrochage = 0 ;

        while ($Ligne[$i]<>"") {


        //for ($i= 0; $i <= 10; $i+=1) {

        //Echo "LigneSLog[".$i."]=".$Ligne[$i]."<br>";

        $Valeur=explode(";",$Ligne[$i]);

        // CibleTouchee = $Valeur[2]
        // Distance = $Valeur[3]
        // Force = $Valeur[4]
        // nbPoints = $Valeur[5]
        // Score = $Valeur[6]
        //Echo $i.";".$Valeur[0].";".$Valeur[1].";".$Valeur[2].";".$Valeur[3].";".$Valeur[4].";".$Valeur[5].";".$Valeur[6]."<br>";

        $c = FacteurC($Valeur[2],$c1,$c2);
        //echo "c=".$c."<br>";
        $Vc = PointsCible($Valeur[2]);
        //echo "Vc=".$Vc."<br>";
        $Dist = number_format($Valeur[3], 1, '.', '');
        $NbPoint = VCD($Dm,$Vc,$c,$Dist);
        $Score = $Score + $NbPoint;

        if ($i=='0'){
          $Score = $Valeur[6];
        }

        if ($Valeur[5]>$NbPoint) {
          $NbPoint = "<b style='color:red;'>".$NbPoint."</b>";

        } elseif ($Valeur[5]<$NbPoint) {
          $NbPoint = "<b style='color:green;'>".$NbPoint."</b>";
        }

        // if ($Valeur[3]>100) {
        //
        //   $LigneAvantDistance = $Valeur[0].";".$Valeur[1].";<b style='color:orange;'>".$Valeur[2].";";
        //   $LigneApresDistance = $Valeur[4].";";
        //   $FinDeLigne = "</b><br>";
        //
        //   $Force = $Valeur[4];
        //
        //   $Decrochage=1 ;

        // }

        if ($Decrochage=='1') {

                if ($Dist>100){

                    $DistanceMoyenne= $DistancePrecedente;
                    //echo "----> Prise en Compte de > Dist Prec >---------------<br>";
                    //echo ">>>> DistanceMoyenne = ".$DistanceMoyenne."<br>";

                    $Decrochage2 = '1';
                    //echo "Decrochage2"."<br>";

                    //echo "ScorePrecedent = ".$ScorePrecedent."<br>";

                } else {

                    $DistanceMoyenne= number_format(($DistancePrecedente + $Dist)/2, 2, '.', '');
                    //echo "DistanceMoyenne = ".$DistanceMoyenne."<br>";

                    $Decrochage2 = 0 ;
                }

                $NbPoint = VCD($Dm,$VcPrecedent,$cPrecedent,$DistanceMoyenne);
                $Score = $ScorePrecedent + $NbPoint;

                //echo "-----------------Decrochage"."<br>";

                Echo $LigneAvantDistance.$DistanceMoyenne.";".$Force.";".$NbPoint.";".$Score.$FinDeLigne;

                //echo "Decrochage"."<br>";

                //echo "ScorePrecedent = ".$ScorePrecedent."<br>";

                $ScorePrecedent = $Score ;

                $Score = $Score + $NbPoint;

                if ($Decrochage2 == '0') {

                Echo $Valeur[0].";".$Valeur[1].";<b>".$Valeur[2].";".$Valeur[3]."</b>;".$Valeur[4].";".$NbPoint.";".$Score."<br>";

                }

                $Decrochage = 0 ;

        } else if ($Valeur[3]<100) {

        Echo $Valeur[0].";".$Valeur[1].";<b>".$Valeur[2].";".$Valeur[3]."</b>;".$Valeur[4].";".$NbPoint.";".$Score."<br>";

        //$Decrochage2 = 0 ;

        $DistancePrecedente = $Valeur[3];
        $ScorePrecedent = $Score;

        // CibleTouchee = $Valeur[2]
        // Distance = $Valeur[3]
        // Force = $Valeur[4]
        // nbPoints = $Valeur[5]
        // Score = $Valeur[6]

        }


        if ($Valeur[3]>100) {

          $LigneAvantDistance = $Valeur[0].";".$Valeur[1].";<b style='color:orange;'>".$Valeur[2].";";
          $LigneApresDistance = $Valeur[4].";";
          $FinDeLigne = "</b><br>";

          $Force = $Valeur[4];

          $Decrochage=1 ;

          $cPrecedent = FacteurC($Valeur[2],$c1,$c2);

          $VcPrecedent = PointsCible($Valeur[2]);


        }

        $NbPointPrecedent = $NbPoint;

        $i+=1;

        }
        ?>
      <!-- </td>
      <td style='; height: 12px;'>
      </td> -->

      <td style='; height: 12px;'></td>
      <td style='; height: 12px;'></td>
    </tr>


  </tbody>
  </table>

</form>
<?php

Echo "<br>";

Echo "Valeur Cible 5 = ".$Vc5."<br>";
Echo "Valeur Cible 3 = ".$Vc3."<br>";
Echo "Valeur Cible 2 = ".$Vc2."<br>";
Echo "Valeur Cible 1 = ".$Vc1."<br>";

Echo "<br>";

Echo "D nom = ".$Dm."<br>";
Echo "c1 = ".$c1."<br>";
Echo "c2 = ".$c2."<br>";

Echo "<br>";

// for ($i= 0; $i <= 10; $i+=1) {
//
// //VCD($Dm,$Vc,$c,$d)
// Echo "Pour i= ".$i." > c=".FacteurC($i,$c1,$c2)." et PointsCible = ".PointsCible($i)." et VCD(2,PointsCible(i),FacteurC(i,c1,c2),2) = ".VCD(2,PointsCible($i),FacteurC($i,$c1,$c2),200)."<br>";
// //Echo "Pour i= ".$i." > c=".FacteurC($i,$c1,$c2)." et VCD = ".VCD(2,$i,FacteurC($i,$c1,$c2),2)."<br>";
//
// }

?>
</body>
</html>
