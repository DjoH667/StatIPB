<?php
//include '../MenuDev.php'  // Ok.
//include '../MenuIpassBall.php'  // Ok.
?>


    <head>
        <title>Fournir Fichiers SQL pour la BDD iPassBall</title>
        <meta charset=utf-8>

    </head>

    <?php
    include 'ConnexionBDD.php';


    // Lecture des donnees dans la table
    $sql = "SELECT Max(IdSession) FROM DonneesSession";
    /*$reponse = $bd->query($sql, SQLITE3_BOTH, $err);*/
    $ReponseIdSession = $bd->query($sql);
    $rowIdSession = $ReponseIdSession->fetchArray();

    $sql = "SELECT Max(IdPartie) FROM DonneesParties";
    $ReponseIdPartie = $bd->query($sql);
    $rowIdPartie = $ReponseIdPartie->fetchArray();

    echo "<h1>Actuellement Max IdSession = ".$rowIdSession['Max(IdSession)']." Max IdPartie = ".$rowIdPartie['Max(IdPartie)']."</h1>";

    // Répertoire destination Fichiers SQL // FichiersPrBDD/
    $RepertoireDestinationSQL = "FichiersPrBDD/";
    // Répertoire Source des  Logs
    $RepertoireLogSession = "Sessions/";
    echo "<h1>";
    echo "RepertoireLogSession = ".$RepertoireLogSession;
    echo "<br>";
    // Donnees de la session
    echo "RepertoireDestinationSQL=".$RepertoireDestinationSQL;
    echo "<br>";


    ?>

    <body>
      <form action=FournirFichiersSQL.php method=post>
       <p>Nom de votre fichier de log :
         <input type=text name=NomFichierLog />
         Votre IdSession :
         <input type=text name=IdSession />
         Votre IdPremièrePartie de la session :
         <input type=text name=IdPremierePartie />
         Date de la session :
         <input type=text name=DateSession />
         <input type=submit value=Envoyer></p>

      </form>


      Lire les données du fichier <?php echo htmlspecialchars($_POST['NomFichierLog']); ?>

        <?php
            echo "</h1>";


            // Recuperation des donness du fomulaire
            $FichierLog = $RepertoireLogSession.$_POST['NomFichierLog'];

            if ($FichierLog==""){
            goto FinSansFichierSession;
            }
            $IdSession = $_POST['IdSession'];
            $IdPremierePartie = $_POST['IdPremierePartie'];
            $DateSession = $_POST['DateSession'];
            //$_POST['NomFichierLog'];


            //$FichierLogSession = fopen('Log_P02.csv', 'rb');
            if (fopen($FichierLog, 'r')){
            $FichierLogSession = fopen($FichierLog, 'rb');
            }
            else {
            goto FinSansFichierSession;
            }

            // Init de nb de partie de la session
            $IdNbPartieSession = 0;







//file_put_contents($FichierDonneesSession, *** _DonneesSession \n, FILE_APPEND);
$FichierDonneesSession = $RepertoireDestinationSQL.$IdSession."_DonneesSession.sql";
file_put_contents($FichierDonneesSession, "INSERT INTO 'DonneesSession'", FILE_APPEND);
file_put_contents($FichierDonneesSession, " ('IdSession','DateSession','IdPartieJoueur01','IdPartieJoueur02','IdPartieJoueur03','IdPartieJoueur04','IdPartieJoueur05','IdPartieJoueur06','IdPartieJoueur07','IdPartieJoueur08','IdPartieJoueur09')\n", FILE_APPEND);
file_put_contents($FichierDonneesSession, " VALUES ", FILE_APPEND);
file_put_contents($FichierDonneesSession, "\n", FILE_APPEND);

file_put_contents($FichierDonneesSession, "(".$IdSession.",'".$DateSession."'", FILE_APPEND);

// Parametres Partie de toutes les parties de la session
$FichierParametresPartie = $RepertoireDestinationSQL.$IdSession."_ParametresPartie.sql";
//file_put_contents($FichierParametresPartie, *** _ParamètresPartie \n, FILE_APPEND);
//INSERT INTO 'ParametresPartie' ('IdPartie','DatePartie','IdJoueur','DureePartie',"DminPartie','c1Partie','c2Partie') VALUES
file_put_contents($FichierParametresPartie, "INSERT INTO 'ParametresPartie'", FILE_APPEND);
file_put_contents($FichierParametresPartie, " ('IdPartie','DatePartie','IdJoueur','DureePartie','DminPartie','c1Partie','c2Partie')", FILE_APPEND);
file_put_contents($FichierParametresPartie, " VALUES ", FILE_APPEND);
file_put_contents($FichierParametresPartie, "\n", FILE_APPEND);
//file_put_contents($FichierParametresPartie, "IdPartie;'DateSession;CodeJoueur;DureePartie;Dmini;c1;c2 \n", FILE_APPEND);

