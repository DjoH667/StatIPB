<tr>
<!--// IdSession	IdPartie	IdJoueur	Tps	DTps	NbImp	Imp/s	Cible	NbPt	Score	PtParImp 	Dist	dmoy	dmin	dMax	Force	FMoy	Fmin	FMax-->
<td><?php echo $IdSession ?></td>
<td><?php echo $IdPartie ?></td>
<td><?php echo $IdJoueur ?></td>
<td><?php echo number_format($TempsDsPartie, 2, '.', '')  ?></td>
<td><?php echo $DeltaTps ?></td>
<td><?php echo $NbImpact ?></td>
<td><b>X>></b>Imp/s</td>
<td><?php echo $CibleTouchee ?></td>
<td><?php echo $NbPoint ?></td>
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
