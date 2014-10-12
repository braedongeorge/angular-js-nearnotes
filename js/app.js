(function() {
  var app = angular.module('nearNotes', ['dropstore-ng', 'LocalStorageModule']);

  app.config(['localStorageServiceProvider', function(localStorageServiceProvider){
    localStorageServiceProvider.setPrefix('demoPrefix');
  // localStorageServiceProvider.setStorageCookieDomain('example.com');
  localStorageServiceProvider.setStorageType('sessionStorage');
}]);


  app.controller('NotesController', ['$scope','dropstoreClient', 'localStorageService', function($scope, dropstoreClient, localStorageService) {
    $scope.noteLoaded = false;
    $scope.tasks = [];

    if (!Dropbox.Datastore.isValidId(localStorageService.get('datastoreid'))) {
      localStorageService.clearAll();
    }

    if ( localStorageService.get('datastoreid') ) {
     $scope.datastoreId = localStorageService.get('datastoreid');

   } else {
     $scope.datastoreId = window.location.href.match(/#(.*)/)[1];
     localStorageService.set('datastoreid',  $scope.datastoreId);
   }
   


 $scope.dropboxRun = function() {
  dropstoreClient.create(dropstoreKey)
 .authenticate({interactive: true})
 .then(function(datastoreManager){
  console.log('completed authentication');
  return datastoreManager.openDatastore($scope.datastoreId);
}, function(error){
            console.log('auth failure');
            $scope.dropboxRun();
        }).then(function(datastore){
  $scope.noteLoaded = true;
  var taskTable = datastore.getTable('notes');
  $scope.tasks =  taskTable.query();
  $scope.bodyText = $scope.tasks[0].get('body');
  $scope.titleText = $scope.tasks[0].get('title');

}, function(error){
            console.log('datastore failure');
        });


};


$scope.dropboxRun();




}]);

  



})();