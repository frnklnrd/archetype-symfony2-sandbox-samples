/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
angular.module("application.common", [])
        .service("api_authenticator", ['$rootScope', '$window', '$http', '$location', function ($rootScope, $window, $http, $location) {

                console.log('api_authenticator', 'init');

                $rootScope.isAuthenticated = false;
                delete $window.sessionStorage.token;
                delete $window.sessionStorage.refresh_token;

                // authenticating user

                $rootScope.login = function () {
                    console.log('api login check', 'trying login');
                    $rootScope.user = {username: prompt('User', 'superadmin'), password: prompt('Password', 'superadmin')};
                    $rootScope.showAjaxLoader('Trying login. Please wait...');
                    $http({
                        method: 'POST',
                        url: Routing.generate('api_login_check', {}, true),
                        data: $.param($rootScope.user),
                        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                    }).then(
                            function (response) {
                                console.log('api login check', 'login successfully');
                                console.log(response.data);
                                $rootScope.hideAjaxLoader();
                                $window.sessionStorage.token = response.data.token;
                                $window.sessionStorage.refresh_token = response.data.refresh_token;
                                $rootScope.isAuthenticated = true;
                                //Authorization: Bearer {token}
                                alert('Ok. Login successfully');
                                $location.path('/');
                                //$window.history.back();
                            },
                            function (response) {
                                console.log('api login check', 'login error');
                                console.log(response.data);
                                $rootScope.hideAjaxLoader();
                                $rootScope.isAuthenticated = false;
                                delete $window.sessionStorage.token;
                                delete $window.sessionStorage.refresh_token;
                                alert('Error. ' + response.data.message);
                                $location.path('/');
                                //$window.history.back();
                            }
                    );
                }

                $rootScope.token_refresh = function () {
                    console.log('api token refresh', 'trying refresh');
                    $rootScope.showAjaxLoader('Refreshing token. Please wait...');
                    $http({
                        method: 'POST',
                        url: Routing.generate('api_token_refresh', {}, true),
                        data: $.param({refresh_token: $window.sessionStorage.refresh_token}),
                        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                    }).then(
                            function (response) {
                                console.log('api token refresh', 'refresh token successfully');
                                console.log(response.data);
                                $rootScope.hideAjaxLoader();
                                $window.sessionStorage.token = response.data.token;
                                $window.sessionStorage.refresh_token = response.data.refresh_token;
                                $rootScope.isAuthenticated = true;
                                //Authorization: Bearer {token}
                                alert('Ok. Token refreshed successfully');
                                $location.path('/');
                                //$window.history.back();
                            },
                            function (response) {
                                console.log('api token refresh', 'token refresh error');
                                console.log(response.data);
                                $rootScope.hideAjaxLoader();
                                $rootScope.isAuthenticated = false;
                                delete $window.sessionStorage.token;
                                delete $window.sessionStorage.refresh_token;
                                alert('Error. ' + response.data.message);
                                $location.path('/');
                                //$window.history.back();
                            }
                    );
                }

                // logout management
                $rootScope.logout = function () {
                    $rootScope.isAuthenticated = false;
                    delete $window.sessionStorage.token;
                    alert('Ok. Logout successfully');
                    $location.path('/');
                    //$window.history.back();
                };

            }])
        .component("ajaxLoader", {
            template:
                    [
                        '<div class="ajax-loader" style="display:{{$ctrl.show?\'block\':\'none\'}};background: rgba(0,0,0,0.5);height: 100%;left: 0;position: fixed;top: 0;width: 100%;z-index: 9999;cursor:progress;">',
                        '<div style="width:450px; height: 70px; margin-top: 200px; margin-left: auto; margin-right:auto;text-align:center">',
                        '<span style="color: #ffffff;font-size: 22px;">',
                        '<img src="/assets/img/ajax-wait.gif" style="margin-bottom:2px;width: 25px;">',
                        '<strong>&nbsp;&nbsp;{{$ctrl.message?$ctrl.message:"Please, wait ..."}}</strong></span>',
                        '</span>',
                        '</div>',
                        '</div>'
                    ].join('')
            ,
            controller: ['$scope', '$rootScope', function ($scope, $rootScope) {
                    console.log('ajax loader', 'init');
                    var vm = this;
                    vm.name = 'ajax loader scope';

                    // preparing ajax loader

                    $rootScope.ajaxloader = {
                        loading: false,
                        message: 'Please, wait ...'
                    };

                    $rootScope.showAjaxLoader = function (message) {
                        console.log('ajax loading', 'show');
                        $rootScope.ajaxloader.loading = true;
                        $rootScope.ajaxloader.message = message ? message : 'Please, wait ...';
                    }
                    $rootScope.hideAjaxLoader = function () {
                        console.log('ajax loading', 'hide');
                        $rootScope.ajaxloader.loading = false;
                        $rootScope.ajaxloader.message = 'Please, wait ...';
                    }

                }],
            bindings: {// components parameters
                show: "=",
                message: "="
            }
        })
        .component("tablePaginated", {
            templateUrl: '/bundles/samplescompany/templates/table-paginated.html',
            controller: ['$scope', '$rootScope', '$http', function ($scope, $rootScope, $http) {
                    console.log('table paginated', 'init');
                    var vm = this;
                    vm.fields_descriptions = JSON.parse(vm.fields);
                    vm.actions_descriptions = JSON.parse(vm.actions);

                    vm.run = function () {
                        console.log('table paginated', 'run');
                        vm.load(null);
                    };
                    vm.load = function (page) {
                        if (page == null || undefined == page)
                        {
                            page = Routing.generate(vm.route, {page: 1, limit: vm.limit}, true);
                        }
                        //page = page+ '&_format=json';
                        console.log('table paginated', 'loading data from: ' + page);
                        $rootScope.showAjaxLoader('Loading data. Please, wait ...');
                        $http({
                            method: 'GET',
                            url: page,
                            headers: {
                                //'Accept': 'application/json'
                            }
                        }).then(
                                function (response) { // success actions
                                    console.log('table paginated', 'data loaded');
                                    $rootScope.hideAjaxLoader();
                                    vm.page = response.data.page;
                                    vm.limit = response.data.limit;
                                    vm.total = response.data.total;
                                    vm.links = response.data._links;
                                    vm.items = response.data._embedded.items;
                                },
                                function (response) { // error actions
                                    console.log('table paginated', 'data error');
                                    $rootScope.hideAjaxLoader();
                                    alert(response.data.message); // TODO show message
                                }
                        );
                    };
                    vm.getFieldValue = function (item, field) {
                        var parts = field.split('.');
                        var value = item;
                        for (var i = 0; i < parts.length; i++)
                        {
                            value = value[parts[i]];
                        }
                        return value;
                    }
                    vm.run();
                }],
            bindings: {// components parameters
                route: "@",
                page: "@",
                limit: "@",
                fields: "@",
                actions: "@",
                actionshandler: "=",
            }
        })
        ;

