<?php
include 'MenuDev.php';  // Ok.
include 'MenuIPassBall.php';  // Ok.
?>

<?php
/**
 * Exemple simple qui étend la classe SQLite3 et change les paramètres
 * __construct, puis, utilise la méthode de connexion pour initialiser la
 * base de données.
 */
include 'ConnexionBDDiPassBall.php';


$IdSession = $_GET["IdSession"];

//echo "<br>IdSession = ".$IdSession;
/*$ Données Partie*/
$sqlDonneesSession = "SELECT * FROM DonneesSession where IdSession=".$IdSession."";

//echo "<br>sqlDonneesSession = ".$sqlDonneesSession;

$reponseDonneesSession = $bd->query($sqlDonneesSession);

if ($reponseDonneesSession === FALSE)
    echo "La requete DonneesSession a echouee pour la raison suivante: ".$err;

$rowDonneesSession = $reponseDonneesSession->fetchArray();

//echo "<br>rowDonneesSession = ".$rowDonneesSession[1];

echo "<br><h1>Synthese Session du ".$rowDonneesSession['DateSession']."</h1>";
echo "<hr size='5'color='green'>";
echo "<hr size='5'color='green'>";
for ($joueur = 2 ; $joueur <= 10; $joueur+=1) {

//echo "<br>joueur = ".$joueur;
$IdP = $rowDonneesSession[$joueur];

//echo "<br>IdP = ".$rowDonneesSession[$joueur]."<br>";
      if ($rowDonneesSession[$joueur]<>""){
      include 'SynthesePartieSession.php';
      }
}
?>
