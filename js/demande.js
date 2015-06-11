'use strict';
/**
 * Montage du module de portail
 */
// var moduleStage = angular.module('moduleStage', []);
var moduleStage = angular.module('moduleStage',
		[ 'ngResource', 'ui.bootstrap' ]);

/**
 * Controler du portail
 */
moduleStage.controller('StageControleur', [ '$scope', '$resource',
		controleurStage ]);


function controleurStage($scope, $resource) {
	console.info('Démarage du controleur');
    $scope.ouvertureDebut = function($event)
    {
          $event.preventDefault();
          $event.stopPropagation();
          $scope.debutOuvert = true;
    };
    $scope.ouvertureFin = function($event)
    {
          $event.preventDefault();
          $event.stopPropagation();
          $scope.debutFin = true;
    };

	$scope.envoyerDemande = function() {
		var Demande = $resource('Demandeconge.php');
		var dmd = new Demande();
		dmd.motif = $scope.motif;
		dmd.debut = $scope.debut,
		dmd.fin = $scope.fin;
		Demande.save(dmd, function() {
			console.info("Envoie d'une demande");
			$scope.valide = true;
			$scope.motif = '';
		}, function() {
			console.info("Service indisponible");
			$scope.erreur = true;
		});

	};
}
