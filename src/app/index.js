'use strict';

angular.module('caoguoApp', ['ngAnimate', 'ngCookies', 'ngTouch', 'ngSanitize', 'ngResource', 'ngRoute', 'ngMaterial'])
  .config(['$routeProvider','$locationProvider',function ($routeProvider,$locationProvider) {
    //$locationProvider.html5Mode(!0);
    //$locationProvider.html5Mode(true).hashPrefix('!');
    $routeProvider
      .when('/', {
        templateUrl: 'app/main/main.html',
        controller: 'MainCtrl'
      })
      .otherwise({
        redirectTo: '/'
      });
  }])
;
