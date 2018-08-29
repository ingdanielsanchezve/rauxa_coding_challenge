'use strict';

app.controller('searchController', ['$scope', '$http', 'GitHub',
                          function ($scope, $http, GitHub) {

    var sec = $scope;
        sec.pages = 0;
        sec.followers = [];        
        sec.searching = false;
        sec.searchingFollowers = false;
        sec.maxPages = 16;
        sec.pagesShown = 16;
        sec.actualPage = 0;
        sec.err = '';

    sec.searchGitHub = function() {      
        
        sec.searching = true;
        sec.clearData();
        GitHub.get(sec.username)
              .then(function (response) {
                    sec.searching = false;
                    if ('user' in response.data) {                        
                        sec.user      = response.data.user;
                        sec.followers = response.data.followers;
                        sec.totPages  = response.data.pages;
                        sec.pages     = (response.data.pages > sec.maxPages) ? sec.maxPages : response.data.pages;
                        sec.err       = '';
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

    sec.getMoreFollowersPages = function(){
        sec.pagesShown++;
        sec.getFollowers(sec.pagesShown);
    }

    sec.getFollowers = function (page) {
        sec.searchingFollowers = true;
        sec.followers = '';
        GitHub.getFollowers(sec.username, page)
            .then(function (response) {
                sec.searchingFollowers = false;
                sec.followers = response.data.followers;
            });
    };
    
}]);