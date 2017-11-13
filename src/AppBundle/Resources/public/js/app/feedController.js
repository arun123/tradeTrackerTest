'use strict';

angular.module('tradeTracker')
	.controller('FeedCtrl',['$scope','$http','usSpinnerService','toaster' ,function($scope, $http, usSpinnerService, toaster){
		
		$scope.feedURL = "http://pf.tradetracker.net/?aid=1&type=xml&encoding=utf-8&fid=251713&categoryType=2&additionalType=2&limit=10";
 
        $scope.startSpin = function(){
            usSpinnerService.spin('well');
        }

        $scope.stopSpin = function(){
            usSpinnerService.stop('well');
        }
        $scope.stopSpin();

	    $scope.fetchFeed = function() {
	    	$scope.startSpin();

            $http.post(Routing.generate('process_feed'), { 'feedURL': $scope.feedURL }).success(function(data, status, headers, config) 
            { 
            	$scope.products = data;
            	$scope.stopSpin();
            	if(data.status != 404)
            	{
		    		toaster.pop('success',"Success" ,"Feed processed sucessfully!");

            	}
	    	}).error(function(data, status, headers, config) {
	    		$scope.stopSpin();
				toaster.pop('error',"error" ,"Failed to process the feed!");
      		});
	    };
	}]);