<?php
mysql_connect ( 'localhost', 'root', '' ) or die ( mysql_error () ); // connection a mysql
                                                                     // mysql_connect($host, $username, $password)
mysql_select_db ( 'laposte' ) or die ( mysql_error () );

$reponse = mysql_query ( "SELECT motif from conges" ); // requ�te qui r�cup�re les libell�s des diff�rents type de cong�s
while ( $donnees = mysql_fetch_array ( $reponse ) )
	?>