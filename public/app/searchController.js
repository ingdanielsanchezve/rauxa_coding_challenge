'use strict';

app.controller('searchController', ['$scope', '$http', 'GitHub',
                          function ($scope, $http, GitHub) {

    var sec = $scope;
        sec.pages = 0;
        sec.followers = [];        
        sec.searching = false;
        sec.searchingFollowers = false;
        sec.maxPages = 10;
        sec.pagesShown = 10;
        sec.firstPage = 1;
        sec.err = '';

    sec.range = function () {
            var input = [];
            sec.paginatorPages = (sec.pagesShown > sec.maxPages) ? sec.pagesShown : sec.pages;
            for (var i = sec.firstPage; i <= sec.paginatorPages; i++) {
                input.push(i);
            }
            return input;
    };

    sec.searchGitHub = function() {      
        
        if (typeof sec.username != 'undefined') {
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
    }

    sec.getGitHubUser = function() {        
        GitHub.getUser()
            .then(function (response) {                        
                sec.gitHubUser = response.data.user;
        });
    }

    sec.clearData = function () {
        sec.user = '';
        sec.followers = '';
        sec.pages = 0;
        sec.pagesShown = 10;
    }

    sec.searchGitHubSelected = function(user) {
        
        sec.username = user;
        sec.searchGitHub();
    }


    sec.searchGitHubEnter = function (keyEvent) {
        if (keyEvent.which === 13){
            if (typeof sec.username != 'undefined'){
                sec.searchGitHubSelected(sec.username);
            }else{
                sec.searchForm.username.$invalid = true;
            }
        }
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