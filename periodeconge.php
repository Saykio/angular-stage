<?php
function isperiodeconge($numJour, $mois, $annee, $datedebut, $datefin) {
	$date_array_debut = date_parse ( $datedebut );
	$date_array_fin = date_parse ( $datefin );
	$timestamp_debut = date ( 'U', mktime ( $date_array_debut ['hour'], $date_array_debut ['minute'], $date_array_debut ['second'], $date_array_debut ['month'], $date_array_debut ['day'], $date_array_debut ['year'] ) );
	$timestamp_fin = date ( 'U', mktime ( $date_array_fin ['hour'], $date_array_fin ['minute'], $date_array_fin ['second'], $date_array_fin ['month'], $date_array_fin ['day'], $date_array_fin ['year'] ) );
	
	$timestamp_current = date ( "U", mktime ( 0, 0, 0, $mois, $numJour, $annee ) );
	return ($timestamp_debut <= $timestamp_current && $timestamp_current <= $timestamp_fin);
}
?>