<?php
//include '../MenuDev.php'  // Ok.
//include '../MenuIpassBall.php'  // Ok.
?>


    <head>
        <title>Lire fichier .csv</title>
        <meta charset=utf-8>

    </head>

    <body>
      <form action=LireEcrireFichier.php method=post>
       <p>Nom + Chemin de votre fichier de log :
         <input type=text name=NomFichierLog />
         Votre IdSession :
         <input type=text name=IdSession />
         Votre IdPremièrePartie de la session :
         <input type=text name=IdPremierePartie />
         Date de la session :
         <input type=text name=DateSession />
         <input type=submit value=Envoyer></p>

      </form>


        <h1>Lire les données du fichier <?php echo htmlspecialchars($_POST['NomFichierLog']); ?></h1>
        <table style=width: 92.7431%; border-collapse: collapse; height: 180px; border=1>
        <tbody>
        <?php

            // Recuperation des donness du fomulaire
            $FichierLog = $_POST['NomFichierLog'];
            $IdSession = $_POST['IdSession'];
            $IdPremierePartie = $_POST['IdPremierePartie'];
            $DateSession = $_POST['DateSession'];
            $_POST['NomFichierLog'];


            //$FichierLogSession = fopen('Log_P02.csv', 'rb');
            $FichierLogSession = fopen($FichierLog, 'rb');

// Donnees de la session
$FichierDonneesSession = $IdSession."_DonneesSession.txt";
//file_put_contents($FichierDonneesSession, *** _DonneesSession \n, FILE_APPEND);
file_put_contents($FichierDonneesSession, "IdSession;DateSession;IdPartieJoueur01;IdPartieJoueur02;IdPartieJoueur03;IdPartieJoueur04;IdPartieJoueur05;IdPartieJoueur06;IdPartieJoueur07;IdPartieJoueur08;IdPartieJoueur09;\n", FILE_APPEND);
file_put_contents($FichierDonneesSession, $IdSession.";".$DateSession, FILE_APPEND);

// Parametres Partie de toutes les parties de la session
$FichierParametresPartie = $IdSession."_ParametresPartie.txt";
//file_put_contents($FichierParametresPartie, *** _ParamètresPartie \n, FILE_APPEND);
file_put_contents($FichierParametresPartie, "IdPartie;DateSession;CodeJoueur;DureePartie;Dmini;c1;c2 \n", FILE_APPEND);

