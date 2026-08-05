<?php
include 'MenuDev.php';
include 'MenuIPassBall.php';
include_once 'Security.php';
//include 'MenuStyleTable.php';
?>
<?php
/**
 * Exemple simple qui étend la classe SQLite3 et change les paramètres
 * __construct, puis, utilise la méthode de connexion pour initialiser la
 * base de données.
 */
include 'ConnexionBDDiPassBall.php';

?>

<!-- //**********************
// PARAMETRES :
//********************** -->

<H1>Paramètres :</H1>

<form action="EmailTelJoueurs.php" method="get">

  <table style="width: 100%; border-collapse: collapse; height:;" border="1">
  <tbody>

    <tr style='height: ;'>
      <td style='width: 12%; height: 6px;'></td>
      <td style='width: 12%; height: 6px;'></td>
      <td style='width: 12%; height: 6px;'><H2>Sélectionner</H2></td>
      <td style='width: 12%; height: 6px;'><H2>"Club"</H2></td>
      <td style='width: 12%; height: 6px;'><H2>Année</H2></td>
      <td style='width: 12%; height: 6px;'></td>
      <td style='width: 12%; height: 6px;'></td>
      <td style='width: 12%; height: 6px;'></td>

    </tr>
    <tr style='height: ;'>
      <td style='width: ; height: 12px;'></td>
      <td style='width: ; height: 12px;'></td>
      <td style='width: ; height: 12px;'></td>
      <td style='width: ; height: 12px;'>
        <select name="Club" size="1">
          <option value="" selected> Tous</option>
          <?php
          //*********LISTE Club
          //******************
          // Lecture des donnees dans la table
          $sql = "SELECT Distinct(ClubJoueur)  FROM Joueurs order by ClubJoueur";
          /*$reponse = $bd->query($sql, SQLITE3_BOTH, $err);*/
          $reponse = $bd->query($sql);

          if ($reponse === FALSE) {
              echo "La requete a echouee pour la raison suivante: ".$err;
          } else {

              //echo "<h2>Liste Mail Joueurs : </h2><br>";
              while ($row = $reponse->fetchArray()) {

                Echo "<option value='".app_escape($row['ClubJoueur'])."'>".app_escape($row['ClubJoueur'])."</option>";

              }

          }

        ?>

        </select>
      </td>
      <td style='width: ; height: 12px;'>
        <select name="Annee" size="1">
          <option value="" selected> Toutes</option>
          <?php
          //*********LISTE Club
          //******************
          // Lecture des donnees dans la table
          $sql = "SELECT Distinct(DateNaissance)  FROM Joueurs order by DateNaissance";
          /*$reponse = $bd->query($sql, SQLITE3_BOTH, $err);*/
          $reponse = $bd->query($sql);

          if ($reponse === FALSE) {
              echo "La requete a echouee pour la raison suivante: ".$err;
          } else {

              //echo "<h2>Liste Mail Joueurs : </h2><br>";
              while ($row = $reponse->fetchArray()) {

                Echo "<option value='".app_escape($row['DateNaissance'])."'>".app_escape($row['DateNaissance'])."</option>";

              }

          }

        ?>

        </select>
      </td>
      <td style='width: ; height: 12px;'>

      </td>
      <td style='width: ; height: 12px;'>
          <input type="submit" name="envoyer" value="Afficher Liste de Téléphone et MailTel">
      </td>
      <td style='width: ; height: 12px;'></td>
    </tr>
  </tbody>
  </table>

</form>




<?php


$Club = app_get_string("Club");

$Annee = app_get_string("Annee");
$ClubSql = SQLite3::escapeString($Club);
$AnneeSql = SQLite3::escapeString($Annee);






//**********************
// Tel JOUEURS/Parents :
//**********************


echo "<h1>Tel JOUEURS/Parents :</h1><br>";

echo "<center>";


//echo "<hr size='5'color='green'>";
echo "<table style='width: ; ' border='1'";
echo "<tr style='max-width : 1000px; text-align: left;'>";

//*********LISTE JOUEUR/PARENT
//******************
echo "<tr style='max-width : 500px; text-align: left;'>";
// Lecture des donnees dans la table
$sql ="SELECT * FROM Joueurs WHERE DateNaissance Like '%".$AnneeSql."%'  AND ClubJoueur Like '%".$ClubSql."%' ORDER BY CodeJoueur";
echo "sql >>> ".$sql;
/*$reponse = $bd->query($sql, SQLITE3_BOTH, $err);*/
$reponse = $bd->query($sql);

