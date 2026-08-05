<?php

include 'MenuIPassBall.php';  // Ok.
include_once 'Security.php';
?>
<?php

/* Variables passées en prametres dans l'url*/
$IdP = app_get_int("IdP");
$IdJ = app_get_int("IdJ");


echo "IdPartie = ".$IdP." & IdJoueur = ".$IdJ."<br>";
echo "<a href='SynthesePartie.php?IdJ=".$IdP."&IdP=".$IdJ."'>Synthese  de la Partie n°".$IdP." Par ".$IdJ."</a>";

include 'ConnexionBDDiPassBall.php';



// Lecture des donnees dans la table
$sqlParametresPartie = "SELECT * FROM ParametresPartie where IdPartie='".$IdP."'";
/*$sqlParametresPartie = "SELECT * FROM ParametresPartie ";*/
$sqlJoueur = "SELECT * FROM Joueurs where IdJoueur='".$IdJ."'";
$sqlDonneesPartie = "SELECT * FROM DonneesParties where IdPartie='".$IdP."'";
/*$reponse = $bd->query($sql, SQLITE3_BOTH, $err);*/
$reponseParametresPartie = $bd->query($sqlParametresPartie);
$reponseJoueur = $bd->query($sqlJoueur);
$reponseDonneesPartie = $bd->query($sqlDonneesPartie);

/*
if ($reponseParametresPartie === FALSE)
    echo "La requete ParametresPartie a echouee pour la raison suivante: ".$err;
*/

if ($reponseJoueur === FALSE)
    echo "La requete Joueur a echouee pour la raison suivante: ".$err;

if ($reponseDonneesPartie === FALSE)
    echo "La requete DonneesPartie a echouee pour la raison suivante: ".$err;

$rowJoueur = $reponseJoueur->fetchArray();
$Joueur = $rowJoueur['NomJoueur']." ".$rowJoueur['PrenomJoueur'];

$rowParametresPartie= $reponseParametresPartie->fetchArray();

// focntion pour calculer le score
function VCD($Dm,$Vc,$c,$d) {
    return $Vc + round($c * ($d/100 - $Dm)*$Vc,0, PHP_ROUND_HALF_DOWN) ;
}


?>

<h1><p>Chronologie de la partie du <?php echo $rowParametresPartie['DatePartie']?> de <b><?php echo $Joueur; ?> </b></p></h1>
<p><u>Paramètres de la partie :</u>
Dur&eacute;e : <?php echo $rowParametresPartie['DureePartie'].' secondes' ?> /
Dmin : <?php echo $rowParametresPartie['DminPartie'].' Mètre' ?> /
c1: <?php echo $rowParametresPartie['c1Partie'] ?> /
c2 : <?php echo $rowParametresPartie['c2Partie'] ?></p>


<hr size='5'color='green'>
<?php

$Score = 0;

while ($rowDonneesPartie = $reponseDonneesPartie->fetchArray()) {


        switch ($rowDonneesPartie['Cible']) {
            case "HDD":
                $Vc  = 1;
                break;
            case "BDD":
                $Vc = 3;
                break;
            case "HD":
                $Vc = 2;
                break;
            case "BD":
                $Vc = 5;
                break;
            case "HG":
                $Vc = 2;
                break;
            case "BG":
                $Vc = 5;
                break;
            case "HGG":
                $Vc = 1;
                break;
            case "BGG":
                $Vc = 3;
                break;
        }

        $Score = $Score + function VCD($Dm,$Vc,$c,$d);


            }

?>
