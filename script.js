

function get_from_php(thing_to_get, extra_param = "null"){
    value = null;
    req = new XMLHttpRequest(); 
        req.onload = function() {
        value = this.responseText; 
    };
    req.open("get", "get_"+thing_to_get+".php?extra="+extra_param, true); 
    req.send();
    return value;
}


function get_liste_projets(){
    return get_from_php("liste_projets");
}

function get_liste_projets_user(user){
    return get_from_php("liste_projets_user", user);
}

class Projet{
    constructor(projet){

    }
}

