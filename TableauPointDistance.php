

<?php


?>
<hr size='5' color='green' width='100%'>
<hr size='5' color='green' width='100%'>
<h2>Tableau Points selon Distance avec Distance Nominale = <?php echo $Dmin ?> mètres, c1 = <?php echo$c1 ?> et c2 = <?php echo $c2 ?></h2>
<!-- <hr size='5' color='green' width='100%'>
<hr size='5' color='green' width='100%'> -->

<h4><u>LEGENDE : </u><br><br>


<i style='color: black; text-transform: italic;'>

<b>VCD</b><br>
>> fonction de calcul implmémentée ds iPassBall<br>
Vc + ArrondiSup(c x (ArrondiSup(Distance - Distance Nominale) x Vc)<br>
<br>

<b>iVCD</b><br>
>> fonction de calcul plus progessive<br>
Vc + ArrondiSup(c x (Distance - Distance Nominale) x Vc)<br>
<br>

<b>pVCD</b><br>
>> fonction de calcul plus progessive et parabolique <br>
Vc + ArrondiSup(c x (ArrondiSup(Distance - Distance Nominale)) x ArrondiSup(c x (ArrondiSup(Distance - Distance Nominale)) <br>
<br>

<br>

</i>

<center>
<table style="width: ; border-collapse: collapse; height:;" border="1">
<tbody>
  <tr style='height: ;'>
    <!-- <td style='width: 120px; height: 6px;'></td> -->
    <td style='width: 220px;; height: 6px;font-size: 32px;'><b></b></td>
    <td style='font-size: 32px;text-align: center;' colspan=3><b>Cible 5</b></td>
    <td style='font-size: 32px;text-align: center;' colspan=3><b>Cible 3</b></td>
    <td style='font-size: 32px;text-align: center;' colspan=3><b>Cible 2</b></td>
    <td style='font-size: 32px;text-align: center;' colspan=3><b>Cible 1</b></td>
    <!-- <td style='width: 120px; height: 6px;'>&nbsp;</td> -->
    <!-- <td style='width: 120px; height: 6px;'>&nbsp;</td> -->
  </tr>

  <tr style='height: ;'>
    <!-- <td style='width: 120px; height: 6px;'></td> -->
    <td style='width: 220px;; height: 6px;font-size: 32px;'><b>Distance</b></td>

    <td style='width: 120px; height: 6px;font-size: 24px; text-align: center;'><b>VCD 5</b></td>
    <td style='width: 120px; height: 6px;font-size: 24px; text-align: center;'><b>iVCD 5</b></td>
    <td style='width: 120px; height: 6px;font-size: 24px; text-align: center;'><b>pVCD 5</b></td>

    <td style='width: 120px; height: 6px;font-size: 24px; text-align: center;'><b>VCD 3</b></td>
    <td style='width: 120px; height: 6px;font-size: 24px; text-align: center;'><b>iVCD 3</b></td>
    <td style='width: 120px; height: 6px;font-size: 24px; text-align: center;'><b>pVCD 3</b></td>

    <td style='width: 120px; height: 6px;font-size: 24px; text-align: center;'><b>VCD 2</b></td>
    <td style='width: 120px; height: 6px;font-size: 24px; text-align: center;'><b>iVCD 2</b></td>
    <td style='width: 120px; height: 6px;font-size: 24px; text-align: center;'><b>pVCD 2</b></td>

    <td style='width: 120px; height: 6px;font-size: 24px; text-align: center;'><b>VCD 1</b></td>
    <td style='width: 120px; height: 6px;font-size: 24px; text-align: center;'><b>iVCD 1</b></td>
    <td style='width: 120px; height: 6px;font-size: 24px; text-align: center;'><b>pVCD 1</b></td>
    <!-- <td style='width: 120px; height: 6px;'>&nbsp;</td> -->
    <!-- <td style='width: 120px; height: 6px;'>&nbsp;</td> -->
  </tr>



<?php
function VCDTableau($Dm,$Vc,$c,$d) {
    return $Vc + round($c * ($d/100 - $Dm)*$Vc,0, PHP_ROUND_HALF_UP) ;
}


$c1 = $c1*$FacteurParabole;
//for ($dist = 0; $dist <= 1000; $dist+=10) {
for ($dist = 0; $dist <= 1000; $dist+=10) {

    $distm= $dist / 100;

    if ($distm == $Dmin) {
      echo "<tr>";
      echo "<td colspan=13><hr size='5' color='green'></td>";
      echo "</tr>";
      echo "<tr style='height: ;'>";
        //echo "<td style='font-size: 18px; height: 6px;'>&nbsp;</td>";
        echo "<td style='font-size: 20px; height: 6px;'><b style='color:red'> D nominale : ".$distm." mètres<b></td>";

        echo "<td style='font-size: 24px; height: 6px; background-color:#228B22'><b>".VCD($Dmin,$Vc5,$c1,$dist)." points<b></td>";
        echo "<td style='font-size: 24px; height: 6px; background-color:#228B22'><b>".InitialeVCD($Dmin,$Vc5,$c1,$dist)." points<b></td>";
        $c1=$c1/$FacteurParabole;
        echo "<td style='font-size: 24px; height: 6px; background-color:#228B22'><b>".ParaboleVCD($Dmin,$Vc5,$c1,$c1,$c2,$dist)." points<b></td>";
        $c1=$c1*$FacteurParabole;
        echo "<td style='font-size: 24px; height: 6px; background-color:#a9d08e'><b>".VCD($Dmin,$Vc3,$c2,$dist)." points<b></td>";
        echo "<td style='font-size: 24px; height: 6px; background-color:#a9d08e'><b>".InitialeVCD($Dmin,$Vc3,$c2,$dist)." points<b></td>";
        echo "<td style='font-size: 24px; height: 6px; background-color:#a9d08e'><b>".ParaboleVCD($Dmin,$Vc3,$c2,$c1,$c2,$dist)." points<b></td>";

        echo "<td style='font-size: 24px; height: 6px; background-color:#f2b084'><b>".VCD($Dmin,$Vc2,$c2,$dist)." points<b></td>";
        echo "<td style='font-size: 24px; height: 6px; background-color:#f2b084'><b>".InitialeVCD($Dmin,$Vc2,$c2,$dist)." points<b></td>";
        echo "<td style='font-size: 24px; height: 6px; background-color:#f2b084'><b>".ParaboleVCD($Dmin,$Vc2,$c2,$c1,$c2,$dist)." points<b></td>";

        echo "<td style='font-size: 24px; height: 6px; background-color:#f8cbad'><b>".VCD($Dmin,$Vc1,$c2,$dist)." points<b></td>";
        echo "<td style='font-size: 24px; height: 6px; background-color:#f8cbad'><b>".InitialeVCD($Dmin,$Vc1,$c2,$dist)." points<b></td>";
        echo "<td style='font-size: 24px; height: 6px; background-color:#f8cbad'><b>".ParaboleVCD($Dmin,$Vc1,$c2,$c1,$c2,$dist)." points<b></td>";
        //echo "<td style='font-size: 18px; height: 6px;'></td>";
        // echo "<td style='font-size: 18px; height: 6px;'>&nbsp;</td>";
      echo "</tr>";
      echo "<tr>";
      echo "<td colspan=13><hr size='5' color='green'></td>";
      echo "</tr>";


    }

    else {
    echo "<tr style='height: ;'>";
      //echo "<td style='font-size: 18px; height: 6px;'></td>";
      $r = fmod($dist,100);
      //echo "r=".$r."<br>";
      if ($r==0) {
        echo "<td style='font-size: 24px; height: 6px;'><b style='color:green'>>>>".$distm." mètres >></b></td>";
      }
      elseif ($r==50){
        echo "<td style='font-size: 24px; height: 6px;'><b>>>".$distm." mètres >></b></td>";

      }
      else{
        echo "<td style='font-size: 18px; height: 6px;'>".$distm." mètres </td>";

      }

      // Cible 5
      // Cible 5
      // Cible 5

      if (VCD($Dmin,$Vc5,$c1,$dist)>VCD($Dmin,$Vc5,$c1,$dist-10)) {
        echo "<td style='font-size: 24px; height: 6px; background-color:#228B22'><b style='color:red'>>  ".VCD($Dmin,$Vc5,$c1,$dist)." points</b></td>";
      }
      else {
        echo "<td style='font-size: 18px; height: 6px; background-color:#228B22'>".VCD($Dmin,$Vc5,$c1,$dist)." points</td>";
      }

      if (InitialeVCD($Dmin,$Vc5,$c1,$dist)>InitialeVCD($Dmin,$Vc5,$c1,$dist-10)) {
        echo "<td style='font-size: 24px; height: 6px; background-color:#228B22'><b style='color:red'>>  ".InitialeVCD($Dmin,$Vc5,$c1,$dist)." points</b></td>";
      }
      else {
        echo "<td style='font-size: 18px; height: 6px; background-color:#228B22'>".InitialeVCD($Dmin,$Vc5,$c1,$dist)." points</td>";
      }

      if (ParaboleVCD($Dmin,$Vc5,$c1,$c1,$c2,$dist)>ParaboleVCD($Dmin,$Vc5,$c1,$c1,$c2,$dist-10)) {
        $c1=$c1/$FacteurParabole;
        echo "<td style='font-size: 24px; height: 6px; background-color:#228B22'><b style='color:red'>>  ".ParaboleVCD($Dmin,$Vc5,$c1,$c1,$c2,$dist)." points</b></td>";
        $c1=$c1*$FacteurParabole;
      }
      else {
        $c1=$c1/$FacteurParabole;
        echo "<td style='font-size: 18px; height: 6px; background-color:#228B22'>".ParaboleVCD($Dmin,$Vc5,($c1/$FacteurParabole),$c1,$c2,$dist)." points</td>";
        $c1=$c1*$FacteurParabole;
      }


      // Cible 3
      // Cible 3
      // Cible 3

      if (VCD($Dmin,$Vc3,$c2,$dist)>VCD($Dmin,$Vc3,$c2,$dist-10)) {
        echo "<td style='font-size: 24px; height: 6px; background-color:#a9d08e'><b style='color:red'>> ".VCD($Dmin,$Vc3,$c2,$dist)." points</b></td>";
      }
      else {
      echo "<td style='font-size: 18px; height: 6px; background-color:#a9d08e'>".VCD($Dmin,$Vc3,$c2,$dist)." points</td>";
      }

      if (InitialeVCD($Dmin,$Vc3,$c2,$dist)>InitialeVCD($Dmin,$Vc3,$c2,$dist-10)) {
        echo "<td style='font-size: 24px; height: 6px; background-color:#a9d08e'><b style='color:red'>> ".InitialeVCD($Dmin,$Vc3,$c2,$dist)." points</b></td>";
      }
      else {
      echo "<td style='font-size: 18px; height: 6px; background-color:#a9d08e'>".InitialeVCD($Dmin,$Vc3,$c2,$dist)." points</td>";
      }

      if (ParaboleVCD($Dmin,$Vc3,$c2,$c1,$c2,$dist)>ParaboleVCD($Dmin,$Vc3,$c2,$c1,$c2,$dist-10)) {

        echo "<td style='font-size: 24px; height: 6px; background-color:#a9d08e'><b style='color:red'>> ".ParaboleVCD($Dmin,$Vc3,$c2,$c1,$c2,$dist)." points</b></td>";
      }
      else {
      echo "<td style='font-size: 18px; height: 6px; background-color:#a9d08e'>".ParaboleVCD($Dmin,$Vc3,$c2,$c1,$c2,$dist)." points</td>";
      }

      // Cible 2
      // Cible 2
      // Cible 2

      if (VCD($Dmin,$Vc2,$c2,$dist)>VCD($Dmin,$Vc2,$c2,$dist-10)) {
        echo "<td style='font-size: 24px; height: 6px; background-color:#f2b084'><b style='color:red'>> ".VCD($Dmin,$Vc2,$c2,$dist)." points</b></td>";
      }
      else {
      echo "<td style='font-size: 18px; height: 6px; background-color:#f2b084'>".VCD($Dmin,$Vc2,$c2,$dist)." point</td>";
      }

      if (InitialeVCD($Dmin,$Vc2,$c2,$dist)>InitialeVCD($Dmin,$Vc2,$c2,$dist-10)) {
        echo "<td style='font-size: 24px; height: 6px; background-color:#f2b084'><b style='color:red'>> ".InitialeVCD($Dmin,$Vc2,$c2,$dist)." points</b></td>";
      }
      else {
      echo "<td style='font-size: 18px; height: 6px; background-color:#f2b084'>".InitialeVCD($Dmin,$Vc2,$c2,$dist)." point</td>";
      }

      if (ParaboleVCD($Dmin,$Vc2,$c2,$c1,$c2,$dist)>ParaboleVCD($Dmin,$Vc2,$c2,$c1,$c2,$dist-10)) {
        echo "<td style='font-size: 24px; height: 6px; background-color:#f2b084'><b style='color:red'>> ".ParaboleVCD($Dmin,$Vc2,$c2,$c1,$c2,$dist)." points</b></td>";
      }
      else {
      echo "<td style='font-size: 18px; height: 6px; background-color:#f2b084'>".ParaboleVCD($Dmin,$Vc2,$c2,$c1,$c2,$dist)." point</td>";
      }

      // Cible 1
      // Cible 1
      // Cible 1

      if (VCD($Dmin,$Vc1,$c2,$dist)>VCD($Dmin,$Vc1,$c2,$dist-10)) {
        echo "<td style='font-size: 18px; height: 6px; background-color:#f8cbad'><b style='color:red'>> ".VCD($Dmin,$Vc1,$c2,$dist)." points</b></td>";
      }
      else {
        echo "<td style='font-size: 18px; height: 6px; background-color:#f8cbad'>".VCD($Dmin,$Vc1,$c2,$dist)." points</td>";
      }

      if (InitialeVCD($Dmin,$Vc1,$c2,$dist)>InitialeVCD($Dmin,$Vc1,$c2,$dist-10)) {
        echo "<td style='font-size: 18px; height: 6px; background-color:#f8cbad'><b style='color:red'>> ".InitialeVCD($Dmin,$Vc1,$c2,$dist)." points</b></td>";
      }
      else {
        echo "<td style='font-size: 18px; height: 6px; background-color:#f8cbad'>".InitialeVCD($Dmin,$Vc1,$c2,$dist)." points</td>";
      }

      if (ParaboleVCD($Dmin,$Vc1,$c2,$c1,$c2,$dist)>ParaboleVCD($Dmin,$Vc1,$c2,$c1,$c2,$dist-10)) {
        echo "<td style='font-size: 18px; height: 6px; background-color:#f8cbad'><b style='color:red'>> ".ParaboleVCD($Dmin,$Vc1,$c2,$c1,$c2,$dist)." points</b></td>";
      }
      else {
        echo "<td style='font-size: 18px; height: 6px; background-color:#f8cbad'>".ParaboleVCD($Dmin,$Vc1,$c2,$c1,$c2,$dist)." points</td>";
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
