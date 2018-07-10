/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
angular.module("application.workers", ["application.common"])
        .controller("workersCRUDCtrl", ["$scope", "$rootScope", "$http", function ($scope, $rootScope, $http) {
                console.log('workersCtrl', 'init');
                var vm = this;
                vm.modal = {
                    id: 'workers-crud-modal'
                };
                $rootScope.showAjaxLoader();

                vm.execute = function (action, route, callback_ctrl, callback_page) {

                    console.log('workers ctrl', 'execute ' + action + ' on: ' + route);

                    switch (action)
                    {
                        case 'show':
                            console.log('workers ctrl', 'looking for ' + route);
                            $rootScope.showAjaxLoader('Searching item. Please, wait ...');
                            $http.get(route + '?_format=html')
                                    .then(
                                            function (response) {
                                                console.log('workers ctrl', 'response sucessful');
                                                vm.modal.title = 'Show item data';
                                                vm.modal.hidesubmitbutton = true;
                                                $rootScope.hideAjaxLoader();
                                                $('#' + vm.modal.id + '-body').html(response.data);
                                                $('#' + vm.modal.id).modal('show');
                                            },
                                            function (response) {
                                                console.log('workers ctrl', 'response error');
                                                alert(response.data.message);
                                                $rootScope.hideAjaxLoader();
                                            }
                                    );
                            break;
                        case 'edit':
                            console.log('workers ctrl', 'looking for ' + route);
                            $rootScope.showAjaxLoader('Searching item. Please, wait ...');
                            vm.modal.resource = route;
                            vm.modal.method = 'put';
                            vm.modal.callback_ctrl = callback_ctrl;
                            vm.modal.callback_page = callback_page;
                            $http.put(route + '?_format=html')
                                    .then(
                                            function (response) {
                                                console.log('workers ctrl', 'response sucessful');
                                                vm.modal.title = 'Edit item data';
                                                vm.modal.hidesubmitbutton = false;
                                                $rootScope.hideAjaxLoader();
                                                $('#' + vm.modal.id + '-body').html(response.data);
                                                $('#' + vm.modal.id).modal('show');
                                            },
                                            function (response) {
                                                console.log('workers ctrl', 'response error');
                                                vm.modal.title = 'Edit item data';
                                                vm.modal.hidesubmitbutton = false;
                                                $rootScope.hideAjaxLoader();
                                                $('#' + vm.modal.id + '-body').html(response.data);
                                                $('#' + vm.modal.id).modal('show');
                                            }
                                    );
                            break;

                        case 'delete':
                            if (confirm('Are you sure you want delete this item?'))
                            {
                                console.log('workers ctrl', 'deleting at' + route);
                                $rootScope.showAjaxLoader('Deleting item. Please, wait ...');
                                $http.delete(route + '?_format=json')
                                        .then(
                                                function (response) {
                                                    console.log('workers ctrl', 'response sucessful');
                                                    alert('Item deleted');
                                                    $rootScope.hideAjaxLoader();
                                                    callback_ctrl(callback_page);
                                                },
                                                function (response) {
                                                    console.log('workers ctrl', 'response error');
                                                    alert(response.data.message);
                                                    $rootScope.hideAjaxLoader();
                                                }
                                        );
                            }
                            break;
                        default:
                            alert('operation not allowed');
                            break;

                    }
                };
                vm.submitForm = function () {

                    console.log('workers ctrl', 'submitting put data');

                    var formData = $('#' + vm.modal.id + ' form').serialize();

                    $rootScope.showAjaxLoader('Submiting data. Please, wait ...');

                    //$http.put(vm.modal.resource + '?_format=html', formData)
                    $http({
                        method: 'PUT',
                        url: vm.modal.resource + '?_format=html',
                        data: formData,
                        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                    }).then(
                            function (response) {
                                console.log('workers ctrl', 'submitted put data');
                                $rootScope.hideAjaxLoader();
                                $('#' + vm.modal.id + '-body').html(response.data);
                                $('#' + vm.modal.id).modal('hide');
                                vm.modal.callback_ctrl(vm.modal.callback_page);
                            },
                            function (response) {
                                console.log('workers ctrl', 'response error');
                                $rootScope.hideAjaxLoader();
                                $('#' + vm.modal.id + '-body').html(response.data);
                            }
                    );
                }

            }])
        ;

