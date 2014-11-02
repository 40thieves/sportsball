//var app = angular.module('competitionApp',['competitionCtrl','competitionService']);

var app = angular.module('AdminApp',[
    'ngRoute',
    'AdminApp.Controllers',
    //'teamController',
    'AdminApp.Services'
]);

app.config(function($routeProvider)
    {
        $routeProvider.
            when('/admin/angular/competitions',{
                templateUrl: 'Views/Partials/competitions.html',
                controller: 'testController'
            }).
            //when('/admin/angular/teams',{
            //    templateUrl: 'Views/Partials/teams.html',
            //    controller: 'teamController'
            //}).
            otherwise({
                redirectTo: '/admin/angular/competitions'
            })
    });

var controllers = {};
controllers.testController = function($scope){
    $scope.first = "Info";
    $scope.customers=[
        {name:'jerry',city:'chicago'},
        {name:'tom',city:'houston'},
        {name:'enslo',city:'taipei'}
    ];
}

app.controller(controllers);