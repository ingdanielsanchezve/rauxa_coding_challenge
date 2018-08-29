'use strict';

app.service('GitHub', function($http) {
    
    this.similars = function(area, id){

        return $http.get(ServerDestino + "offers/similars/3/" + area + "/" + id);

    }
    
    this.mostrecent = function(){

        return $http.get(ServerDestino + "offers/mostrecent");

    }
    
    this.listAll = function(){

        return $http.get(ServerDestino + "offers/all");

    }
    
    this.countAll = function(){

        return $http.get(ServerDestino + "offers/count/all");

    }
    
    this.filterBy = function(term){

        return $http.get(ServerDestino + "offers/by/"+term);

    }

    this.show = function(id){

        return $http.get(ServerDestino + "offers/" + id)

    }

    this.create = function(data){

        return $http.post(ServerDestino + "offers", data);

    }

    this.edit = function(id, data){

        return $http.put(ServerDestino + "offers/"+id, data);

    }

    this.remove = function(id){

        return $http.delete(ServerDestino + 'offers/'+id)

    }

    this.pause = function(id){

        return $http.post(ServerDestino + 'offers/status/'+id+'/pause')

    }

    this.active = function(id){

        return $http.post(ServerDestino + 'offers/status/'+id+'/active')

    }



});