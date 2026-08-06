<?php
  //echo 'L adresse IP de l utilisateur est : '.$_SERVER['REMOTE_ADDR'];
  //$IP= substr($_SERVER['REMOTE_ADDR'], 0, 3);
  $IP= $_SERVER['REMOTE_ADDR'];
  //echo '<br>';
  //echo 'L adresse Small.IP de l utilisateur est : '.$IP;

  if ($IP=="127.0.0.1"){
?>

<table style="width: 100%; border-collapse: collapse; height:;" border="0">
<tbody>
  <tr style="height: ;">
    <!-- <td style="width: 12%; height: 6px; text-align: right;">Environnements : </td> -->
    <!-- <td style="width: 12%; height: 6px; text-align: center;"><a href="/iPassBall/">/iPassBall</a</td> -->
    <td style="width: 12%; height: 6px; text-align: center;"><a href="index.php">Accueil</a></td>
    <td style="width: 12%; height: 6px; text-align: right;"><b>OUTILS >>></b></td>
    <td style="width: 12%; height: 6px; text-align: center;"><a href="FormulaireJoueur.php">FormulaireJoueur.php</a></td>
    <td style="width: 12%; height: 6px; text-align: center;"><a href="CalculScoreLigneLog.php">CalculScoreLigneLog.php</a></td>
    <td style="width: 12%; height: 6px; text-align: center;"><a href="EssaisFormulePoints.php">EssaisFormulePoints.php</a></td>
    <!-- <td style="width: 12%; height: 6px; text-align: center;"><a href="LireEcrireFichier.php">LireEcrireFichier.php</a></td> -->
    <td style="width: 12%; height: 6px; text-align: center;"><a href="FournirFichiersSQL.php">FournirFichiersSQL.php</a></td>
    <td style="width: 12%; height: 6px; text-align: center;"><a href="EmailTelJoueurs.php">EmailTelJoueurs.php</a></td>
    <td style="width: 12%; height: 6px; text-align: center;"><?php echo  $IP; ?></td>
  </tr>
</tbody>
</table>
<br>

<?php
  }
?>
