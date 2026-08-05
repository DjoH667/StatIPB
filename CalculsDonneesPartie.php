<?php
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
    break;
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
//$Score = $Score + $PointCible + round($c * (($Dist - $Dmini/100)) * $PointCible,0, PHP_ROUND_HALF_UP);
//$DeltaDist = round ($Dist - $Dmini/100,0,PHP_ROUND_HALF_DOWN);
//$Score = $Score + $PointCible + round($c * $DeltaDist * $PointCible,0, PHP_ROUND_HALF_DOWN);

// Point Par impact
$PointParImpact = $Score / $NbImpact;

//'**************************
//' Calcul % Selon Cible Touchee tq % impact / cible
//'**************************

$NbImpactStat = $NbImpact - $NbHS; // Attention si NbImpactStat = 0

if ($NbImpactStat<> 0){
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
}
?>