if ($reponse === FALSE) {
    echo "La requete a echouee pour la raison suivante: ".$err;
} else {


    //echo "Liste Tel Joueurs : <br>";


    echo "<td style='max-width : 500px; height :500px; vertical-align: top;text-align: left;word-wrap: break-word;'>";

    //echo "<div style='width:1000px; height:1000px; border:10px; word-wrap: break-word;'>";
    echo "<h2>Liste  Joueurs : </h2><br>";
    while ($row = $reponse->fetchArray()) {

      if ($row['TelJoueur']<>'?') {

        echo $row['PrenomJoueur']." <b>".$row['NomJoueur']."</b> / ";

      }

        // /*IdJoueur ,CodeJoueur , NomJoueur , PrenomJoueur , DateNaissanceJoueur , TelJoueur , MailJoueur ,OrigineCoordJoueur*/

    }
    //echo "</div>";
    echo "</td>";
}
//*********LISTE Tel
//******************

// Lecture des donnees dans la table
//$sql = "SELECT * FROM Joueurs where DateNaissance='".$Annee."' order by CodeJoueur";
/*$reponse = $bd->query($sql, SQLITE3_BOTH, $err);*/
$reponse = $bd->query($sql);

if ($reponse === FALSE) {
    echo "La requete a echouee pour la raison suivante: ".$err;
} else {


    //echo "Liste Tel Joueurs : <br>";


    echo "<td style='max-width : 500px; height :500px; vertical-align: top;text-align: left;word-wrap: break-word;'>";

    //echo "<div style='width:1000px; height:1000px; border:10px; word-wrap: break-word;'>";
    echo "<h2>Liste Tel : </h2><br>";
    while ($row = $reponse->fetchArray()) {

      if ($row['TelJoueur']<>'?') {

        echo $row['TelJoueur']." , ";

      }

        // /*IdJoueur ,CodeJoueur , NomJoueur , PrenomJoueur , DateNaissanceJoueur , TelJoueur , MailJoueur ,OrigineCoordJoueur*/

    }
    //echo "</div>";
    echo "</td>";

    echo "</tr>";
    echo "</table>";

echo "</center>";

}

echo "<br>";
//  echo "<hr size='5'color='green'>";


//**********************
// Tel JOUEURS/Parents MANQUANTS :
//**********************


echo "<h2>Tel JOUEURS/Parents MANQUANTS :</h2><br>";

echo "<center>";


//echo "<hr size='5'color='green'>";
echo "<table style='width: ; ' border='1'";
echo "<tr style='max-width : 1000px; text-align: left;'>";

//*********LISTE JOUEUR/PARENT
//******************
echo "<tr style='max-width : 500px; text-align: left;'>";
// Lecture des donnees dans la table
//$sql ="SELECT * FROM Joueurs WHERE DateNaissance Like '%".$Annee."%'  AND ClubJoueur Like '%".$Club."%' ORDER BY CodeJoueur";
/*$reponse = $bd->query($sql, SQLITE3_BOTH, $err);*/
$reponse = $bd->query($sql);

if ($reponse === FALSE) {
    echo "La requete a echouee pour la raison suivante: ".$err;
} else {


    //echo "Liste Tel Joueurs : <br>";


    echo "<td style='max-width : 500px; height :500px; vertical-align: top;text-align: left;word-wrap: break-word;'>";

    //echo "<div style='width:1000px; height:1000px; border:10px; word-wrap: break-word;'>";
    echo "<h2>Liste Joueurs sans Tel : </h2><br>";
    while ($row = $reponse->fetchArray()) {

      if ($row['TelJoueur']=='?') {

        echo $row['PrenomJoueur'].".<b>".$row['NomJoueur']."</b> / ";

      }

        // /*IdJoueur ,CodeJoueur , NomJoueur , PrenomJoueur , DateNaissanceJoueur , TelJoueur , MailJoueur ,OrigineCoordJoueur*/

    }
    //echo "</div>";
    echo "</td>";
}

    echo "</tr>";
    echo "</table>";

echo "</center>";


echo "<br>";

//**********************
// Mail JOUEURS/Parents :
//**********************

echo "<h1>Mail JOUEURS/Parents pour Club '".app_escape($Club)."' / Année '".app_escape($Annee)."' :</h1><br>";

echo "<center>";

//echo "<hr size='5'color='green'>";
echo "<table style='width: ; ' border='1'";
echo "<tr style='max-width : 1000px; text-align: left;'>";