// Donnees Parties de toutes les parties de la session
$FichierDonneesPartie = $IdSession."_DonneesParties.txt";
file_put_contents($FichierDonneesPartie,"IdSession;IdPartie;IdJoueur;Tps;DeltaTps;NbImp;ImpParS;Cible;NbPt;Score;PtImp;dist;dmoy;dmin;dMax;Force;Fmoy;Fmin;FMax;", FILE_APPEND);
file_put_contents($FichierDonneesPartie,"nHGG;nHG;nBGG;nBG;nBD;nBDD;nHD;nHDD;nHS;nHaut;nBas;nExtG;nExtD;nCentreD;nCentreG;nGauche;nDroite;", FILE_APPEND);
file_put_contents($FichierDonneesPartie,"pHGG;pHG;pBGG;pBG;pBD;pBDD;pHD;pHDD;pH;pB;pExtG;pCentreG;pCentreD;pExtD;pGauche;pDroite \n", FILE_APPEND);

            //$res = fo$pen('Log_$p02_Sqlite.csv', 'w+')

            /*Tant que la fin du fichier n'est $pas atteninte, c'est-à-dire
             *tant que feof() renvoie FALSE (= tant que !feof() renvoie TRUE)
             *on echo une nouvelle ligne du fichier*/

             //Init des valeurs des cibles
             $Vc5 = 5;
             $Vc3 = 3;
             $Vc2 = 2;
             $Vc1 = 1;

            // init numero parties
            $IdPartie = $IdPremierePartie - 1;


             // focntion pour calculer le score
             function VCD($Dm,$Vc,$c,$d) {
                 return $Vc + round($c * ($d/100 - $Dm)*$Vc,0, PHP_ROUND_HALF_DOWN) ;
             }


            while(!feof($FichierLogSession)){
                $ligne = fgets($FichierLogSession);

                //$CodeLigne = ex$plode(, $ligne)
                $CodeLigne = str_split($ligne, 2);

                if ($CodeLigne[0] == "NP") {

                            $IdPartie = $IdPartie + 1 ;

                            list($NP,$CodeJoueurNP,$DureePartie,$Dmini,$c1,$c2,$InfoJoueur) = explode(";", $ligne);

                            echo "<br>///////////////////////////////////////////////////////////<br>";
                            echo '<b>$IdSession = '.$IdSession."</b><br>";
                            echo '<b>$DateSession = '.$DateSession."</b><br>";
                            echo '<b>$IdPartie = '.$IdPartie." Pour CodeJoueur = ".$CodeJoueurNP."</b><br>";
                            echo "/////////////////////////////////////////////////////////////<br>";
                            echo "<br>";
                            echo "<b><u>Données Parties :</u></b><br>";
                            echo "<br>";
                            echo '$DureePartie = '.$DureePartie."<br>";
                            echo '$Dmini = '.$Dmini."<br>";
                            echo '$$c1 = '.$c1.'<br>';
                            echo '$c2 = '.$c2."<br>";
                            echo '$InfoJoueur = '.$InfoJoueur."<br>";
                            echo "<br>";



// Donnees Session  ie tous les Joeurs de la session
// Nouvelle partie ajouée a la session
file_put_contents($FichierDonneesSession, ";".$IdPartie , FILE_APPEND);

// Parametres Partie de de la partie de la session
//file_put_contents($FichierParametresPartie, *** Nouvelle Partie \n, FILE_APPEND);
// Ajout des parametres dela nouvelle partie
file_put_contents($FichierParametresPartie, $IdPartie.";".$DateSession.";".$CodeJoueurNP.";".$DureePartie.";".$Dmini.";".$c1.";".$c2."\n", FILE_APPEND);

// Donnees Partie  Nouvelle partie
//file_put_contents($FichierDonneesPartie,*** Nouvelle Partie \n, FILE_APPEND);


                            // Init des valeurs d'une $partie
                            $NbImpact = 0;
                            $TpsImpactPrecedent = 0;
                            $DeltaTps = 0;
                            $DeltaTpsMin = 0;
                            $DeltaTpsMax = 0;
                            $Score = 0;
                            $SommeDist = 0;
                            $Dmoyenne = 0;
                            $DMin = 0;
                            $DMax = 0;
                            $Dmoyenne = 0;
                            $DMin = 0;
                            $DMax = 0;
                            $SommeForce = 0;
                            $ForceMoyenne = 0;
                            $ForceMin = 0;
                            $ForceMax = 0;

                            // init du $Nb im$pact de chaque $Nb Cibles
                            $NbBG = 0;
                            $NbBGG = 0;
                            $NbHG = 0;
                            $NbHGG = 0;

                            $NbBD = 0;
                            $NbBDD = 0;
                            $NbHD = 0;
                            $NbHDD = 0;

                            $NbHaut = 0;
                            $NbBas = 0;

                            $NbExtG = 0;
                            $NbCentreG = 0;
                            $NbCentreD = 0;
                            $NbExtD = 0;

                            $NbGauche = 0;
                            $NbDroite = 0;

                            $NbHS = 0;

                            // init de la distance im$pact de chaque $Nb Cibles
                            $DistBG = 0;
                            $DistBGG = 0;
                            $DistHG = 0;
                            $DistHGG = 0;

                            $DistBD = 0;
                            $DistBDD = 0;
                            $DistHD = 0;
                            $DistHDD = 0;

                            $DistHaut = 0;
                            $DistBas = 0;

                            $DistExtG = 0;
                            $DistCentreG = 0;
                            $DistCentreD = 0;
                            $DistExtD = 0;

                            $DistGauche = 0;
                            $DistDroite = 0;

                            $DistHS = 0;

                            // init de la $Force d'im$pact de chaque $Nb Cibles
                            $ForceBG = 0;
                            $ForceBGG = 0;
                            $ForceHG = 0;
                            $ForceHGG = 0;

                            $ForceBD = 0;
                            $ForceBDD = 0;
                            $ForceHD = 0;
                            $ForceHDD = 0;

                            $ForceHaut = 0;
                            $ForceBas = 0;

                            $ForceExtG = 0;
                            $ForceCentreG = 0;
                            $ForceCentreD = 0;
                            $ForceExtD = 0;

                            $ForceGauche = 0;
                            $ForceDroite = 0;

                            $ForceHS = 0;

                            // init du $pourcentage de chaque Cible
                            $pNbBG = 0;
                            $pNbBGG = 0;
                            $pNbHG = 0;
                            $pNbHGG = 0;

                            $pNbBD = 0;
                            $pNbBDD = 0;
                            $pNbHD = 0;
                            $pNbHDD = 0;

                            $pNbHaut = 0;
                            $pNbBas = 0;

                            $pNbExtG = 0;
                            $pNbCentreG = 0;
                            $pNbCentreD = 0;
                            $pNbExtG = 0;

                            $pNbGauche = 0;
                            $pNbDroite = 0;

                } elseif ($CodeLigne[0] <> "") {

//echo $CodeLigne[0]=.$CodeLigne[0]./;


                          list($CodeJoueur,$TempsDsPartie,$CibleTouchee,$Dist,$Force) = explode(";", $ligne);


                          //'********************************
                          //' Calculs a partir des données de la ligne
                          //'********************************

                          //'Comptabiliser impacts
                          $NbImpact = $NbImpact + 1;


                          //echo '<b>$NbImpact = '.$NbImpact.<b><br>;
                          //echo '<br>';
                          // Ligne Lue
                          //echo '>>Ligne Lue : $TempsDsPartie = '.$TempsDsPartie;
                          //echo ' $CibleTouchee = '.$CibleTouchee;
                          //echo ' $Dist = '.$Dist;
                          //echo ' $Force = '.$Force;
                          //echo '<br>';


                          //'Calcul DeltaTps entre deux impacts
                          If ($NbImpact <> 1) {
                              $DeltaTps = $TempsDsPartie - $TempsImpactPrecedent;
                          }


                          $TempsImpactPrecedent = $TempsDsPartie;

                          //'CalcuI Impact / Seconde
                          If ($NbImpact <> 1){
                              $ImpactSeconde = ($NbImpact - 1) / ($TempsDsPartie - $TpsPartie);
                          }


                          // Calcul sur Distance
                          $SommeDist = $SommeDist + $Dist;
                          $Dmoyenne = $SommeDist / $NbImpact;

                          If ($NbImpact == 1 ){
                              $Dmin = $Dist;
                              $DMax = $Dist;
                          }

                          If ($DMax <= $Dist){
                              $DMax = $Dist;
                          }


                          If ($Dist <= $Dmin ){
                              $Dmin = $Dist;
                          }

                          // Calcul sur force
                          $SommeForce = $SommeForce + $Force;
                          $ForceMoyenne = $SommeForce / $NbImpact;

                          If ($NbImpact == 1 ){
                              $ForceMin = $Force;
                              $ForceMax = $Force;
                          }

                          If ($ForceMax <= $Force ){
                              $ForceMax = $Force;
                          }

                          If ($Force <= $ForceMin ){
                              $ForceMin = $Force;
                          }



                          //'**************************
                          //' Calcul Selon Cible Touchee tq nb impact / cible
                          //'**************************
                          switch ($CibleTouchee) {
                          Case 1 :
                              $PointCible = 1;
                              $c = $c2;

                              $CibleTouchee = "HDD";

                              $NbHDD = $NbHDD + 1;
                              $NbExtD = $NbExtD + 1;
                              $NbDroite = $NbDroite + 1;
                              $NbHaut = $NbHaut + 1;

                              $DistHDD = ($DistHDD * ($NbHDD - 1) + $Dist) / $NbHDD;

                              $ForceHDD = ($ForceHDD * ($NbHDD - 1) + $Force) / $NbHDD;
                              break;
                          Case 2 :
                              $PointCible = 3;
                              $c = $c2;

                              $CibleTouchee = "BDD";

                              $NbBDD = $NbBDD + 1;
                              $NbExtD = $NbExtD + 1;
                              $NbDroite = $NbDroite + 1;
                              $NbBas = $NbBas + 1;

                              $DistBDD = ($DistBDD * ($NbBDD - 1) + $Dist) / $NbBDD;

                              $ForceBDD = ($ForceBDD * ($NbBDD - 1) + $Force) / $NbBDD;
                              break;
                          Case 3 :
                              $PointCible = 2;
                              $c = $c2;

                              $CibleTouchee = "HD";

                              $NbHD = $NbHD + 1;
                              $NbCentreD = $NbCentreD + 1;
                              $NbDroite = $NbDroite + 1;
                              $NbHaut = $NbHaut + 1;

                              $DistHD = ($DistHD * ($NbHD - 1) + $Dist) / $NbHD;

                              $ForceHD = ($ForceHD * ($NbHD - 1) + $Force) / $NbHD;
                              break;
                          Case 4 :
                              $PointCible = 5;
                              $c = $c1;

                              $CibleTouchee = "BD";

                              $NbBD = $NbBD + 1;
                              $NbCentreD = $NbCentreD + 1;
                              $NbDroite = $NbDroite + 1;
                              $NbBas = $NbBas + 1;

                              $DistBD = ($DistBD * ($NbBD - 1) + $Dist) / $NbBD;

                              $ForceBD = ($ForceBD * ($NbBD - 1) + $Force) / $NbBD;
                              break;
                          Case 5 :
                              $PointCible = 2;
                              $c = $c2;

                              $CibleTouchee = "HG";

                              $NbHG = $NbHG + 1;
                              $NbCentreG = $NbCentreG + 1;
                              $NbGauche = $NbGauche + 1;
                              $NbHaut = $NbHaut + 1;

                              $DistHG = ($DistHG * ($NbHG - 1) + $Dist) / $NbHG;

                              $ForceHG = ($ForceHG * ($NbHG - 1) + $Force) / $NbHG;
                              break;
                          Case 6 :
                              $PointCible = 5;
                              $c = $c1;

                              $CibleTouchee = "BG";

                              $NbBG = $NbBG + 1;
                              $NbCentreG = $NbCentreG + 1;
                              $NbGauche = $NbGauche + 1;
                              $NbBas = $NbBas + 1;

                              $DistBG = ($DistBG * ($NbBG - 1) + $Dist) / $NbBG;

                              $ForceBG = ($ForceBG * ($NbBG - 1) + $Force) / $NbBG;
                              break;
                          Case 7 :
                              $PointCible = 1;
                              $c = $c2;

                              $CibleTouchee = "HGG";

                              $NbHGG = $NbHGG + 1;
                              $NbExtG = $NbExtG + 1;
                              $NbGauche = $NbGauche + 1;
                              $NbHaut = $NbHaut + 1;

                              $DistHGG = ($DistHGG * ($NbHGG - 1) + $Dist) / $NbHGG;

                              $ForceGG = ($ForceHGG * ($NbHGG - 1) + $Force) / $NbHGG;
                          Case 8 :
                              $PointCible = 3;
                              $c = $c2;

                              $CibleTouchee = "BGG";

                              $NbBGG = $NbBGG + 1;
                              $NbExtG = $NbExtG + 1;
                              $NbGauche = $NbGauche + 1;
                              $NbBas = $NbBas + 1;

                              $DistBGG = ($DistBGG * ($NbBGG - 1) + $Dist) / $NbBGG;

                              $ForceBGG = ($ForceBGG * ($NbBGG - 1) + $Force) / $NbBGG;
                              break;
                          Case 9 :
                              $PointCible = 0;

                              $CibleTouchee = "HS";
                              $NbHS = $NbHS + 1;
                              break;
                          Case ""  :
                              $PointCible = 0;

                              $CibleTouchee = "HS";
                              $NbHS = $NbHS + 1;
                              break;
                          }

                          //******************
                          //  CALCUL SCORE
                          //**********************

                          //' Si pas Prise en compte Distance
                          //Score = Score + PointCible

                          //Si Prise en Compte distance
                          //$Vc + round($c * ($d/100 - $Dm)*$Vc,0, PHP_ROUND_HALF_DOWN)
                          $Score = $Score + $PointCible + round($c * (($Dist - $Dmini/100)) * $PointCible,0, PHP_ROUND_HALF_DOWN);



                          // Point Par impact
                          $PointParImpact = $Score / $NbImpact;

                          //'**************************
                          //' Calcul % Selon Cible Touchee tq % impact / cible
                          //'**************************

                          $NbImpactStat = $NbImpact - $NbHS; // Attention si NbImpactStat = 0

                          //' % de Chaque Cible
                          $pNbHGG = $NbHGG / $NbImpactStat;
                          $pNbHG = $NbHG / $NbImpactStat;
                          $pNbBGG = $NbBGG / $NbImpactStat;
                          $pNbBG = $NbBG / $NbImpactStat;
                          $pNbBD = $NbBD / $NbImpactStat;
                          $pNbBDD = $NbBDD / $NbImpactStat;
                          $pNbHD = $NbHD / $NbImpactStat;
                          $pNbHDD = $NbHDD / $NbImpactStat;

                          //  % 'Haut; Bas; / ExtG; CentreG; CentreD; ExtD;  /  Gauche;  Droit
                          $pNbHaut = $NbHaut / $NbImpactStat;
                          $pNbBas = $NbBas / $NbImpactStat;

                          $pNbExtG = $NbExtG / $NbImpactStat;
                          $pNbCentreG = $NbCentreG / $NbImpactStat;
                          $pNbCentreD = $NbCentreD / $NbImpactStat;
                          $pNbExtD = $NbExtD / $NbImpactStat;

                          $pNbGauche = $NbGauche / $NbImpactStat;
                          $pNbDroite = $NbDroite / $NbImpactStat;

?>
<table style=width: 92.7431%; border-collapse: collapse; height: 60px; border=1>
<tbody>
<!--Entete -->
                          <tr>
                          <!--// IdSession	IdPartie	IdJoueur	Tps	DTps	NbImp	Imp/s	Cible	NbPt	Score	PtParImp 	Dist	dmoy	dmin	dMax	Force	FMoy	Fmin	FMax-->
                          <td>IdSession</td>
                          <td>IdPartie</td>
                          <td>IdJoueur</td>
                          <td>Tps</td>
                          <td>DTps</td>
                          <td>NbImp</td>
                          <td>Imp/s</td>
                          <td>Cible</td>
                          <td>NpPt</td>
                          <td>Score</td>
                          <td>pNbtParImp</td>
                          <td>Dist</td>
                          <td>dmoy</td>
                          <td>dmin</td>
                          <td>dMax</td>
                          <td>Force</td>
                          <td>FMoy</td>
                          <td>Fmin</td>
                          <td>FMax</td>
                          <!--//NbHGG	NbHG	NbBGG	NbBG	NbBD	NbBDD	NbHD	NbHDD	NbHS	NbHaut	NbBas	NbExtG	NbExtD	NbCentreD	NbCentreG	NbGauche	NbDroite	//-->
                          <td>NbHGG</td>
                          <td>NbHG</td>
                          <td>NbBGG</td>
                          <td>NbBG</td>
                          <td>NbBD</td>
                          <td>NbBDD</td>
                          <td>NbHD</td>
                          <td>NbHDD</td>
                          <td>NbHS</td>
                          <td>NbHaut</td>
                          <td>NbBas</td>
                          <td>NbExtG</td>
                          <td>NbCentreG</td>
                          <td>NbCentreD</td>
                          <td>NbExtD</td>
                          <td>NbGauche</td>
                          <td>NbDroite</td>
                          <!--//pHGG	pHG	pBGG	pBG	pBD	pBDD	pHD	pHDD	pH	pB	pExtG	pCG	pCD	pExtD	pG	pD-->
                          <td>pNbHGG</td>
                          <td>pNbHG</td>
                          <td>pNbBGG</td>
                          <td>pNbBG</td>
                          <td>pNbBD</td>
                          <td>pNbBDD</td>
                          <td>pNbHD</td>
                          <td>pNbHDD</td>
                          <td>pNbHS</td>
                          <td>pNbHaut</td>
                          <td>pNbBas</td>
                          <td>pNbExtG</td>
                          <td>pNbCentreG</td>
                          <td>pNbCentreD</td>
                          <td>pNbExtD</td>
                          <td>pNbGauche</td>
                          <td>pNbDroite</td>
                          </tr>
<!--Données -->

                          <tr>
                          <!--// IdSession	IdPartie	IdJoueur	Tps	DTps	NbImp	Imp/s	Cible	NbPt	Score	PtParImp 	Dist	dmoy	dmin	dMax	Force	FMoy	Fmin	FMax-->
                          <td><?php echo $IdSession ?></td>
                          <td><?php echo $IdPartie ?></td>
                          <td><?php echo $CodeJoueur ?></td>
                          <td><?php echo number_format($TempsDsPartie, 2, '.', '')  ?></td>
                          <td><?php echo $DeltaTps ?></td>
                          <td><?php echo $NbImpact ?></td>
                          <td><b>X>></b>Imp/s</td>
                          <td><?php echo $CibleTouchee ?></td>
                          <td><?php echo $NbPt ?></td>
                          <td><?php echo $Score ?></td>
                          <td><b>X>>NbPtParImp</td>
                          <td><?php echo $Dist ?></td>
                          <td><?php echo number_format($Dmoyenne, 2, '.', '') ?></td>
                          <td><?php echo $Dmin ?></td>
                          <td><?php echo $DMax ?></td>
                          <td><?php echo $Force ?></td>
                          <td><?php echo number_format($ForceMoyenne, 2, '.', '') ?></td>
                          <td><?php echo $ForceMin ?></td>
                          <td><?php echo $ForceMax ?></td>
<?php
$LigneResultat =
$IdSession.
";".
$IdPartie.
";".
$CodeJoueur.
";".
number_format($TempsDsPartie, 2, '.', '').
";".
$DeltaTps.
";".
$NbImpact.
";".
"Imp/s".
";".
$CibleTouchee.
";".
$NbPt.
";".
$Score.
";".
"pNbtParImp".
";".
$Dist.
";".
number_format($Dmoyenne, 2, '.', '').
";".
$Dmin.
";".
$DMax.
";".
number_format($Force, 2, '.', '').
";".
number_format($ForceMoyenne, 2, '.', '').
";".
number_format($ForceMin, 2, '.', '').
";".
number_format($ForceMax, 2, '.', '');
?>

                          <!--//NbHGG	NbHG	NbBGG	NbBG	NbBD	NbBDD	NbHD	NbHDD	NbHS	NbHaut	NbBas	NbExtG	NbExtD	NbCentreD	NbCentreG	NbGauche	NbGauche	//-->
                          <td><?php echo $NbHGG ?></td>
                          <td><?php echo $NbHG ?></td>
                          <td><?php echo $NbBGG ?></td>
                          <td><?php echo $NbBG ?></td>
                          <td><?php echo $NbBD ?></td>
                          <td><?php echo $NbBDD ?></td>
                          <td><?php echo $NbHD ?></td>
                          <td><?php echo $NbHDD ?></td>
                          <td><?php echo $NbHS ?></td>
                          <td><?php echo $NbHaut ?></td>
                          <td><?php echo $NbBas ?></td>
                          <td><?php echo $NbExtG ?></td>
                          <td><?php echo $NbCentreG ?></td>
                          <td><?php echo $NbCentreD ?></td>
                          <td><?php echo $NbExtD ?></td>
                          <td><?php echo $NbGauche ?></td>
                          <td><?php echo $NbDroite ?></td>
<?php
$LigneResultat = $LigneResultat.
";".
$NbHGG.
";".
$NbHG.
";".
$NbBGG.
";".
$NbBG.
";".
$NbBD.
";".
$NbBDD.
";".
$NbHD.
";".
$NbHDD.
";".
$NbHS.
";".
$NbHaut.
";".
$NbBas.
";".
$NbExtG.
";".
$NbCentreG.
";".
$NbCentreD.
";".
$NbExtD.
";".
$NbGauche.
";".
$NbDroite;

//file_put_contents($FichierDonneesPartie, $LigneResultat , FILE_APPEND);
//file_put_contents($FichierDonneesPartie, \n , FILE_APPEND);
?>
                          <!--//pHGG	pHG	pBGG	pBG	pBD	pBDD	pHD	pHDD	pH	pB	pExtG	pCG	pCD	pExtD	pG	pD-->
                          <td><?php echo number_format($pNbHGG , 2, '.', '') ?></td>
                          <td><?php echo number_format($pNbHG , 2, '.', '') ?></td>
                          <td><?php echo number_format($pNbBGG , 2, '.', '') ?></td>
                          <td><?php echo number_format($pNbBG , 2, '.', '') ?></td>
                          <td><?php echo number_format($pNbBD , 2, '.', '') ?></td>
                          <td><?php echo number_format($pNbBDD , 2, '.', '') ?></td>
                          <td><?php echo number_format($pNbHD , 2, '.', '') ?></td>
                          <td><?php echo number_format($pNbHDD , 2, '.', '') ?></td>
                          <td><?php echo number_format($pNbHS , 2, '.', '') ?></td>
                          <td><?php echo number_format($pNbHaut , 2, '.', '') ?></td>
                          <td><?php echo number_format($pNbBas , 2, '.', '') ?></td>
                          <td><?php echo number_format($pNbExtG , 2, '.', '') ?></td>
                          <td><?php echo number_format($pNbCentreG , 2, '.', '') ?></td>
                          <td><?php echo number_format($pNbCentreD , 2, '.', '') ?></td>
                          <td><?php echo number_format($pNbExtD , 2, '.', '') ?></td>
                          <td><?php echo number_format($pNbGauche , 2, '.', '') ?></td>
                          <td><?php echo number_format($pNbDroite , 2, '.', '') ?></td>
                        </tr>

<?php
$LigneResultat = $LigneResultat.
";".
number_format($pNbHGG , 2, '.', '').
";".
number_format($pNbHG , 2, '.', '').
";".
number_format($pNbBGG , 2, '.', '').
";".
number_format($pNbBG , 2, '.', '').
";".
number_format($pNbBD , 2, '.', '').
";".
number_format($pNbBDD , 2, '.', '').
";".
number_format($pNbHD , 2, '.', '').
";".
number_format($pNbHDD , 2, '.', '').
";".
number_format($pNbHaut , 2, '.', '').
";".
number_format($pNbBas , 2, '.', '').
";".
number_format($pNbExtG , 2, '.', '').
";".
number_format($pNbCentreG , 2, '.', '').
";".
number_format($pNbCentreD , 2, '.', '').
";".
number_format($pNbExtD , 2, '.', '').
";".
number_format($pNbGauche , 2, '.', '').
";".
number_format($pNbDroite , 2, '.', '');

file_put_contents($FichierDonneesPartie, $LigneResultat , FILE_APPEND);
file_put_contents($FichierDonneesPartie, "\n" , FILE_APPEND);

?>
</tbody>
</table>
<?php
                //echo '>>Fin de tableau : $NbImpact = '.$NbImpact;
                //echo <br>;
                //echo <br>;



                }

                echo "</tbody>";
                echo "</table>";


            }

        ?>


<h1> Taitement Terminé ! </h1>
    </body>
</html>