// Donnees Parties de toutes les parties de la session
$FichierDonneesPartie = $RepertoireDestinationSQL.$IdSession."_DonneesParties.sql";
file_put_contents($FichierDonneesPartie, "INSERT INTO 'DonneesParties'", FILE_APPEND);
file_put_contents($FichierDonneesPartie, " ('IdSession','IdPartie','IdJoueur','Tps','DTps','NbImp','Imp/S','Cible','NbPt','Score','PtParImp','dist','dmoy','dmin','dMax','Force','Fmoy','Fmin','FMax',", FILE_APPEND);
file_put_contents($FichierDonneesPartie, " 'NbHGG','NbHG','NbBGG','NbBG','NbBD','NbBDD','NbHD','NbHDD','NbHS','NbHaut','NbBas','NbExtG','NbExtD','NbCentreD','NbCentreG','NbGauche','NbDroite',", FILE_APPEND);
file_put_contents($FichierDonneesPartie, " 'pHGG','pHG','pBGG','pBG','pBD','pBDD','pHD','pHDD','pH','pB','pExtG','pCG','pCD','pExtD','pG','pD')", FILE_APPEND);
file_put_contents($FichierDonneesPartie, " VALUES ", FILE_APPEND);
file_put_contents($FichierDonneesPartie, "\n", FILE_APPEND);
//file_put_contents($FichierDonneesPartie,"IdSession','IdPartie','IdJoueur','Tps','DeltaTps','NbImp','ImpParS','Cible','NbPt','Score','PtImp','dist','dmoy','dmin','dMax','Force','Fmoy','Fmin','FMax','", FILE_APPEND);
//file_put_contents($FichierDonneesPartie,"nHGG','nHG','nBGG','nBG','nBD','nBDD','nHD','nHDD','nHS','nHaut','nBas','nExtG','nExtD','nCentreD','nCentreG','nGauche','nDroite','", FILE_APPEND);
//file_put_contents($FichierDonneesPartie,"pHGG','pHG','pBGG','pBG','pBD','pBDD','pHD','pHDD','pH','pB','pExtG','pCentreG','pCentreD','pExtD','pGauche','pDroite \n", FILE_APPEND);

            //$res = fo$pen('Log_$p02_Sqlite.csv', 'w+')

            /*Tant que la fin du fichier n'est $pas atteninte, c'est-à-dire
             *tant que feof() renvoie FALSE (= tant que !feof() renvoie TRUE)
             *on echo une nouvelle ligne du fichier*/

             //Init des valeurs des cibles
             $Vc5 = 5;
             $Vc3 = 3;
             $Vc2 = 2;
             $Vc1 = 1;

            // init numero parties pour fichier Session.sql
            $IdPartie = $IdPremierePartie - 1;


             // fonction pour calculer le score
             function VCD($Dm,$Vc,$c,$d) {
                 //return $Vc + round($c * ($d/100 - $Dm)*$Vc,0, PHP_ROUND_HALF_UP) ;
                 return $Vc;
             }



            while(!feof($FichierLogSession)){
                $ligne = fgets($FichierLogSession);

                //$CodeLigne = ex$plode(, $ligne)
                $CodeLigne = str_split($ligne, 2);

                if ($CodeLigne[0] == "NP") {

                            // incrémentation du nb de partie de la session
                            $IdNbPartieSession = $IdNbPartieSession + 1;

                            // incrémentation de numero de la la nouvelle partie
                            $IdPartie = $IdPartie + 1 ;


                            list($NP,$CodeJoueurNP,$DureePartie,$Dmini,$c1,$c2,$InfoJoueur) = explode(";", $ligne);

                            // Lecture des donnees dans la table Joueurs
                            $sql = "SELECT IdJoueur FROM Joueurs WHERE CodeJoueur='".$CodeJoueurNP."'";
                            /*$reponse = $bd->query($sql, SQLITE3_BOTH, $err);*/
                            $Reponse = $bd->query($sql);
                            $Row = $Reponse->fetchArray();

                            $IdJoueur= $Row['IdJoueur'];

                            echo "<br>///////////////////////////////////////////////////////////<br>";
                            echo '<b>IdSession = '.$IdSession."</b><br>";
                            echo '<b>DateSession = '.$DateSession."</b><br>";
                            echo '<b>IdPartie = '.$IdPartie."</b><br>";
                            echo '<b>CodeJoueur = '.$CodeJoueurNP."</b><br>";
                            echo '<b>IdJoueur = '.$IdJoueur."</b><br>";
                            echo "/////////////////////////////////////////////////////////////<br>";
                            echo "<b><u>Données Parties :</u></b><br>";
                            echo "<br>";
                            echo '<b>DureePartie = '.$DureePartie.' secondes </b>// Dmini = '.$Dmini.' metre // $$c1 = '.$c1.' // $c2 = '.$c2."<br>";
                            echo '$InfoJoueur = '.$InfoJoueur."<br>";
                            echo "<br>";



// Donnees Session  ie tous les Joeurs de la session
// Nouvelle partie ajouée a la session
file_put_contents($FichierDonneesSession, ",".$IdPartie , FILE_APPEND);

// Parametres Partie de de la partie de la session
//file_put_contents($FichierParametresPartie, *** Nouvelle Partie \n, FILE_APPEND);
// Ajout des parametres dela nouvelle partie
file_put_contents($FichierParametresPartie, "(".$IdPartie.",'".$DateSession."',".$IdJoueur.",".$DureePartie.",".$Dmini.",".$c1.",".$c2."),\n", FILE_APPEND);

// Donnees Partie  Nouvelle partie
//file_put_contents($FichierDonneesPartie,*** Nouvelle Partie \n, FILE_APPEND);


                            include 'InitVariablesParties.php';  //

                } elseif ($CodeLigne[0] <> "") {

//echo $CodeLigne[0]=.$CodeLigne[0]./;


                          list($CodeJoueur,$TempsDsPartie,$CibleTouchee,$Dist,$Force,$NbPoint,$Score) = explode(";", $ligne);

                          $Score = trim($Score);

                          //'Comptabiliser impacts
                          $NbImpact = $NbImpact + 1;


                          //'********************************
                          //' Calculs a partir des données de la ligne
                          //'********************************
                          //<!--Données -->""
                          include 'CalculsDonneesPartie.php';

                          //<!--Tableau DEBUT -->
                          echo "<table style=width: 92.7431%; border-collapse: collapse; height: 60px; border=1>";
                          echo "<tbody>";

                          //<!--TableauEntete -->
                          include 'TableauEntete.html';
                          //<!--TableauLigne -->""
                          include 'TableauLigne.php';



                          //Init données Ligne si Fichier SQL
                          $LigneDonneesPartie= "(";

                          include 'LigneDonneesPartie.php';

                          //Finalisation données Ligne si Fichier SQL
                          $LigneDonneesPartie= $LigneDonneesPartie."),";

file_put_contents($FichierDonneesPartie, $LigneDonneesPartie, FILE_APPEND);
file_put_contents($FichierDonneesPartie, "\n" , FILE_APPEND);


                //echo '>>Fin de tableau : $NbImpact = '.$NbImpact;
                //echo '<br>';
                //echo '<br>';



                }

                echo "</tbody>";
                echo "</table>";


            }

