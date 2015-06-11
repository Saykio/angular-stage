<?php
mysql_connect ( 'localhost', 'root', '' ) or die ( mysql_error () ); // connection a mysql
                                                                     // mysql_connect($host, $username, $password)
mysql_select_db ( 'laposte' ) or die ( mysql_error () );

$reponse = mysql_query ( "SELECT motif from conges" ); // requête qui récupère les libellés des différents type de congés
while ( $donnees = mysql_fetch_array ( $reponse ) )
	?>