'use strict';
/**
* Montage du module de portail
*/
var moduleStage = angular.module('moduleStage', []);

/**
* Controler du portail
*/
moduleStage.controller('StageControleur', [ '$scope', controleurStage ]);

function controleurStage($scope)
{
       console.info('Démarage du controleur');
       $scope.motif = 'ca';
       
       $scope.envoyerDemande = function(){
    	   console.info("Envoie d'une demande");
       };  
}
