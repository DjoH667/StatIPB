<?php
// IdSession	IdPartie	IdJoueur	Tps	DTps	NbImp	Imp/s	Cible	NbPt	Score	PtParImp 	Dist	dmoy	dmin	dMax	Force	FMoy	Fmin	FMax-->
$LigneDonneesPartie=$LigneDonneesPartie.
$IdSession.
",".
$IdPartie.
",".
$IdJoueur.
",".
number_format($TempsDsPartie, 2, '.', '').
",".
$DeltaTps.
",".
$NbImpact.
",".
"'"."Imp/s"."'".
",".
"'".$CibleTouchee."'".
",".
$NbPoint.
",".
$Score.
",".
"'"."NbPtParImp"."'".
",".
$Dist.
",".
number_format($Dmoyenne, 2, '.', '').
",".
$Dmin.
",".
$DMax.
",".
number_format($Force, 2, '.', '').
",".
number_format($ForceMoyenne, 2, '.', '').
",".
number_format($ForceMin, 2, '.', '').
",".
number_format($ForceMax, 2, '.', '').
//NbHGG	NbHG	NbBGG	NbBG	NbBD	NbBDD	NbHD	NbHDD	NbHS	NbHaut	NbBas	NbExtG	NbExtD	NbCentreD	NbCentreG	NbGauche	NbGauche	//-->
//$LigneDonneesPartie=$LigneDonneesPartie.
",".
$NbHGG.
",".
$NbHG.
",".
$NbBGG.
",".
$NbBG.
",".
$NbBD.
",".
$NbBDD.
",".
$NbHD.
",".
$NbHDD.
",".
$NbHS.
",".
$NbHaut.
",".
$NbBas.
",".
$NbExtG.
",".
$NbCentreG.
",".
$NbCentreD.
",".
$NbExtD.
",".
$NbGauche.
",".
$NbDroite.
//pHGG	pHG	pBGG	pBG	pBD	pBDD	pHD	pHDD	pH	pB	pExtG	pCG	pCD	pExtD	pG	pD-->
//$LigneDonneesPartie=$LigneDonneesPartie.
",".
number_format($pNbHGG , 2, '.', '').
",".
number_format($pNbHG , 2, '.', '').
",".
number_format($pNbBGG , 2, '.', '').
",".
number_format($pNbBG , 2, '.', '').
",".
number_format($pNbBD , 2, '.', '').
",".
number_format($pNbBDD , 2, '.', '').
",".
number_format($pNbHD , 2, '.', '').
",".
number_format($pNbHDD , 2, '.', '').
",".
number_format($pNbHaut , 2, '.', '').
",".
number_format($pNbBas , 2, '.', '').
",".
number_format($pNbExtG , 2, '.', '').
",".
number_format($pNbCentreG , 2, '.', '').
",".
number_format($pNbCentreD , 2, '.', '').
",".
number_format($pNbExtD , 2, '.', '').
",".
number_format($pNbGauche , 2, '.', '').
",".
number_format($pNbDroite , 2, '.', '');

//$LigneDonneesPartie=$LigneDonneesPartie.$DerniereLigneDonneesPartie;
?>
