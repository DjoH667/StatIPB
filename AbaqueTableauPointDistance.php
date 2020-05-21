

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
<h1>Tableau</h1>
<h2>Avec D Min = <?php echo $Dmin ?> , c1 = <?php echo$c1 ?> et c2 = <?php echo $c2 ?></h2>
<hr size='5' color='green' width='100%'>
<hr size='5' color='green' width='100%'>

<center>
<table style="width: 72%; border-collapse: collapse; height:;" border="0">
<tbody>
  <tr style='height: ;'>
    <td style='width: 12%; height: 6px;'></td>
    <td style='width: 12%; height: 6px;'>Distance</td>
    <td style='width: 12%; height: 6px;'>Nb point pour Cible 5</td>
    <td style='width: 12%; height: 6px;'>Nb point pour Cible 3</td>
    <td style='width: 12%; height: 6px;'>Nb point pour Cible 2</td>
    <td style='width: 12%; height: 6px;'>Nb point pour Cible 1</td>
    <td style='width: 12%; height: 6px;'>&nbsp;</td>
    <td style='width: 12%; height: 6px;'>&nbsp;</td>
  </tr>


<?php
function VCDTableau($Dm,$Vc,$c,$d) {
    return $Vc + round($c * ($d/100 - $Dm)*$Vc,0, PHP_ROUND_HALF_DOWN) ;
}

for ($dist = 0; $dist <= 1000; $dist+=10) {

    $distm= $dist / 100;

    if ($distm == $Dmin) {
      echo "<tr style='height: ;'>";
        echo "<td style='width: 12%; height: 6px;'>&nbsp;</td>";
        echo "<td style='width: 12%; height: 6px;'><h2>".$distm." mètre (Dmin)<h2></td>";
        echo "<td style='width: 12%; height: 6px; background-color:#228B22'><h2>".VCDTableau($Dmin,$Vc5,$c1,$dist)." point<h2></td>";
        echo "<td style='width: 12%; height: 6px; background-color:#a9d08e'><h2>".VCDTableau($Dmin,$Vc3,$c2,$dist)." point<h2></td>";
        echo "<td style='width: 12%; height: 6px; background-color:#f2b084'><h2>".VCDTableau($Dmin,$Vc2,$c2,$dist)." point<h2></td>";
        echo "<td style='width: 12%; height: 6px; background-color:#f8cbad'><h2>".VCDTableau($Dmin,$Vc1,$c2,$dist)." point<h2></td>";
        echo "<td style='width: 12%; height: 6px;'></td>";
        echo "<td style='width: 12%; height: 6px;'>&nbsp;</td>";
      echo "</tr>";


    }

    else {
    echo "<tr style='height: ;'>";
      echo "<td style='width: 12%; height: 6px;'></td>";
      echo "<td style='width: 12%; height: 6px;'>".$distm." mètre </td>";


      if (VCD($Dmin,$Vc5,$c1,$dist)>VCD($Dmin,$Vc5,$c1,$dist-10)) {
        echo "<td style='width: 12%; height: 6px; background-color:#228B22'><b>----> ".VCD($Dmin,$Vc5,$c1,$dist)." points</b></td>";
      }
      else {
        echo "<td style='width: 12%; height: 6px; background-color:#228B22'>".VCD($Dmin,$Vc5,$c1,$dist)." points</td>";
      }

      if (VCD($Dmin,$Vc3,$c2,$dist)>VCD($Dmin,$Vc3,$c2,$dist-10)) {
        echo "<td style='width: 12%; height: 6px; background-color:#a9d08e'><b>---->".VCD($Dmin,$Vc3,$c2,$dist)." points</b></td>";
      }
      else {
      echo "<td style='width: 12%; height: 6px; background-color:#a9d08e'>".VCD($Dmin,$Vc3,$c2,$dist)." points</td>";
      }

      if (VCD($Dmin,$Vc2,$c2,$dist)>VCD($Dmin,$Vc2,$c2,$dist-10)) {
        echo "<td style='width: 12%; height: 6px; background-color:#f2b084'><b>---->".VCD($Dmin,$Vc2,$c2,$dist)." points</b></td>";
      }
      else {
      echo "<td style='width: 12%; height: 6px; background-color:#f2b084'>".VCD($Dmin,$Vc2,$c2,$dist)." point</td>";
      }

      if (VCD($Dmin,$Vc1,$c2,$dist)>VCD($Dmin,$Vc1,$c2,$dist-10)) {
        echo "<td style='width: 12%; height: 6px; background-color:#f8cbad'><b>---->".VCD($Dmin,$Vc1,$c2,$dist)." points</b></td>";
      }
      else {
        echo "<td style='width: 12%; height: 6px; background-color:#f8cbad'>".VCD($Dmin,$Vc1,$c2,$dist)." points</td>";
      }


      echo "<td style='width: 12%; height: 6px;'>&nbsp;</td>";
      echo "<td style='width: 12%; height: 6px;'>&nbsp;</td>";
    echo "</tr>";
    }
}
?>
</tbody>
</table>
</center>
<hr size='5' color='green' width='100%'>
