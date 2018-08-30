'use strict';

app.service('GitHub', function($http) {

    this.getUser = function(){

        return $http.get("user");

    }

    this.get = function(user){

        return $http.get("search/" + user);

    }

    this.getFollowers = function(user, page){

        return $http.get("followers/" + user + "/" + page);

    }

});