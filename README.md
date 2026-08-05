# StatIPB

StatIPB est une application PHP/SQLite de consultation et de traitement des statistiques iPassBall.

## Fonctionnalites

- Tableau de bord global des parties, sessions et joueurs.
- Classements par partie, session et joueur.
- Syntheses de parties avec score, distance, force et repartition des impacts.
- Graphiques via Google Charts et bibliotheques de tests conservees dans `Z_SolutionCharts/`.
- Generation de fichiers SQL depuis les logs de sessions.

## Structure

- `index.php` : tableau de bord principal.
- `ConnexionBDDiPassBall.php` : ouverture SQLite centralisee.
- `config.php` : configuration locale du chemin de base et du fuseau horaire.
- `Security.php` : helpers simples de validation/echappement des entrees.
- `TableJoueurs.php`, `TableSessions.php`, `TableParties.php` : vues principales.
- `SynthesePartie.php`, `StatDistancePartie.php`, `ResultatChronoPartie.php` : detail d'une partie.
- `FournirFichiersSQL.php`, `LireEcrireFichierSQL.php` : outils d'import/generation SQL.
- `Sessions/` : donnees de sessions source.
- `FichiersPrBDD/` : exports SQL historiques.

## Prerequis

- PHP avec l'extension SQLite3 active.
- Un serveur web local ou le serveur PHP integre.

Exemple de lancement local :

```sh
php -S 127.0.0.1:8000
```

Puis ouvrir `http://127.0.0.1:8000/index.php`.

## Base de donnees

La base active est configuree dans `config.php`.

Par defaut :

```php
'database_path' => $ConfiguredDatabasePath ? $ConfiguredDatabasePath : $DefaultDatabasePath
```

Le chemin peut etre force avec la variable d'environnement `STATIPB_DATABASE`.

Les nouvelles bases SQLite locales sont ignorees par Git pour eviter de publier par accident des coordonnees ou donnees personnelles de joueurs. Si une base de demonstration doit etre partagee, creer plutot une base anonymisee.

Les tables principales sont :

- `Joueurs`
- `DonneesSession`
- `ParametresPartie`
- `DonneesParties`
- `SyntheseDonneesParties`

## Notes de stabilisation

- Les identifiants passes dans les URL doivent etre lus via `app_get_int()`.
- Les textes provenant de l'utilisateur doivent etre affiches avec `app_escape()`.
- Les nouvelles requetes SQL devraient utiliser des requetes preparees lorsque des valeurs non numeriques sont injectees.
- Les fichiers generes et copies locales de base ne doivent pas etre commits.
