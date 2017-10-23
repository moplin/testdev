'use strict';

angular.module('myApp.view2', ['ngRoute'])

  .config(['$routeProvider', function ($routeProvider) {
    $routeProvider.when('/view2', {
      templateUrl: 'view2/view2.html',
      controller: 'View2Ctrl'
    });
  }])

  .controller('View2Ctrl', ['$http', function ($http) {
    console.log('View2Ctrl');
    //Lest set the cookie
    $http({
      method: 'GET',
      url: 'http://test.dev/site/set-cookie'
    }).then(function successCallback(response) {
      console.log('response', response);
    }, function errorCallback(response) {
      console.error('err', response)
    });
  }]);