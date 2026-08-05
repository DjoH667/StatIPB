INSERT INTO 'DonneesSession' ('IdSession','DateSession','IdPartieJoueur01','IdPartieJoueur02','IdPartieJoueur03','IdPartieJoueur04','IdPartieJoueur05','IdPartieJoueur06','IdPartieJoueur07','IdPartieJoueur08','IdPartieJoueur09')
 VALUES 
(7,'13/03/20',19,20,21,NULL,NULL,NULL,NULL,NULL,NULL);

INSERT INTO 'ParametresPartie' ('IdPartie','DatePartie','IdJoueur','DureePartie','DminPartie','c1Partie','c2Partie') VALUES 
(19,'13/03/20','P01',30,200,0.20,0.15),
(20,'13/03/20','P02',60,300,0.20,0.15),
(21,'13/03/20','P03',90,400,0.20,0.15);


INSERT INTO 'DonneesParties' ('IdSession','IdPartie','IdJoueur','Tps','DTps','NbImp','Imp/S','Cible','NbPt','Score','PtParImp','dist','dmoy','dmin','dMax','Force','Fmoy','Fmin','FMax', 'NbHGG','NbHG','NbBGG','NbBG','NbBD','NbBDD','NbHD','NbHDD','NbHS','NbHaut','NbBas','NbExtG','NbExtD','NbCentreD','NbCentreG','NbGauche','NbDroite', 'pHGG','pHG','pBGG','pBG','pBD','pBDD','pHD','pHDD','pH','pB','pExtG','pCG','pCD','pExtD','pG','pD') VALUES 
(7,19,'P01',0.00,0,1,'Imp/s','HD',NULL,7,'NbPtParImp',18.47,18.47,18.47,18.47,2.55,2.55,2.55,2.55,0,0,0,0,0,0,1,0,0,1,0,0,0,1,0,0,1,0.00,0.00,0.00,0.00,0.00,0.00,1.00,0.00,1.00,0.00,0.00,0.00,1.00,0.00,0.00,1.00);

COMMIT;