// Finalisation Fichier SQL pr $FichierDonneesSession
//echo "Donnees Session :  IdPartie = ".$IdPartie."\n";

for ($i=$IdNbPartieSession+1 ; $i<= 9 ; $i++) {
//$ligneDonneesSession = fgets($Fichier);
file_put_contents($FichierDonneesSession, ",NULL", FILE_APPEND);
}
$Fichier= fopen($FichierDonneesSession, "r+");
fseek($Fichier,0,SEEK_END);
fwrite($Fichier, ');');
//fwrite($Fichier, "\nCOMMIT;");

// Finalisation Fichier SQL pr $FichierParametresPartie
$Fichier= fopen($FichierParametresPartie, "r+");
fseek($Fichier,-2,SEEK_END);
//file_put_contents($Fichier, "***TOTO" , FILE_APPEND);
fwrite($Fichier, ';');
//fwrite($Fichier, "\nCOMMIT;");

// Finalisation Fichier SQL pr $FichierDonneesPartie
$Fichier= fopen($FichierDonneesPartie, "r+");
fseek($Fichier,-2,SEEK_END);
//file_put_contents($Fichier, "***TOTO" , FILE_APPEND);
fwrite($Fichier, ';');
//fwrite($Fichier, "\nCOMMIT;");

//Concatenation des fichiers
$FichierSynthese = $RepertoireDestinationSQL.$IdSession.'_Synthese.sql';
file_put_contents($FichierSynthese, file_get_contents($FichierDonneesSession), FILE_APPEND);
file_put_contents($FichierSynthese, "\n\n", FILE_APPEND);
file_put_contents($FichierSynthese, file_get_contents($FichierParametresPartie), FILE_APPEND);
file_put_contents($FichierSynthese, "\n\n", FILE_APPEND);
file_put_contents($FichierSynthese, file_get_contents($FichierDonneesPartie), FILE_APPEND);

$Fichier= fopen($FichierSynthese, "r+");
fseek($Fichier,0,SEEK_END);
fwrite($Fichier, "\nCOMMIT;");

$Fichier= fopen($FichierDonneesSession, "r+");
fseek($Fichier,0,SEEK_END);
fwrite($Fichier, "\nCOMMIT;");

$Fichier= fopen($FichierParametresPartie, "r+");
fseek($Fichier,0,SEEK_END);
fwrite($Fichier, "\nCOMMIT;");

$Fichier= fopen($FichierDonneesPartie, "r+");
fseek($Fichier,0,SEEK_END);
fwrite($Fichier, "\nCOMMIT;");


        ?>

<h1> Taitement Terminé  pour <?php echo htmlspecialchars($_POST['NomFichierLog']); ?> ! </h1>
<?php
FinSansFichierSession:
echo '<h1>Pas de fichier en entree ! </h1>';
?>
    </body>
</html>
