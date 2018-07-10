/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//Routing.generate('route_id', /* your params */)
//Routing.generate('route_id', /* your params */, true)

angular.module("application", ["ngMaterial", "ngRoute", "application.common", "application.companies", "application.workers"])

        .config(["$routeProvider", "$httpProvider", function ($routeProvider, $httpProvider) { //configuración general del módulo principal 

                $httpProvider.interceptors.push('authInterceptor');

                //definición y configuración de las rutas 

                $routeProvider
                        .when("/", {
                            controller: "leftNavBarItemCtrl",
                            controllerAs: "vm",
                            template: ''
                        })
                        .when("/companies", {
                            controller: "leftNavBarItemCtrl",
                            controllerAs: "vm",
                            templateUrl: Routing.generate('samples_company_api_companyapi_templates', {action: 'crud'}, true),
                        })
                        .when("/workers", {
                            controller: "leftNavBarItemCtrl",
                            controllerAs: "vm",
                            templateUrl: Routing.generate('samples_company_api_workerapi_templates', {action: 'crud'}, true),
                        })
                        ;

            }])
        .factory('authInterceptor', ["$rootScope", "$q", "$window", function ($rootScope, $q, $window) {
                return {
                    request: function (config) {
                        config.headers = config.headers || {};

                        if ($window.sessionStorage.token) {
                            config.headers.Authorization = 'Bearer ' + $window.sessionStorage.token;
                        }
                        return config;
                    },
                    response: function (response) {
                        if (response.status === 401) {
                            // if 401 unauthenticated
                        }
                        return response || $q.when(response);
                    }
                };
            }])
        .run(['$rootScope', '$http', '$window', 'api_authenticator', function ($rootScope, $http, $window, api_authenticator) {
                console.log('application', 'init run');

                var vm = $rootScope;
                vm.scope_name = 'application';

            }])
        .controller("appCtrl", ['$scope', '$rootScope', '$location', '$http', '$window', function ($scope, $rootScope, $location, $http, $window) {
                console.log('app ctrl', 'init');
                var vm = this;
                vm.scope_name = 'appCtrl';

                //$rootScope.login();
                //$rootScope.hideAjaxLoader();

                $rootScope.$on('$routeChangeStart', function (event, next, current) {
                    console.log('route change start');
                    if (undefined !== next)
                        $rootScope.showAjaxLoader();
                });
                $rootScope.$on('$routeChangeSuccess', function (event, next, current) {
                    console.log('route change success');
                    if (undefined !== next)
                        $rootScope.hideAjaxLoader();
                });
                $rootScope.$on('$routeChangeError', function (event, next, current) {
                    console.log('route change error');
                    alert('Some error occurred trying to load: ' + next.$$route.originalPath);
                    $window.history.back();
                    $rootScope.hideAjaxLoader();
                });
                $rootScope.$on('$viewContentLoaded', function (event, next, current) {
                    console.log('view content loaded');
                    $rootScope.hideAjaxLoader();
                });
                $rootScope.$on('$stateChangeSuccess', function (event, next, current) { // if you are using ui-route
                    // do something
                });

            }])
        .controller("leftNavBarCtrl", ['$scope', '$rootScope', '$location', function ($scope, $rootScope, $location) {

                console.log('left nav bar ctrl', 'init');
                var vm = this;
                vm.scope_name = 'leftNavBarCtrl';

                vm.current = function (route) {
                    return $location.path() == route;
                };
            }])
        .controller("leftNavBarItemCtrl", ['$scope', '$rootScope', '$location', function ($scope, $rootScope, $location) {

                console.log('left nav bar item ctrl', 'init');
                var vm = this;
                vm.scope_name = 'leftNavBarItemCtrl';
            }])
        ;

