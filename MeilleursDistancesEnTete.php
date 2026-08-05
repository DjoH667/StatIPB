<?php

if ($i>1){

  echo "</tbody>";
  echo "</table>";

}

echo "<h2>";
echo "TOP ".($i+10)." des distances";
echo "</h2>";

echo "<h4><u>Légende : </u><br>";
echo "C = Classement <br>";
echo "#P = n° de Partie >> Cliquez pour avoir le détail de la Partie<br>";
echo "#I/#TI= N°Impact / Total des Impacts de la partie <br>";
echo "#S = n° de Session >> Cliquez pour avoir le détail de la Session<br>";

// echo "Code = Code Joueur >> Cliquer pour avoir le détail des parties du joueur<br>";
// echo "+++   Imp = nombre d'impacts ; Pts / Imp = nb de points par impact <br><br>";
//echo "5g = Cible '5'gauche ; 5d = Cible '5'droite		G = cibles de Gauche ; D = cibles de Droite ; H	cibles Hautes ; B cibles Basses </h4><br>";


echo "<table style='width: ; margin-left:auto;margin-right:auto;' border='0'";
echo "<tbody>";
echo "<thead>";

echo "<tr>";
// echo "<td style='width: 15px'> </td>";
// echo "<td style='width: 15px'> </td>";
echo "<td style='text-align: center;width: 30px'><b>C</b></td>";
echo "<td style='text-align: right;width: 10px'></td>";

//echo "<td style='width: 15px'><b>IdJoueur</b></td>";
echo "<td style='text-align: center;width: 80px'><b>Distance</b></td>";
echo "<td style='text-align: center;width: 60px'><b>Code</b></td>";

echo "<td style='text-align: right;width: 10px'></td>";
echo "<td style='text-align: center;width: 15px'><b>#P</b></td>";
echo "<td style='text-align: center;width: 15px'><b>#I/#TI</b></td>";
echo "<td style='text-align: center;width: 15px'><b>#S</b></td>";

// echo "<td style='width: 100px'><b>Nom</b></td>";
//
// echo "<td style='width: 10px'><b></b></td>";
//
// echo "<td style='width: 50px'><b>Score</b></td>";
// echo "<td style='width: 10px'> </td>";
//
// echo "<td style='width: 50px'><b>Imp</b></td>";
// echo "<td style='width: 80px'>Pts / Imp</td>";
// echo "<td style='width: 10px'> </td>";
//
// echo "<td style='width: 80px'><b>D moy</b></td>";
// echo "<td style='width: 80px'><b>D min</b></td>";
// echo "<td style='width: 80px'><b>D Max</b></td>";
//
//
// echo "<td style='width: 30px'><b></b></td>";
//
// //echo "<td style='width: 100px'><b>Duree</b></td>";
// echo "<td style='width: 100px'><b>D Nominale</b></td>";
// echo "<td style='width: 100px'><b>c1/c2</b></td>";
//
// echo "<td style='width: 10px'></td>";
// echo "<td style='width: 110px'><b>Date</b></td>";

echo "</tr>";

echo "</thead>";

echo "<tr>";
echo "</tr>";


?>
