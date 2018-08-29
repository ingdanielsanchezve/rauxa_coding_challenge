'use strict';

app.controller('searchController', ['$scope', '$http', 'GitHub',
                          function ($scope, $http, GitHub) {

    var sec = $scope;
        sec.pages = 0;
        sec.followers = [];        
        sec.searching = false;

    sec.searchGitHub = function() {      
        
        sec.searching = true;
        sec.clearData();
        GitHub.get(sec.username)
              .then(function (response) {
                    sec.searching = false;
                    if ('user' in response.data) {                        
                        sec.user = response.data.user;
                        sec.followers = response.data.followers;
                        sec.pages = response.data.pages;
                    }else{
                        sec.err = response.data;
                        sec.clearData();
                    }

        });
    }

    sec.clearData = function () {
        sec.user = '';
        sec.followers = '';
        sec.pages = 0;
    }

    sec.searchGitHubSelected = function(user) {
        
        sec.username = user;
        sec.searchGitHub();
    }


    sec.searchGitHubEnter = function (keyEvent) {
        if (keyEvent.which === 13)
            sec.searchGitHubSelected(sec.username);
    }

    sec.getFollowers = function (page) {
        sec.searching = true;
        GitHub.getFollowers(sec.username, page)
            .then(function (response) {
                sec.searching = false;
                sec.followers = response.data.followers;
            });
    };
    
}]);