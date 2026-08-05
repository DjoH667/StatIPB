<?php

include 'MenuDev.php';   // Ok.
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

$SqlInfosJoueur = "SELECT MAX(IdJoueur) FROM Joueurs ";
/*$reponse = $bd->query($sql, SQLITE3_BOTH, $err);*/
$ReponseInfosJoueur = $bd->query($SqlInfosJoueur);
if ($ReponseInfosJoueur === FALSE) {
    echo "La requete Joueurs a echouee pour la raison suivante: ".$err;
} else {

$RowInfosJoueur = $ReponseInfosJoueur->fetchArray();

//echo "MAX(IdJoueur)=".$RowInfosJoueur['MAX(IdJoueur)'];

// ************************************
// RAMENER le nombre max parties jouées
// ************************************

// $SqlNbParties = "SELECT Count(IdPartie) FROM ParametresPartie where IdJoueur=".$IdJ;
// /*$reponse = $bd->query($sql, SQLITE3_BOTH, $err);*/
// $ReponseNbParties = $bd->query($SqlNbParties);
//
// $RowNbParties = $ReponseNbParties->fetchArray();


// ************************************
// RAMENER dernière partie jouée
// ************************************

// $SqlDernierePartie = "SELECT Max(DatePartie) FROM ParametresPartie where IdJoueur=".$IdJ;
// /*$reponse = $bd->query($sql, SQLITE3_BOTH, $err);*/
// $ReponseDernierePartie = $bd->query($SqlDernierePartie);
//
// $RowDernierePartie = $ReponseDernierePartie->fetchArray();
//
// list($AnneeDP, $MoisDP, $JourDP) = explode('-',$RowDernierePartie['Max(DatePartie)']);

// ************************************
// RAMENER somme des points
// ************************************

// $SqlDernierePartie = "SELECT Sum(Score) FROM SyntheseDonneesParties where IdJoueur=".$IdJ;
// /*$reponse = $bd->query($sql, SQLITE3_BOTH, $err);*/
// $ReponseDernierePartie = $bd->query($SqlDernierePartie);
//
// $RowDernierePartie = $ReponseDernierePartie->fetchArray();
//
// $TotalPoints = $RowDernierePartie['Sum(Score)'];



// ************************************
// RAMENER somme des impacts
// ************************************

// $SqlDernierePartie = "SELECT Sum(NbImp) FROM SyntheseDonneesParties where IdJoueur=".$IdJ;
// /*$reponse = $bd->query($sql, SQLITE3_BOTH, $err);*/
// $ReponseDernierePartie = $bd->query($SqlDernierePartie);
//
// $RowDernierePartie = $ReponseDernierePartie->fetchArray();
//
// $TotalImpacts = $RowDernierePartie['Sum(NbImp)'];

// ************************************
// RAMENER somme des distance moyenne
// ************************************

// $SqlDernierePartie = "SELECT Sum(dmoy) FROM SyntheseDonneesParties where IdJoueur=".$IdJ;
// /*$reponse = $bd->query($sql, SQLITE3_BOTH, $err);*/
// $ReponseDernierePartie = $bd->query($SqlDernierePartie);
//
// $RowDernierePartie = $ReponseDernierePartie->fetchArray();
//
// $TotalDmoy = $RowDernierePartie['Sum(dmoy)'];



?>

<h1>Formulaire Enregistrement Données JOUEUR </h1>
<?php

echo "<h2>Actuellement MAX(IdJoueur)=".$RowInfosJoueur['MAX(IdJoueur)']."</h2>";
$IdNouveauJoueur= $RowInfosJoueur['MAX(IdJoueur)']+1;

?>

<form action="FormulaireJoueur.php" method="get">
<table style='width: 100%;'border='0'>

<tr style='height : 20px;'>

  <td style='width:  '> </td>

  <td style='width:  '><h2>Code</h2></td>
  <td style='width:  '><h2>Prénom </h2></td>
  <td style='width:  '><h2>Nom </h2></td>
  <td style='width:  '><h2>Année  </h2></td>

  <td style='width:  '> </td>

</tr>

<tr>

  <td style='width:  '> </td>

  <td style='width:  200px'> <input type="text" name='CodeJoueur'  size="20" Value=""></td>
  <td style='width:  200px'> <input type="text" name='PrenomJoueur' size="20" Value=""></td>
  <td style='width:  200px'> <input type="text" name='NomJoueur' Value="" size="20" Value=""></td>
  <td style='width:  200px; text-align: center;'> <input type="text" name='AnneeNaissance' size="20" Value="20"></td>

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

<tr style='height : 20px;'>

  <td style='width:  '> </td>

  <td style='width:  '><h2>Id Joueur </h2></td>
  <td style='width:  '><h2>Tel </h2></td>
  <td style='width:  '><h2>Mail </h2></td>
  <td style='width:  '><h2>Origine </h2></td>

  <td style='width:  '> </td>

</tr>

<tr>

  <td style='width:  '> </td>

  <td style='width:  200px'> <input type="text" name='IdJoueur' size="20" Value="<?php echo $IdNouveauJoueur ?>"></td>
  <td style='width:  200px'> <input type="text" name='Tel' size="20" Value="0"></td>
  <td style='width:  200px'> <input type="text" name='Mail' size="20" Value="?"></td>
  <td style='width:  ;text-align: left;'>
    <input type="radio" id="Joueur" name="Origine" value="Joueur">
    <label for="Joueur">Joueur</label><br>
    <input type="radio" id="Pere" name="Origine" value="Pere">
    <label for="Pere">Pere</label><br>
    <input type="radio" id="Mere" name="Origine" value="Mere">
    <label for="Mere">Mere</label>
  </td>

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

  <td style='width:  ;text-align: right;;'><b>Poste :</b></td>
  <td style='width:  ;text-align: left;'>
    <input type="radio" id="Gardien" name="Poste" value="Gardien">
    <label for="gardien">Gardien</label><br>
    <input type="radio" id="Defenseur" name="Poste" value="Defenseur">
    <label for="Defenseur">Defenseur</label><br>
    <input type="radio" id="Milieu" name="Poste" value="Milieu">
    <label for="Milieu">Milieu</label><br>
    <input type="radio" id="Attaquant" name="Poste" value="Attaquant">
    <label for="Attaquant">Attaquant</label>
  </td>

  <td style='width:  ;text-align: right;'><b>Pied :</b></td>
  <td style='width:  ;text-align: left;'>
    <input type="radio" id="Droit" name="Pied" value="Droit">
    <label for="Droit">Droit</label><br>
    <input type="radio" id="Gauche" name="Pied" value="Gauche">
    <label for="Gauche">Gauche</label>
  </td>

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
  <td style='width:  '> </td>

  <td style='width:  '> </td>

</tr>

<tr>

  <td style='width:  '> </td>

  <td style='width:  200px'> <input type="text" name='ClubJoueur'  size="20" Value="Couzeix"></td>
  <td style='width:  200px'> <input type="text" name='Club2Coeur' size="20" Value="?"></td>
  <td style='width:  200px'> <input type="text" name='JoueurPrefere'  size="20" Value="?"></td>
  <td style='width:  '> </td>

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

  <td style='width:  '><b> </b></td>
  <td style='width:  '><b> </b></td>
  <td style='width:  '><b> </b></td>
  <td style='width:  '><b>A enregistrer le :</b></td>

  <td style='width:  '> </td>

</tr>

<tr>

  <td style='width:  '> </td>
  <?php
  date_default_timezone_set("Europe/Paris");
  ?>

  <td style='width:  '><b> &nbsp</b></td>
  <td style='width:  '><b> </b></td>
  <td style='width:  '><b> </b></td>
  <td style='width:  '><input type="text" name='DateEnregistrement'  size="20" Value="<?php echo date("Y-m-d") ?>"></td>

  <td style='width:  '> </td>

</tr>

<tr>

  <td style='width:  '> </td>

  <td style='width:  '><b> &nbsp </b></td>
  <td style='width:  '><b> </b></td>
  <td style='width:  '><b> </b></td>
  <td style='width:  '><b> </b></td>

  <td style='width:  '> </td>

</tr>

<tr>

  <td style='width:  '> </td>

  <td style='width:  '> </td>
  <td style='width:  '> </td>
  <td style='width:  '> </td>
  <td colspan="1" style='width:  text-align: right;'  ><input type="submit" name="Enregistrement" value="Enregistrer Joueur en base"></td>

  <td style='width:  '> </td>

</tr>


<!-- </tbody> -->
</table>
</form>
<br>
<!-- <hr size='5'color='green'> -->

<?php

$IdJoueur=app_get_int("IdJoueur");
$CodeJoueur=app_get_string("CodeJoueur");
$PrenomJoueur=app_get_string("PrenomJoueur");
$NomJoueur=app_get_string("NomJoueur");
$AnneeNaissance=app_get_string("AnneeNaissance");
$Tel=app_get_string("Tel");
$Mail=app_get_string("Mail");
$Origine=app_get_string("Origine");

$ClubJoueur=app_get_string("ClubJoueur");
$DateCreation=app_get_string("DateEnregistrement");
$PosteJoueur=app_get_string("Poste");
$PiedJoueur=app_get_string("Pied");
$Club2Coeur=app_get_string("Club2Coeur");
$JoueurPrefere=app_get_string("JoueurPrefere");






$SqlJoueur = "INSERT INTO Joueurs ".
"(IdJoueur,CodeJoueur,NomJoueur,PrenomJoueur,DateNaissance".",TelJoueur,MailJoueur,OrigineCoordJoueur,".
"ClubJoueur,DateCreation,PosteJoueur,PiedJoueur,Club2Coeur,JoueurPrefere)"."\n".
"VALUES (".$IdJoueur.",'".$CodeJoueur."','".$NomJoueur."','".$PrenomJoueur."','".$AnneeNaissance."-mm-jj','".$Tel."','".$Mail."','".$Origine."','".
$ClubJoueur."','".$DateCreation."','".$PosteJoueur."','".$PiedJoueur."','".$Club2Coeur."','".$JoueurPrefere."');";

echo nl2br(app_escape($SqlJoueur));


// INSERT INTO Joueurs (IdJoueur,CodeJoueur,NomJoueur,PrenomJoueur,DateNaissance,TelJoueur,MailJoueur,OrigineCoordJoueur,ClubJoueur,DateCreation,PosteJoueur,PiedJoueur,Club2Coeur,JoueurPrefere)
// VALUES (60,'ML7','Lebreaud','Mathys','2007-mm-jj','?','?','','Couzeix','2020-09-16','Attaquant','Droit','?','?');


}
// Deconnexion
$bd = null;
?>
