

<?php

/*$Dmin = 2;
$c1 = 0.4;
$c2 = 0.15;*/

$Vc5 = 5;
$Vc3 = 3;
$Vc2 = 2;
$Vc1 = 1;

?>
<hr size='5' color='green' width='100%'>
<hr size='5' color='green' width='100%'>
<h2>Tableau Points selon Distance avec Distance Nominale = <?php echo $Dmin ?> mètres, c1 = <?php echo$c1 ?> et c2 = <?php echo $c2 ?></h2>
<hr size='5' color='green' width='100%'>
<hr size='5' color='green' width='100%'>

<center>
<table style="width: ; border-collapse: collapse; height:;" border="1">
<tbody>
  <tr style='height: ;'>
    <!-- <td style='width: 180px;; height: 6px;'></td> -->
    <td style='width: 220px;; height: 6px;font-size: 32px;'><b>Distance</b></td>
    <td style='width: 180px;; height: 6px;font-size: 32px;'><b>Cible 5</b></td>
    <td style='width: 180px;; height: 6px;font-size: 32px;'><b>Cible 3</b></td>
    <td style='width: 180px;; height: 6px;font-size: 32px;'><b>Cible 2</b></td>
    <td style='width: 180px;; height: 6px;font-size: 32px;'><b>Cible 1</b></td>
    <!-- <td style='width: 180px;; height: 6px;'>&nbsp;</td> -->
    <!-- <td style='width: 180px;; height: 6px;'>&nbsp;</td> -->
  </tr>


<?php
function VCDTableau($Dm,$Vc,$c,$d) {
    return $Vc + round($c * ($d/100 - $Dm)*$Vc,0, PHP_ROUND_HALF_UP) ;
}

//for ($dist = 0; $dist <= 1000; $dist+=10) {
for ($dist = 200; $dist <= 1000; $dist+=10) {

    $distm= $dist / 100;

    if ($distm == $Dmin) {
      echo "<tr>";
      echo "<td colspan=5><hr size='5' color='green'></td>";
      echo "</tr>";
      echo "<tr style='height: ;'>";
        //echo "<td style='font-size: 18px; height: 6px;'>&nbsp;</td>";
        echo "<td style='font-size: 20px; height: 6px;'><b style='color:red'> D nominale : ".$distm." mètres<b></td>";
        echo "<td style='font-size: 28px; height: 6px; background-color:#228B22'><b>".VCDTableau($Dmin,$Vc5,$c1,$dist)." points<b></td>";
        echo "<td style='font-size: 28px; height: 6px; background-color:#a9d08e'><b>".VCDTableau($Dmin,$Vc3,$c2,$dist)." points<b></td>";
        echo "<td style='font-size: 28px; height: 6px; background-color:#f2b084'><b>".VCDTableau($Dmin,$Vc2,$c2,$dist)." points<b></td>";
        echo "<td style='font-size: 28px; height: 6px; background-color:#f8cbad'><b>".VCDTableau($Dmin,$Vc1,$c2,$dist)." points<b></td>";
        //echo "<td style='font-size: 18px; height: 6px;'></td>";
        // echo "<td style='font-size: 18px; height: 6px;'>&nbsp;</td>";
      echo "</tr>";
      echo "<tr>";
      echo "<td colspan=5><hr size='5' color='green'></td>";
      echo "</tr>";


    }

    else {
    echo "<tr style='height: ;'>";
      //echo "<td style='font-size: 18px; height: 6px;'></td>";
      $r = fmod($dist,100);
      //echo "r=".$r."<br>";
      if ($r==0) {
        echo "<td style='font-size: 28px; height: 6px;'><b style='color:green'>>>>".$distm." mètres >></b></td>";
      }
      elseif ($r==50){
        echo "<td style='font-size: 24px; height: 6px;'><b>>>".$distm." mètres >></b></td>";

      }
      else{
        echo "<td style='font-size: 18px; height: 6px;'>".$distm." mètres </td>";

      }

      if (VCD($Dmin,$Vc5,$c1,$dist)>VCD($Dmin,$Vc5,$c1,$dist-10)) {
        echo "<td style='font-size: 28px; height: 6px; background-color:#228B22'><b style='color:red'>>  ".VCD($Dmin,$Vc5,$c1,$dist)." points</b></td>";
      }
      else {
        echo "<td style='font-size: 18px; height: 6px; background-color:#228B22'>".VCD($Dmin,$Vc5,$c1,$dist)." points</td>";
      }

      if (VCD($Dmin,$Vc3,$c2,$dist)>VCD($Dmin,$Vc3,$c2,$dist-10)) {
        echo "<td style='font-size: 28px; height: 6px; background-color:#a9d08e'><b style='color:red'>> ".VCD($Dmin,$Vc3,$c2,$dist)." points</b></td>";
      }
      else {
      echo "<td style='font-size: 18px; height: 6px; background-color:#a9d08e'>".VCD($Dmin,$Vc3,$c2,$dist)." points</td>";
      }

      if (VCD($Dmin,$Vc2,$c2,$dist)>VCD($Dmin,$Vc2,$c2,$dist-10)) {
        echo "<td style='font-size: 28px; height: 6px; background-color:#f2b084'><b style='color:red'>> ".VCD($Dmin,$Vc2,$c2,$dist)." points</b></td>";
      }
      else {
      echo "<td style='font-size: 18px; height: 6px; background-color:#f2b084'>".VCD($Dmin,$Vc2,$c2,$dist)." point</td>";
      }

      if (VCD($Dmin,$Vc1,$c2,$dist)>VCD($Dmin,$Vc1,$c2,$dist-10)) {
        echo "<td style='font-size: 18px; height: 6px; background-color:#f8cbad'><b style='color:red'>> ".VCD($Dmin,$Vc1,$c2,$dist)." points</b></td>";
      }
      else {
        echo "<td style='font-size: 18px; height: 6px; background-color:#f8cbad'>".VCD($Dmin,$Vc1,$c2,$dist)." points</td>";
      }


      //echo "<td style='font-size: 18px; height: 6px;'>&nbsp;</td>";
      // echo "<td style='font-size: 18px; height: 6px;'>&nbsp;</td>";
    echo "</tr>";
    }
}
?>
</tbody>
</table>
</center>
<hr size='5' color='green' width='100%'>
