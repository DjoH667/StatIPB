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
    <td style="width: 12%; height: 6px; text-align: center;"><a href="/iPassBall/dev.iPassBall.com/">/iPassBall/dev.iPassBall.com/</a></td>
    <td style="width: 12%; height: 6px; text-align: right;"><b>OUTILS >>></b></td>
    <td style="width: 12%; height: 6px; text-align: center;"><a href="/iPassBall/dev.iPassBall.com/10 Essais/FormulaireJoueur.php">FormulaireJoueur.php</a></td>
    <td style="width: 12%; height: 6px; text-align: center;"><a href="/iPassBall/dev.iPassBall.com/10 Essais/CalculScoreLigneLog.php">CalculScoreLigneLog.php</a></td>
    <td style="width: 12%; height: 6px; text-align: center;"><a href="/iPassBall/dev.iPassBall.com/10 Essais/EssaisFormulePoints.php">EssaisFormulePoints.php</a></td>
    <!-- <td style="width: 12%; height: 6px; text-align: center;"><a href="/iPassBall/dev.iPassBall.com/10 Essais/LireEcrireFichier.php">LireEcrireFichier.php</a></td> -->
    <td style="width: 12%; height: 6px; text-align: center;"><a href="/iPassBall/dev.iPassBall.com/10 Essais/FournirFichiersSQL.php">FournirFichiersSQL.php</td>
    <td style="width: 12%; height: 6px; text-align: center;"><a href="/iPassBall/dev.iPassBall.com/10 Essais/EmailTelJoueurs.php">EmailTelJoueurs.php</td>
    <td style="width: 12%; height: 6px; text-align: center;"><?php echo  $IP; ?></td>
  </tr>
</tbody>
</table>
<br>

<?php
  }
?>
