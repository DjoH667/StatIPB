<?php
// on teste si formulaire de vote a été validé
if (isset($_POST['go']) && $_POST['go']=='Vote') {
	if (!isset($_POST['choix']) || !isset($_POST['sondage_en_cours'])) {
	$erreur = 'Aucune réponse n\'a été choisie.';
	}
	// on teste si le visiteur a bien choisi une réponse avant d'avoir clické sur "Vote". On teste aussi si la variable $_POST['sondage_en_cours'] n'est pas vide
	if (empty($_POST['choix']) || empty($_POST['sondage_en_cours'])) {
	$erreur = 'Au moins un des champs est vide.';
	}
	else {
	// là le visiteur à choisi une réponse
	// on se connecte à notre base
	$base = mysql_connect ('serveur','login','pawword');
	mysql_select_db ('nom_base',$base);

	// on prépare notre requête : on ajoute un vote pour la réponse choisie par le votant
	$sql ='UPDATE sondage_reponses SET nb_reponses = nb_reponses + 1 WHERE id_sondage="'.$_POST['sondage_en_cours'].'" AND id="'.$_POST['choix'].'"';

	// on lance la requête
	mysql_query ($sql) or die ('Erreur SQL !'.$sql2.'<br />'.mysql_error());

	// on ferme la connexion à la base de donnée
	mysql_close ();

	$erreur = 'Merci d\'avoir voté :)';
	}
}
?>

<html>
<head>
<title>Index de notre sondage :)</title>
</head>

<body>
<?php
// on se connecte à notre base de données
$base = mysql_connect ('localhost','root','');
mysql_select_db ('howto_sondage',$base);

// on prépare une requête pour sélectionner l'id et la question du dernier sondage (on sélectionne les questions, et on en prend qu'une (le LIMIT 0,1) et ce, dans un ordre décroissent (DESC), soit en fait, la dernière question posée).
$sql = 'SELECT id, question FROM sondage_questions ORDER BY id DESC LIMIT 0,1';

// on lance la requête
$req = mysql_query ($sql) or die ('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());

// on récupère le résultat dans un tableau associatif
$data = mysql_fetch_array ($req);

$nb_sondage = mysql_num_rows($req);

if ($nb_sondage == 0) {
	echo 'Aucun sondage.';
}
else {
	// on libère l'espace mémoire alloué à cette requête
	mysql_free_result ($req);

	// on affiche la question
	echo stripslashes(htmlentities(trim($data['question']))),'<br />';

	// on prepare l'affichage de notre formulaire permettant de voter
	echo '<form action = "index.php" method = "post">';

	// on prépare une requête permettant de sélectionner les réponses possibles se rapportant à ce même sondage
	$sql = 'SELECT id, reponse FROM sondage_reponses WHERE id_sondage="'.$data['id'].'"';

	// on lance la requête
	$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());

	// on prépare notre boucle pour afficher les différents choix possibles de réponses
	while ($donnees = mysql_fetch_array($req)) {
	// on affiche des boutons radio pour les différents choix de réponses possibles
	echo '<input type="radio" name="choix" value="' , $donnees['id'] , '"> ' , stripslashes(htmlentities(trim($donnees['reponse']))) , '<br />';
	}
	?>
	<input type = "hidden" name = "sondage_en_cours" value = "<?php echo $data['id']; ?>">
	<input type = "submit" name="go" value = "Vote">
	</form>
	<?php
}

// on libère l'espace mémoire alloué à cette requête
mysql_free_result ($req);

// on ferme la connection à notre base de données
mysql_close ();
?>
<br /><br />
<a href="sondage_resultats.php">Voir les résultats</a>
<?php
// on affiche les erreurs éventuelles
if (isset($erreur)) echo '<br /><br />',$erreur;
?>
</body>
</html>
