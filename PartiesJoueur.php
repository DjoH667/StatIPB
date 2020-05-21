<?php
include 'MenuDev.php';  // Ok.
include 'MenuIPassBall.php';  // Ok.
?>
<?php

/* Variables passées en prametres dans l'url*/
    $id = $_GET["IdJ"];
    $nom = $_GET["NomJ"];
    $prenom = $_GET["PrenomJ"];

		 echo "IdJoueur = ".$id."<br>";

     include 'ConnexionBDDiPassBall.php';

     // Lecture des donnees dans la table
     $sql = "SELECT * FROM ParametresPartie where IdJoueur=".$id;
     /*$reponse = $bd->query($sql, SQLITE3_BOTH, $err);*/
     $reponse = $bd->query($sql);
     if ($reponse === FALSE) {
         echo "La requete a echouee pour la raison suivante: ".$err;
     } else {
         echo "Voici les parties jouées par :".$nom." ".$prenom."<br><br>";
         echo "<table style='width: 100%;'border='1'>";
         echo "<tbody>";
         echo "<tr>";
         echo "<td><b>IdPartie</b></td>";
         echo "<td><b>DatePartie</b></td>";
         echo "<td><b>IdJoueur</b></td>";
         echo "<td><b>NomJoueur</b></td>";
         echo "<td><b>PrenomJoueur</b></td>";
         echo "<td><b>DureePartie</b></td>";
         echo "<td><b>DminPartie</b></td>";
         echo "<td><b>c1Partie</b></td>";
         echo "<td><b>c2Partie</b></td>";
         echo "</tr>";



         while ($row = $reponse->fetchArray()) {
             echo "<tr>";
             echo "<td><a href='SynthesePartie.php?IdJ=".$row['IdJoueur']."&IdP=".$row['IdPartie']."'>".$row['IdPartie']."</a></td>";
             echo "<td>".$row['DatePartie']."</td>";
             echo "<td>".$row['IdJoueur']."</td>";
             echo "<td>".$nom."</td>";
             echo "<td>".$prenom."</td>";
             echo "<td>".$row['DureePartie']."</td>";
             echo "<td>".$row['DminPartie']."</td>";
             echo "<td>".$row['c1Partie']."</td>";
             echo "<td>".$row['c2Partie']."</td>";
             echo "</tr>";



         }
     }
     echo "</tbody>";
     echo "</table>";
     // Deconnexion
     $bd = null;
?>
