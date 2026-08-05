<?php
include 'MenuDev.php';   // Ok.
include 'MenuIPassBall.php';  // Ok.
include_once 'Security.php';

include 'Constantes.php';  // Ok.
include 'Fonctions.php';  // Ok.
?>
<html>
<body>
<H1>Abaque Points Selon Distance</H1>
<H2>Le nombre de points ajoutés au score à chaque impact sur une cible n'est pas le même selon :<br>
<center>la cible ET la distance de frappe</center><H2>


    <h4>LA Formule : Valeur Cible (Distance) = Valeur Cible + Arrondi Inférieur { c x (Distance - Distance Nominale) x Valeur Cible}</h4>

    <h4>Avec :</h4>
    <h4>  Distance Nominale = Distance pour laquelle la valeur initale de la cible est valable.</h4>
    <H4>         --> En dessous, l'impact vaut moins. Au dessus, l'impact vaut plus.</H4>
    <h4>  c1 = Facteur pour les cibles 5 pt</h4>
    <h4>  c2 = Facteur pour les autres cibles</h4>


<H2>Pour faire des simulations :</H2>

<form action="EssaisFormulePoints.php" method="get">

  <table style="width: 100%; border-collapse: collapse; height:;" border="0">
  <tbody>

    <tr style='height: ;'>
      <td style='width: 12%; height: 6px;'></td>
      <td style='width: 12%; height: 6px;'></td>
      <td style='width: 12%; height: 6px;'><H2>Sélectionner</td>
      <td style='width: 12%; height: 6px;'><H2>Distance</td>
      <td style='width: 12%; height: 6px;'><H2>c1</td>
      <td style='width: 12%; height: 6px;'><H2>c2</td>
      <td style='width: 12%; height: 6px;'></td>
      <td style='width: 12%; height: 6px;'></td>

    </tr>
    <tr style='height: ;'>
      <td style='width: ; height: 12px;'></td>
      <td style='width: ; height: 12px;'></td>
      <td style='width: ; height: 12px;'></td>
      <td style='width: ; height: 12px;'>
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
      <td style='width: ; height: 12px;'>
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
          <option value="1.05"> 1.05</option>
          <option value="1.10"> 1.10</option>
          <option value="1.15"> 1.15</option>
          <option value="1.20"> 1.20</option>
          <option value="1.25"> 1.25</option>
          <option value="1.30"> 1.30</option>
          <option value="1.35"> 1.35</option>
          <option value="1.40"> 1.40</option>
        </select>
      </td>
      <td style='width: ; height: 12px;'>
        <select name="c2Select" size="1">
          <option value="0.15" selected> 0.15 </option>
          <option value="0.20"> 0.20</option>
          <option value="0.25"> 0.25</option>
          <option value="0.30"> 0.30</option>
          <option value="0.35"> 0.35</option>
          <option value="0.40"> 0.40</option>
          <option value="0.45"> 0.45</option>
          <option value="0.50"> 0.50</option>
        </select>
      </td>
      <td style='width: ; height: 12px;'>
          <input type="submit" name="envoyer" value="Afficher Abaque Point Selon Distance">
      </td>
      <td style='width: ; height: 12px;'></td>
    </tr>
  </tbody>
  </table>

</form>

</body>
</html>
<?php

$Dmin = app_get_float("DmiSelect", 2);
$c1 = app_get_float("c1Select", 0.9);
$c2 = app_get_float("c2Select", 0.15);
//echo "DmiSelect=".$_GET["DmiSelect"];
//echo " c1Select=".$_GET["c1Select"];
//echo " c2Select=".$_GET["c2Select"];

echo "</tbody>";
echo "</table>";

/*$Dmin = 2;
$c1 = 0.4;
$c2 = 0.15;*/
include 'ChartsPointDistance.php';
//include 'AbaqueTableauPointDistance.php';

include 'TableauPointDistance.php';


?>
