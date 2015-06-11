<?php

 // JSon request format is :  
// {"userName":"654321@zzzz.com","password":"12345","emailProvider":"zzzz"}   
// read JSon input
$data_back = json_decode(file_get_contents('php://input'));   
// set json string to php variables
$motif = $data_back->{"motif"};
$debut = $data_back->{"debut"};
$fin = $data_back->{"fin"};
$sql = 'test';
date_default_timezone_set('Europe/Paris');
if($fin != NULL && $debut != NULL)
{
	
	//and !empty($_POST['motif']))
	$bdd = mysql_connect("localhost","root",""); // connection à mysql
	$bdd = mysql_select_db("laposte"); // connection à la base de donnée
	//convertion date au bon format
	$debut = date("Y-m-d", strtotime($debut));
	//$dateDebut : date au bon format
	$fin = date("Y-m-d", strtotime($fin));
	//$dateFin : date au bon format
	$sql = "INSERT INTO conges VALUES ('$motif','$debut','$fin')" ; // requête SQL qui insert la date de début et la date de fin dans la bdd // affichage de la requête SQL
	mysql_query($sql);
}
date_default_timezone_set('Europe/Paris');
$log = "Exécution du script à " . date(  'd-m-Y H:i:s' ). $motif. $debut. $fin;
$fichier = "ton_fichier.log";
file_put_contents( $fichier, $log, FILE_APPEND );
// $userDate1 = $data_back->{"userDate1"}; 
// $userDate2= $data_back->{"userDate2"};   
// JSon response format is : 
// [{"name":"eeee","email":"eee@zzzzz.com"}, 
// {"name":"aaaa","email":"aaaaa@zzzzz.com"},{"name":"cccc","email":"bbb@zzzzz.com"}] 
// set header as json
header("Content-type: application/json"); 
// send response echo json_encode($responses); 
?> 

