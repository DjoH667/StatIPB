BEGIN TRANSACTION;
DROP TABLE IF EXISTS "ParametresPartie";
CREATE TABLE IF NOT EXISTS "ParametresPartie" (
	"IdPartie"	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	"DatePartie"	TEXT NOT NULL,
	"IdJoueur"	INTEGER NOT NULL,
	"DureePartie"	INTEGER NOT NULL,
	"DminPartie"	INTEGER,
	"c1Partie"	REAL,
	"c2Partie"	REAL
);
INSERT INTO "ParametresPartie" ("IdPartie","DatePartie","IdJoueur","DureePartie","DminPartie","c1Partie","c2Partie") VALUES (1,'05/02/2020','US4',120,3,0.0,0.0),
 (2,'05/02/2020','TM4',120,3,0.0,0.0),
 (3,'05/02/2020','LB8',120,3,0.0,0.0);
COMMIT;
