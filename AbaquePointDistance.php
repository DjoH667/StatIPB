<?php
include 'MenuDev.php';  // Ok.
include 'MenuIPassBall.php';  // Ok.
?>
<html>
<body>
<H1>Abaque Point Distance</H1>
<H2>Le nombre de points ajoutés au score n'est pas le même selon la cible ET la distance de frappe.<H2>

<center>
    <H2>Valeur Cible (Distance) = Valeur Cible + Arrondi Inférieur { c x (Distance - Dmin) x Valeur Cible}</H2>
    <H3>Avec :</H3>
    <H3>  Dmin = Distance pour laquelle la valeur initale de la cible est valable.</H3>
    <H4>         --> En dessous, l'impact vaut moins. Au dessus, l'impact vaut plus.</H4>
    <H3>  c1 = Facteur pour les cibles 5 pt</H3>
    <H3>  c2 = Facteur pour les autres cibles</H3>
</center>

<H2>Pour faire des simulations :</H2>

<form action="AbaquePointDistance.php" method="get">
  <table style="width: 100%; border-collapse: collapse; height:;" border="0">
  <tbody>
    <tr style='height: ;'>
      <td style='width: 12%; height: 6px;'></td>
      <td style='width: 12%; height: 6px;'></td>
      <td style='width: 12%; height: 6px;'>Sélectionner</td>
      <td style='width: 12%; height: 6px;'>Distance</td>
      <td style='width: 12%; height: 6px;'>c1</td>
      <td style='width: 12%; height: 6px;'>c2</td>
      <td style='width: 12%; height: 6px;'></td>
      <td style='width: 12%; height: 6px;'></td>

    </tr>
    <tr style='height: ;'>
      <td style='width: 12%; height: 6px;'></td>
      <td style='width: 12%; height: 6px;'></td>
      <td style='width: 12%; height: 6px;'></td>
      <td style='width: 12%; height: 6px;'>
        <select name="DmiSelect" >
          <option value="0"> o mètre</option>
          <option value="1"> 1 mètre</option>
          <option value="2"> 2 mètre</option>
          <option value="3"> 3 mètre</option>
          <option value="4"> 4 mètre</option>
          <option value="5"> 5 mètre</option>
        </select>
      </td>
      <td style='width: 12%; height: 6px;'>
        <select name="c1Select" >
          <option value="0.15"> 0.15 </option>
          <option value="0.20"> 0.20</option>
          <option value="0.25"> 0.25</option>
          <option value="0.30"> 0.30</option>
          <option value="0.35"> 0.35</option>
          <option value="0.40"> 0.4</option>
        </select>
      </td>
      <td style='width: 12%; height: 6px;'>
        <select name="c2Select" >
          <option value="0.15"> 0.15 </option>
          <option value="0.20"> 0.20</option>
          <option value="0.25"> 0.25</option>
          <option value="0.30"> 0.30</option>
          <option value="0.35"> 0.35</option>
          <option value="0.40"> 0.4</option>
        </select>
      </td>
      <td style='width: 12%; height: 6px;'>
          <input type="submit" name="envoyer" value="Afficher Abaque Point Selon Distance">
      </td>
      <td style='width: 12%; height: 6px;'></td>
    </tr>
  </tbody>
  </table>

</form>

</body>
</html>
<?php

if ($_GET["DmiSelect"] == "") {
$Dmin = 2;

}
else {
$Dmin = $_GET["DmiSelect"];
}

if ($_GET["c1Select"] == "") {
$c1 =0.4;

}
else {
$c1 = $_GET["c1Select"];
}

if ($_GET["c2Select"] == "") {
$c2 =0.15;

}
else {
$c2 = $_GET["c2Select"];
}
//echo "DmiSelect=".$_GET["DmiSelect"];
//echo " c1Select=".$_GET["c1Select"];
//echo " c2Select=".$_GET["c2Select"];

$Dmin = $_GET["DmiSelect"];
$c1 = $_GET["c1Select"];
$c2 = $_GET["c2Select"];

/*$Dmin = 2;
$c1 = 0.4;
$c2 = 0.15;*/
include 'AbaqueChartsPointDistance.php';
include 'AbaqueTableauPointDistance.php';
?>
</tbody>
</table>
