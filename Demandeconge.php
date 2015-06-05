<?php
date_default_timezone_set('Europe/Paris');
$log = "Exécution du script à " . date(  'd-m-Y H:i:s' );
$fichier = "ton_fichier.log";
file_put_contents( $fichier, $log, FILE_APPEND );
?>
