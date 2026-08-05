<?php

include 'MenuIPassBall.php';  // Ok.
include_once 'Security.php';
?>
<?php
/**
 * Exemple simple qui étend la classe SQLite3 et change les paramètres
 * __construct, puis, utilise la méthode de connexion pour initialiser la
 * base de données.
 */
include 'ConnexionBDDiPassBall.php';

$IdJ = app_get_int("IdJ");

// ********************
// RAMENER Infos Joueur
// ********************

$SqlInfosJoueur = "SELECT * FROM Joueurs where IdJoueur =".$IdJ;
/*$reponse = $bd->query($sql, SQLITE3_BOTH, $err);*/
$ReponseInfosJoueur = $bd->query($SqlInfosJoueur);
if ($ReponseInfosJoueur === FALSE) {
    echo "La requete Joueurs a echouee pour la raison suivante: ".$err;
} else {

$RowInfosJoueur = $ReponseInfosJoueur->fetchArray();

// ************************************
// RAMENER le nombre max parties jouées
// ************************************

$SqlNbParties = "SELECT Count(IdPartie) FROM ParametresPartie where IdJoueur=".$IdJ;
/*$reponse = $bd->query($sql, SQLITE3_BOTH, $err);*/
$ReponseNbParties = $bd->query($SqlNbParties);

$RowNbParties = $ReponseNbParties->fetchArray();


// ************************************
// RAMENER dernière partie jouée
// ************************************

$SqlDernierePartie = "SELECT Max(DatePartie) FROM ParametresPartie where IdJoueur=".$IdJ;
/*$reponse = $bd->query($sql, SQLITE3_BOTH, $err);*/
$ReponseDernierePartie = $bd->query($SqlDernierePartie);

$RowDernierePartie = $ReponseDernierePartie->fetchArray();

list($AnneeDP, $MoisDP, $JourDP) = explode('-',$RowDernierePartie['Max(DatePartie)']);

// ************************************
// RAMENER somme des points
// ************************************

$SqlDernierePartie = "SELECT Sum(Score) FROM SyntheseDonneesParties where IdJoueur=".$IdJ;
/*$reponse = $bd->query($sql, SQLITE3_BOTH, $err);*/
$ReponseDernierePartie = $bd->query($SqlDernierePartie);

$RowDernierePartie = $ReponseDernierePartie->fetchArray();

$TotalPoints = $RowDernierePartie['Sum(Score)'];



// ************************************
// RAMENER somme des impacts
// ************************************

$SqlDernierePartie = "SELECT Sum(NbImp) FROM SyntheseDonneesParties where IdJoueur=".$IdJ;
/*$reponse = $bd->query($sql, SQLITE3_BOTH, $err);*/
$ReponseDernierePartie = $bd->query($SqlDernierePartie);

$RowDernierePartie = $ReponseDernierePartie->fetchArray();

$TotalImpacts = $RowDernierePartie['Sum(NbImp)'];

// ************************************
// RAMENER somme des distance moyenne
// ************************************

$SqlDernierePartie = "SELECT Sum(dmoy) FROM SyntheseDonneesParties where IdJoueur=".$IdJ;
/*$reponse = $bd->query($sql, SQLITE3_BOTH, $err);*/
$ReponseDernierePartie = $bd->query($SqlDernierePartie);

$RowDernierePartie = $ReponseDernierePartie->fetchArray();

$TotalDmoy = $RowDernierePartie['Sum(dmoy)'];



?>

<h1>FICHE JOUEUR <?php echo $RowInfosJoueur['CodeJoueur'] ?> </h1>
<table style='width: 100%;'border='0'>
<!-- <tbody> -->


<!-- <thead> -->
<!-- <tr>

  <td style='width: '> </td>

  <td style='width:  200px'><h2><b><a href='PartiesJoueur.php?IdJ=<?php echo $IdJ ?>&NomJ=<?php echo $RowInfosJoueur['NomJoueur'] ?>&PrenomJ=<?php echo $RowInfosJoueur['PrenomJoueur'] ?>'>>>&nbsp;Parties de <?php echo $RowInfosJoueur['CodeJoueur'] ?></a></b></h2></td>
  <td style='width:  200px'>>>>Défier Joueur</td>
  <td style='width:  200px; text-align: right;'></td>
  <td style='width:  200px; text-align: left;'></td>

  <td style='width: '> </td>

</tr> -->
<!-- </thead> -->

<tr>

  <td style='width:  '> </td>

  <td style='width:  '><b>Code</b></td>
  <td style='width:  '><b>Prénom </b></td>
  <td style='width:  '><b>Nom </b></td>
  <td style='width:  '><b>Année  </b></td>

  <td style='width:  '> </td>

</tr>

<tr>

  <td style='width:  '> </td>

  <td style='width:  200px'><h1> <?php echo $RowInfosJoueur['CodeJoueur'] ?></h1></td>
  <td style='width:  200px'><h1> <?php echo $RowInfosJoueur['PrenomJoueur'] ?></h1></td>
  <?php $NomJ=substr($RowInfosJoueur['NomJoueur'], 0, 3); ?>
  <td style='width:  200px'><h1> <?php echo $NomJ ?> </h1></td>
  <?php list($Annee, $Mois, $Jour) = explode('-',$RowInfosJoueur['DateNaissance']);?>
  <td style='width:  200px; text-align: center;'><h1> <?php echo $Annee ?></h1></td>

  <td style='width:  '> </td>

</tr>

<tr>

  <td style='width:  '> </td>

  <td style='width:  ;text-align: right;'><h3><b>  Poste :</b></h3></td>
  <td style='width:  ;text-align: left;'><h3><b>&nbsp; <?php echo $RowInfosJoueur['PosteJoueur'] ?> </b></h3></td>
  <td style='width:  ;text-align: right;'><h3><b>  Pied </b></h3></td>
  <td style='width:  ;text-align: left;'><h3><b><?php echo $RowInfosJoueur['PiedJoueur'] ?> </b></h3></td>

  <td style='width:  '> </td>

</tr>


<tr>

  <td style='width:  '> </td>

  <td style='width:  '><b> &nbsp</b></td>
  <td style='width:  '><b> </b></td>
  <td style='width:  '><b> </b></td>
  <td style='width:  '><b> </b></td>

  <td style='width:  '> </td>

</tr>

<tr>

  <td style='width:  '> </td>

  <td style='width:  ; text-align: left;'><b> Club du Joueur </b></td>
  <td style='width:  ; text-align: left;'><b> Club de Coeur</b></td>
  <td style='width:  ; text-align: left;'><b> Joueur Préféré</b></td>
  <td style='width:  ; text-align: left;'><b> Niveau</b></td>

  <td style='width:  '> </td>

</tr>

<tr>

  <td style='width:  '> </td>

  <td style='width:  ; text-align: center;'><h2><b> <?php echo $RowInfosJoueur['ClubJoueur'] ?></b></h2></td>
  <td style='width:  ; text-align: center;'><h2><b> <?php echo $RowInfosJoueur['Club2Coeur'] ?></b></h2></td>
  <td style='width:  ; text-align: center;'><h2><b> <?php echo $RowInfosJoueur['JoueurPrefere'] ?></b></h2></td>
  <td style='width:  ; text-align: center;'><h2><b> A Calculer </b></h2></td>

  <td style='width:  '> </td>

</tr>

<tr>

  <td style='width:  '> </td>

  <td style='width:  '><b> &nbsp</b></td>
  <td style='width:  '><b> </b></td>
  <td style='width:  '><b> </b></td>
  <td style='width:  '><b> </b></td>

  <td style='width:  '> </td>

</tr>

<tr>

  <td style='width:  '> </td>

  <td style='width:  '><b> Parties jouées : </b></td>
  <td style='width:  '><b> Dernière Partie : </b></td>
  <td style='width:  '><b> Nb pts par impact : </b></td>
  <td style='width:  '><b> Distance Moyenne : </b></td>

  <td style='width:  '> </td>

</tr>

<tr>

  <td style='width:  '> </td>

<?php

$NbParties = $RowNbParties['Count(IdPartie)'];
number_format($TotalDmoy / $NbParties, 2, ',', ' ');
$PtsPArImpactMoy = number_format($TotalPoints / $TotalImpacts, 2, ',', ' ');
$DmoyTotal =  number_format($TotalDmoy / $NbParties, 2, ',', ' ');

?>

  <td style='width:  ; text-align: center;'><h2><b> <?php echo $NbParties ?></b></h2></td>
  <td style='width:  ; text-align: center;'><h2><b> <?php echo $JourDP."/".$MoisDP."/".$AnneeDP ?></b></h2></td>
  <td style='width:  ; text-align: center;'><h2><b> <?php echo $PtsPArImpactMoy ?></b></h2></td>
  <td style='width:  ; text-align: center;'><h2><b> <?php echo $DmoyTotal ?> m</b></h2></td>

  <td style='width:  '> </td>

</tr>

<tr>

  <td style='width:  '> </td>

  <td style='width:  '><b> &nbsp</b></td>
  <td style='width:  '><b> </b></td>
  <td style='width:  '><b> </b></td>
  <td style='width:  '><b> </b></td>

  <td style='width:  '> </td>

</tr>

<!-- <thead> -->
<tr>

  <td style='width:  '> </td>

  <td colspan="2" style='width:  ;'  ><h2><b><a href='PartiesJoueur.php?IdJ=<?php echo $IdJ ?>&NomJ=<?php echo $RowInfosJoueur['NomJoueur'] ?>&PrenomJ=<?php echo $RowInfosJoueur['PrenomJoueur'] ?>'>>>>Parties de <?php echo $RowInfosJoueur['CodeJoueur'] ?></a></b></h2></td>
  <!-- <td style='width:  '>>>>Défier Joueur</td> -->
  <td style='width:  ; text-align: right;'>Fiche crée le :</td>

  <?php list($Annee, $Mois, $Jour) = explode('-',$RowInfosJoueur['DateCreation']);?>

  <td style='width:  ; text-align: left;'><?php echo $Jour."/".$Mois."/".$Annee ?></td>

  <td style='width:  '> </td>

</tr>
<!-- </thead> -->

<!-- </tbody> -->
</table>
<br>
<!-- <hr size='5'color='green'> -->



<?php
}
// Deconnexion
$bd = null;
?>
