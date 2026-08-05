<?php

include 'MenuIPassBall.php';  // Ok.
?>

<center><a href="TableParties.php"><img src="Images/Profil FB iPassBall 512px.png" alt="iPassBall Contrôle Passe !"></a></center>

<h1>Premieres Donnees recueillies sur iPassBall</h1>


<?php

include 'ConnexionBDDiPassBall.php';

echo "<h2>";
//echo "<br>";

// PARTIES JOUEES

    // Lecture des donnees dans la table
    $Sql = "SELECT MAX(IdPartie) FROM ParametresPartie";

    /*$reponse = $bd->query($sql, SQLITE3_BOTH, $err);*/
    $Reponse = $bd->query($Sql);

    if ($Reponse === FALSE) {
        echo "La requete DonneesSessions a echouee pour la raison suivante: ".$err;
    }
    else {

    $Row = $Reponse->fetchArray();


    echo "<table style='width: 900px ; margin-left:auto;margin-right:auto;' border='0'";
    //echo "<tbody>";
    //echo "<thead>";


    echo "<tr>";

    echo "<td style='width: 450px'>";
    echo "Nombre de Parties jouées = ".$Row['MAX(IdPartie)'];
    echo "</td>";

    echo "<td style='width: 450px'>";

    echo "<a href='TableParties.php'>";
    echo " >>>Classement des parties jouées";
    echo "</a>";
    echo "</td>";
    }

    // echo "<br>";
    // echo "<br>";

// SESSIONS JOUEES

    // Lecture des donnees dans la table
    $Sql = "SELECT MAX(IdSession) FROM DonneesSession";

    /*$reponse = $bd->query($sql, SQLITE3_BOTH, $err);*/
    $Reponse = $bd->query($Sql);

    if ($Reponse === FALSE) {
        echo "La requete DonneesSessions a echouee pour la raison suivante: ".$err;
    }
    else {

    $Row = $Reponse->fetchArray();


    echo "<tr>";
    echo "<td style='width: 450px'>";
    echo "Nombre de Sessions jouées = ".$Row['MAX(IdSession)'];
    echo "</td>";

    echo "<td style='width: 450px'>";
    echo "<a href='TableSessions.php'>";
    echo " >>>Sessions jouées";
    echo "</a>";
    echo "<td style='width: 50%'>";

    echo "</td>";
    echo "</tr>";




    }

    // echo "<br>";
    // echo "<br>";

// NOMBRE JOUEURS

    // Lecture des donnees dans la table
    $Sql = "SELECT MAX(IdJoueur) FROM Joueurs";

    /*$reponse = $bd->query($sql, SQLITE3_BOTH, $err);*/
    $Reponse = $bd->query($Sql);

    if ($Reponse === FALSE) {
        echo "La requete DonneesSessions a echouee pour la raison suivante: ".$err;
    }
    else {

    $Row = $Reponse->fetchArray();
    echo "<tr>";
    echo "<td style='width: 50%'>";
    echo "Nombre de Joueurs Différents = ".$Row['MAX(IdJoueur)'];
    echo "</td>";

    echo "<td style='width: 50%'>";
    echo "<a href='TableJoueurs.php'>";
    echo " >>>Liste des joueurs & Parties jouées";
    echo "</a>";
    echo "</td>";
    echo "</tr>";

    }

    // echo "<br>";
    // echo "<br>";



    echo "</table>";


echo "</h2>";

  echo "<br>";

echo "<h2>";
// Tir le plus long

    // Lecture des donnees dans la table
    $Sql = "SELECT IdPartie, IdJoueur, Cible, MAX(Dist) FROM DonneesParties where Cible='BG' OR Cible='BD'";

    /*$reponse = $bd->query($sql, SQLITE3_BOTH, $err);*/
    $Reponse = $bd->query($Sql);

    if ($Reponse === FALSE) {
        echo "La requete DonneesSessions a echouee pour la raison suivante: ".$err;
    }
    else {

    $Row = $Reponse->fetchArray();


            // Lecture des donnees dans la table
            $SqlJoueur = "SELECT * FROM Joueurs where IdJoueur=".$Row['IdJoueur'];
            //echo $SqlJoueur;
            /*$reponse = $bd->query($sql, SQLITE3_BOTH, $err);*/
            $ReponseJoueur = $bd->query($SqlJoueur);

            if ($ReponseJoueur === FALSE) {
                echo "La requete DonneesSessions a echouee pour la raison suivante: ".$err;
            }
            else {

            $RowJoueur = $ReponseJoueur->fetchArray();
            }

            // Lecture des donnees dans la table
            $SqlPartie = "SELECT * FROM SyntheseDonneesParties where IdPartie=".$Row['IdPartie'];
            //echo $SqlPartie;
            /*$reponse = $bd->query($sql, SQLITE3_BOTH, $err);*/
            $ReponsePartie = $bd->query($SqlPartie);

            if ($ReponsePartie === FALSE) {
                echo "La requete DonneesSessions a echouee pour la raison suivante: ".$err;
            }
            else {

            $RowPartie = $ReponsePartie->fetchArray();
            }

echo "<table style='width: 900px ; margin-left:auto;margin-right:auto;' border='0'";

    if ($Row['Cible']=='BG') $CibleMax= "5g"; else $CibleMax="5d";



    echo "<tr>";

    echo "<td style='width: 450px'>";
    echo "Plus longue Passe: ".$Row['MAX(Dist)']." m par ".$RowJoueur['CodeJoueur']." (Cible ".$CibleMax.")";
    //echo "Passe la plus longue sur cible 5g ou 5d : ".$Row['MAX(Dist)']." mètres par ".$RowJoueur['CodeJoueur']." Le ".$RowPartie['DatePartie'];
    //echo "<br>";
    echo "</td>";

    echo "<td style='width: 450px'>";
    echo "<a href='MeilleursDistances.php'>";
    echo ">>> Classement des 100 plus longues passes";
    echo "</a>";
    echo "</td>";
    echo "</tr>";

    }

echo "</table>";

echo "</h2>";


?>
