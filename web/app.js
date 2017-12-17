'use strict';

// Declare app level module which depends on views, and components
angular.module('myApp', [
  'ngRoute',
  'ngCookies',
  'hljs',
  'credit-cards',
  'myApp.view1',
  'myApp.view2',
  'myApp.version'
]).
config(['$locationProvider', '$routeProvider', function($locationProvider, $routeProvider, hljsServiceProvider) {
  $locationProvider.hashPrefix('!');

  $routeProvider.otherwise({redirectTo: '/view1'});

  // hljsServiceProvider.options({
  //     tabReplace: '    ', // 4 spaces
  //     classPrefix: ''     // don't append class prefix
  // });
}]);
