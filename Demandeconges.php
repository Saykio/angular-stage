<!DOCTYPE html>
<html>
<link rel="stylesheet" href="css.css" />
<head>

</head>
<body>

	<table class="ds_box" cellpadding="0" cellspacing="0" id="ds_conclass"
		style="display: none;">
		<tr>
			<td id="ds_calclass">
	
	</table>
	<form action="" method="post">
		<div
			style="width: 320px; padding-top: 10px; padding-bottom: 0px; border: 3px solid #BDBDBD; background: #E6E6E6;">
			<strong>
				<p>Type de conges <select name="libelle">
<?php
$log = "Exécution du script à " . date(  'd-m-Y H:i:s' );
$fichier = "ton_fichier.log";
file_put_contents( $fichier, $log, FILE_APPEND );
mysql_connect ( 'localhost', 'root', '' ) or die ( mysql_error () ); // connection a mysql
                                                              // mysql_connect($host, $username, $password)
mysql_select_db ( 'laposte' ) or die ( mysql_error () );

$reponse = mysql_query ( "SELECT libelle from typeconges" ); // requête qui récupère les libellés des différents type de congés
while ( $donnees = mysql_fetch_array ( $reponse ) ) {
?>
<option value="<?php echo $donnees['libelle']; ?>"><?php echo $donnees['libelle']; ?></option>
<?php
}
?>
</select> <br>Date de début : <input onclick="ds_sh(this);" name="date"
						readonly="readonly" style="cursor: text"  value="<?php date_default_timezone_set('Europe/Paris'); 
						 echo date("d/m/Y");?>"/><br /> <select
						class='listederoulante1' name="jour">
						<option selected>Matin
						
						<option>Midi
						
						<option>Soir
					
					</select> <br class='fin'>Date de fin : <input class='decale'
						onclick="ds_sh(this);" name="date2" readonly="readonly"
						style="cursor: text" value="<?php date_default_timezone_set('Europe/Paris'); 
						 echo date("d/m/Y");?>" /><br /> <select class='listederoulante'
						name="jour">
						<option>Matin
						
						<option>Midi
						
						<option selected>Soir
					
					</select> <br>
					<input type="submit" value="Ajouter" />
				
				<p>
			
			</strong>
		</div>
<?php
date_default_timezone_set('Europe/Paris'); 
if(isset($_POST) and !empty($_POST['date']) and !empty($_POST['date2']) and !empty($_POST['libelle']))
{
$bdd = mysql_connect("localhost","root",""); // connection à mysql
$bdd = mysql_select_db("laposte"); // connection à la base de donnée
//var_dump($_POST['libelle']);
//convertion date au bon format
//var_dump($_POST['date']);
$originalDateDebut = $_POST['date'];
$dateDebut = date("Y-m-d", strtotime($originalDateDebut));
//var_dump($dateDebut);
//$dateDebut : date au bon format

$originalDateFin = $_POST['date2'];
$dateFin = date("Y-m-d", strtotime($originalDateFin));
//var_dump($dateFin);
//$dateFin : date au bon format

$sql = "INSERT INTO conges values('','$dateDebut', '$dateFin')"; // requête SQL qui insert la date de début et la date de fin dans la bdd
//var_dump($sql); // affichage de la requête SQL
mysql_query($sql);
}
?>

<?php
date_default_timezone_set ( 'Europe/Paris' );
if (isset ( $_POST ['date'] ) && isset ( $_POST ['date2'] )) {
	$dureeSejour = strtotime ( $_POST ['date2'] ) - strtotime ( $_POST ['date'] ); // permet de calculer la durée entre 2 dates
}
if ($dureeSejour < 0){
	echo "<script>alert(\"Vous devez selectionner deux dates valides\")</script>";}

function getTableau($annee, $mois) {
	if (isset ( $_POST ['date'] ) && isset ( $_POST ['date2'] )) {
		$datedebut = $_POST ['date'];
		$datefin = $_POST ['date2'];
	}
	$numJourDu1duMois = date ( "N", mktime ( 0, 0, 0, $mois, 1, $annee ) ); // donne le premier d'un mois donné
	$nbJourMois = date ( "t", mktime ( 0, 0, 0, $mois, 1, $annee ) ); // donne le nombre de jour d'un mois donné
	$numJour = 0;
	// $numJourDu1duMois = 4;
	// $nbJourMois = 30;
	echo "<table border = 1>";
	echo "<th>Lundi</th>
			  <th>Mardi</th>
			  <th>Mercredi</th>
			  <th>Jeudi</th>
			  <th>Vendredi</th>
			  <th>Samedi</th>
			  <th>Dimanche</th>";
	for($y = 0; $y < 6; $y ++) { // ajout d'une colonne tant que y n'est pas supérieur à 6
		echo "<tr>";
		for($x = 0; $x < 7; $x ++) { // ajout d'une ligne tant que x n'est pas supérieur à 7
			$couleur = 'blanc';
			if ($x == 6 or $x == 5) {
				$couleur = 'gris';
			}
			if (isset ( $_POST ['date'] ) && isset ( $_POST ['date2'] )) {
				if (isperiodeconge ( $numJour, $mois, $annee, $datedebut, $datefin )) {
					$couleur = 'rouge';
				}
			}
			if ($numJour == 0) {
				if (($x + 1) * ($y + 1) == $numJourDu1duMois) {
					$numJour ++;
				}
			} else {
				$numJour ++;
			}
			if ($numJour > 0 && $numJour <= $nbJourMois) {
				echo "<td class = '$couleur'>" . $numJour . "</td>";
			} else {
				echo "<td></td>";
			}
		}
		echo "</tr>";
	}
	echo "</table>";
         }
         include 'periodeconge.php';
		 getTableau(date('Y'),date('m'));
		 
?>	


	 
</form>
	<script src="java.js" type="application/javascript"></script>
</body>

</html>