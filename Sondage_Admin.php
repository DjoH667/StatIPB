<?php
// on teste si l'utilisateur a validé le formulaire et qu'il cherche à insérer le sondage dans la base, et non à ajouter une réponse au sondage
if (isset($_POST['go']) && $_POST['go']=='Valider') {
	if (!isset($_POST['question']) || empty($_POST['question'])) {
	$erreur = 'Votre question est vide.';
	}
	else {
	// on va regarder si l'utilisateur n'a pas laissé un champ vide
	$valid_form = 1;
	for ($i=1; $i<=$_POST['nb_reponses']; $i++){
		$temp = "reponse_$i";
		if (isset($_POST[$temp])) $value=$_POST[$temp];
		if (empty($value)) $valid_form = 0;
	}
	if ($valid_form == 0) {
		$erreur = 'Au moins une de vos réponse est vide.';
	}
	else {
		// on se connecte à notre base de données
		$base = mysql_connect ('serveur', 'login', 'password');
		mysql_select_db('nom_base', $base);

		// on insère notre question
		$sql = 'INSERT INTO sondage_questions VALUES("","'.mysql_escape_string($_POST['question']).'")';
		mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());

		$id_sondage = mysql_insert_id();

		// on insère les réponses possibles à ce sondage
		for ($i=1; $i<=$_POST['nb_reponses']; $i++){
		$temp = "reponse_$i";
		if (isset($_POST[$temp])) $value=$_POST[$temp];

		$sql = 'INSERT INTO sondage_reponses VALUES("","'.$id_sondage.'","'.mysql_escape_string($value).'", "0")';
		mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());

		}
		// on redirige l'utilisateur à l'accueil du sondage
		header("location: ../index.php");
		exit();
	}
	}

}
?>
<html>
<head>
<title>Insertion d'un nouveau sondage</title>
</head>

<body>

<form action="insert_sondage.php" method="post">
<table>
<tr><td>
[b]Question :[/b]
</td><td>
<input type="text" name="question" value="<?php if (isset($_POST['question'])) echo stripslashes(htmlentities(trim($_POST['question']))); ?>">
</td></tr>
<?php
// on teste si la variable $_POST['nb_reponses'] est définie ou pas. Si elle ne l'est pas, on la défini à 1 (un sondage aura au moins une reéponse possible :)
if (!isset($_POST['nb_reponses'])) $_POST['nb_reponses'] = 1;

// si l'utilisateur a clické sur 'Ajouter une réponse' on incrémente la variable $_POST['nb_reponses'], ce qui va nous permettre de rajouter un champ de type text (pour la nouvelle réponse possible) à notre formulaire
if (isset($_POST['go']) && $_POST['go']=='Ajouter une réponse') $_POST['nb_reponses']++;

for ($i=1; $i<=$_POST['nb_reponses']; $i++){
	$temp = "reponse_$i";
	if (isset($_POST[$temp])) $value=$_POST[$temp];
	echo '<tr><td><td><input type="text" name="reponse_'.$i.'" value="';
	if (isset($value)) echo stripslashes(htmlentities(trim($value)));
	echo '"></td></tr>';
	unset($value);
}

// on passe à notre formulaire le nombre de réponse au sondage
echo '<input type="hidden" name="nb_reponses" value="'.$_POST['nb_reponses'].'">';
echo '<tr><td><input type="submit" name="go" value="Ajouter une réponse"></td></tr>';
echo '<tr><td>&nbsp;</td></tr>';
echo '<tr><td><input type="submit" name="go" value="Valider"></td></tr>';

?>
</table>
</form>
<?php
if (isset($erreur)) echo '<br /><br />',$erreur;
?>
</body>
</html>
