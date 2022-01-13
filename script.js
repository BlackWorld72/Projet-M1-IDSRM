

function get_from_php(thing_to_get, extra = "null"){
    value = null;
    req = new XMLHttpRequest(); 
        req.onload = function() {
        value = this.responseText; 
        console.log(value);
    };
    req.open("get", "get_"+thing_to_get+".php?extra="+extra, true); 
    req.send();
    return value;
}


function get_liste_projets(){
    return get_from_php("liste_projets");
}

function get_liste_projets_user(user){
    return get_from_php("liste_projets_user", user);
}


projets = [];

class Projet{
    constructor(projet){

    }
}