//*********LISTE JOUEUR/PARENT
//******************
echo "<tr style='max-width : 500px; text-align: left;'>";
// Lecture des donnees dans la table
$sql = "SELECT * FROM Joueurs WHERE DateNaissance Like '%".$AnneeSql."%'  AND ClubJoueur Like '%".$ClubSql."%' ORDER BY CodeJoueur";
//$sql = "SELECT * FROM Joueurs WHERE DateNaissance='".$Annee."' AND ClubJoueur='".$Club."' ORDER BY CodeJoueur";
echo "sql >>> ".$sql;
/*$reponse = $bd->query($sql, SQLITE3_BOTH, $err);*/
$reponse = $bd->query($sql);

if ($reponse === FALSE) {
    echo "La requete a echouee pour la raison suivante: ".$err;
} else {


    //echo "Liste Mail Joueurs : <br>";


    echo "<td style='max-width : 500px; height :500px; vertical-align: top;text-align: left;word-wrap: break-word;'>";

    //echo "<div style='width:1000px; height:1000px; border:10px; word-wrap: break-word;'>";
    echo "<h2>Liste Joueurs : </h2><br>";
    while ($row = $reponse->fetchArray()) {

      if ($row['MailJoueur']<>'?') {

        echo $row['PrenomJoueur'].".<b>".$row['NomJoueur']."</b> / ";

      }

        // /*IdJoueur ,CodeJoueur , NomJoueur , PrenomJoueur , DateNaissanceJoueur , TelJoueur , MailJoueur ,OrigineCoordJoueur*/

    }
    //echo "</div>";
    echo "</td>";
}
//*********LISTE Tel
//******************

// Lecture des donnees dans la table
//$sql = "SELECT * FROM Joueurs where DateNaissance='".$Annee."' order by CodeJoueur";
/*$reponse = $bd->query($sql, SQLITE3_BOTH, $err);*/
$reponse = $bd->query($sql);

if ($reponse === FALSE) {
    echo "La requete a echouee pour la raison suivante: ".$err;
} else {


    //echo "Liste Tel Joueurs : <br>";


    echo "<td style='max-width : 500px; height :500px; vertical-align: top;text-align: left;word-wrap: break-word;'>";

    //echo "<div style='width:1000px; height:1000px; border:10px; word-wrap: break-word;'>";
    echo "<h2>Liste Mail : </h2><br>";
    while ($row = $reponse->fetchArray()) {

      if ($row['MailJoueur']<>'?') {

        echo $row['MailJoueur'].",";

      }

        // /*IdJoueur ,CodeJoueur , NomJoueur , PrenomJoueur , DateNaissanceJoueur , TelJoueur , MailJoueur ,OrigineCoordJoueur*/

    }
    //echo "</div>";
    echo "</td>";







    echo "</tr>";
    echo "</table>";


}

echo "</center>";

echo "<br>";


//**********************
// Mail JOUEURS/Parents MANQUANTS :
//**********************


echo "<h2>Mail JOUEURS/Parents MANQUANTS :</h2><br>";

echo "<center>";


//echo "<hr size='5'color='green'>";
echo "<table style='width: ; ' border='1'";
echo "<tr style='max-width : 1000px; text-align: left;'>";

//*********LISTE JOUEUR/PARENT
//******************
echo "<tr style='max-width : 500px; text-align: left;'>";
// Lecture des donnees dans la table
//$sql = "SELECT * FROM Joueurs where DateNaissance='".$Annee."' order by CodeJoueur";
/*$reponse = $bd->query($sql, SQLITE3_BOTH, $err);*/
$reponse = $bd->query($sql);

if ($reponse === FALSE) {
    echo "La requete a echouee pour la raison suivante: ".$err;
} else {


    //echo "Liste Tel Joueurs : <br>";


    echo "<td style='max-width : 500px; height :500px; vertical-align: top;text-align: left;word-wrap: break-word;'>";

    //echo "<div style='width:1000px; height:1000px; border:10px; word-wrap: break-word;'>";
    echo "<h2>Liste Joueurs/Parents sans Mail : </h2><br>";
    while ($row = $reponse->fetchArray()) {

      if ($row['MailJoueur']=='?') {

        echo $row['PrenomJoueur'].".<b>".$row['NomJoueur']."</b> / ";

      }

        // /*IdJoueur ,CodeJoueur , NomJoueur , PrenomJoueur , DateNaissanceJoueur , TelJoueur , MailJoueur ,OrigineCoordJoueur*/

    }
    //echo "</div>";
    echo "</td>";
}

    echo "</tr>";
    echo "</table>";

echo "</center>";


echo "<br>";



// Deconnexion
$bd = null;
?>
