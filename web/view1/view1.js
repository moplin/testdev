'use strict';

angular.module('myApp.view1', ['ngRoute'])

  .config(['$routeProvider', function ($routeProvider) {
    $routeProvider.when('/view1', {
      templateUrl: 'view1/view1.html',
      controller: 'View1Ctrl',
      as: 'vm'
    });
  }])

  .controller('View1Ctrl', ['$cookies', function ($cookies) {
    console.log('View1Ctrl++++++++');
    var vm = this;
    vm.title = 'Customers';

    $cookies.remove('token');
    $cookies.put('token', 'my-angular-token');
    vm.myToken = $cookies.get('token');
    console.log('myToken', vm.myToken);
  }]);

