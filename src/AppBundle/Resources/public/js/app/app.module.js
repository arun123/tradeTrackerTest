'use strict';

var underscore = angular.module('underscore', []);
underscore.factory('_', ['$window', function($window) {
  return $window._; // assumes underscore has already been loaded on the page
}]);

angular.module('tradeTracker',[  'ngAnimate', 'angularSpinner', 'toaster','underscore']);
