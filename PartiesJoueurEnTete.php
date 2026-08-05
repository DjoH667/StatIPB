<?php

if ($i>1){

  //echo "LigneGraphiquePoints avant include dans boucle = ".$LigneGraphiquePoints."<br>";

  echo "</tbody>";
  echo "</table>";

  if ($iBoucleDuree > 2) {

//echo "TOTO";
  include 'PartiesJoueurChartsScore.php';
  include 'PartiesJoueurChartsImpact.php';


  //echo "iDuree en tete ="."$iDuree"."<br>";
  //echo "<div id='chart_point_".$i.'" style='width: 100%; height: 500px;' align='center'></div>";
  echo "<br>";
  echo "<div id='chart_Score".$iDuree."' style='width: 100%; height: 500px;' align='center'></div>";

  echo "<br>";
  echo "<div id='chart_point".$iDuree."' style='width: 100%; height: 500px;' align='center'></div>";

  }

  $LigneGraphiquePoints="";
  $LigneGraphiqueScore="";

}

echo "<H2>Durée Partie = ".$StringDureePartie."</H2></td>";


echo "<table style='width: ; margin-left:auto;margin-right:auto;' border='0'";
echo "<tbody>";
echo "<thead>";
echo "<tr>";
// echo "<td style='width: 15px'> </td>";
// echo "<td style='width: 15px'> </td>";
// echo "<td style='width: 15px'> </td>";

echo "<td style='width: 15px'><b>#p</b></td>";
echo "<td style='font-size: 14px;width: 50px'><b>Date</b></td>";
//echo "<td style='width: 100px'><b>Durée</b></td>";

echo "<td style='width: 50px'><b>Score</b></td>";
echo "<td style='width: 10px'> </td>";

echo "<td style='width: 40px'><b>Imp</b></td>";
echo "<td style='font-size: 14px;width: 60px'><b>Pts / Imp</b></td>";
echo "<td style='width: 10px'> </td>";

echo "<td style='width: 50px; text-align: center;'><b>5g</b></td>";
echo "<td style='width: 50px; text-align: center;'><b>5d</b></td>";
echo "<td style='width: 10px'> </td>";

echo "<td style='width: 50px; text-align: center;'><b>G</b></td>";
echo "<td style='width: 50px; text-align: center;'><b>D</b></td>";
echo "<td style='width: 10px'> </td>";

echo "<td style='width: 50px; text-align: center;'><b>H</b></td>";
echo "<td style='width: 50px; text-align: center;'><b>B</b></td>";
echo "<td style='width: 10px'> </td>";

echo "<td style='width: 80px'><b>D moy</b></td>";
echo "<td style='font-size: 14px;width: 50px'><b>D min</b></td>";
echo "<td style='font-size: 14px;width: 60px'><b>D Max</b></td>";

echo "<td style='width: 10px'> </td>";
echo "<td style='font-size: 12px;width: 70px'><b>D Nominale</b></td>";
echo "<td style='font-size: 12px;width: 15px'><b>c1</b></td>";
echo "<td style='font-size: 12px;width: 15px'><b>c2</b></td>";

// echo "<td style='width: 15px'> </td>";
// echo "<td style='width: 15px'> </td>";
// echo "<td style='width: 15px'> </td>";
echo "</tr>";
echo "</thead>";


// echo "<tr style='height: 10px; background-color: #e9f0ea '>";
// echo "<td colspan='6'> </td>";
// echo "</tr>";
// echo "<tr>";
// echo "<td colspan='22' style='height: 10px; background-color: #e9f0ea '><H2>Durée Partie = ".$StringDureePartie."</H2></td>";
// echo "</tr>";

?>
