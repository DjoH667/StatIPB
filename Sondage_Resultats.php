<html>
<head>
<title>Résultats des votes</title>
</head>

<body>
<?php
// on se connecte à notre base de données
$base = mysql_connect ('localhost','root','');
mysql_select_db ('howto_sondage',$base);

// on selectionne la question et l'id du sondage en cours
$sql = 'SELECT id, question FROM sondage_questions ORDER BY id DESC LIMIT 0,1';

// on lance la requête
$req = mysql_query ($sql) or die ('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());

// on récupère le résultat dans un tableau associatif
$data = mysql_fetch_array ($req);

// on libère l'espace mémoire alloué à cette requête

$nb_sondage = mysql_num_rows($req);
mysql_free_result ($req);

if ($nb_sondage == 0) {
	echo 'Aucun sondage.';
}
else {

	// on affiche la question
	echo stripslashes(htmlentities(trim($data['question']))),'<br />';

	// on déclare un tableau qui contiendra les réponses de notre sondage
	$tableau_reponses = array();

	// on déclare un tableau qui contiendra le nombre de réponse à chaque question
	$tableau_nb_reponses = array();

	// on selectionne les reponses de ce sondage
	$sql = 'SELECT reponse, nb_reponses FROM sondage_reponses WHERE id_sondage="'.$data['id'].'"';

	// on lance la requête
	$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());

	// on prépare notre boucle pour récupérer les différents choix possibles de réponses
	while ($data = mysql_fetch_array($req)) {
	// on place ces valeurs dans nos deux tableaux
	$tableau_reponses[] = $data['reponse'];
	$tableau_nb_reponses[] = $data['nb_reponses'];
	}

	// on libère l'espace mémoire alloué à cette requête
	mysql_free_result ($req);

	// on ferme la connection à notre base de données
	mysql_close ();

	// on compte le nombre de réponses possible de notre sondage
	$nb_reponses_du_sondage = count ($tableau_reponses);

	// on compte le nombre total de réponses pour ce sondage
	$nb_total_reponse = array_sum ($tableau_nb_reponses);

	// on teste le nombre de vote
	if ($nb_total_reponse == 0) {
	// cas où personne n'a voté
	echo 'Aucun vote pour l'instant';
	}
	else {
	// cas où quelqu'un a déjà voté
	for ($i = 0; $i < $nb_reponses_du_sondage; $i++) {
		// on affiche une réponse
		echo $tableau_reponses[$i];

		// on calcul le pourcentage de cette réponse
		$pourcentage = ($tableau_nb_reponses[$i] * 100) / $nb_total_reponse;

		// on arrondi ce calcul à un chiffre après la virgule
		$pourcentage = round ($pourcentage, 1);

		// on affiche le pourcentage
		echo ' ',$pourcentage,' %<br />';
	}

	// on affiche le nombre total de votes
	echo '<br /><br />Nombre de votes : ', $nb_total_reponse;
	}
}
?>
</body>
</html>
