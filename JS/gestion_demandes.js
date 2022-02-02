

/**
 * Send something to a given php file with POST method
 * @param {string} thing_to_get - The name of the php file to get the data from, without "send_" and ".php".
 * @param {string} extra - The extra parameter to send as php GET variable.
 * @return nothing
 */
 function send_to_php(thing_to_send, extra = "null"){
    fetch("send_"+thing_to_send+".php", {
        method: 'POST',
        headers: {'Content-Type':'application/x-www-form-urlencoded'},
        body: 'extra='+JSON.stringify(extra)
    });
}

/**
 * Get something from a given php file with GET method
 * @param {string} thing_to_get - The name of the php file to get the data from, without "get_" and ".php".
 * @param {string} extra - The extra parameter to send as php GET variable.
 * @return {JSON} - The data given from php, extracted from the database.
 */
 function get_from_php(thing_to_get, extra = "null"){
    var xmlHttp = new XMLHttpRequest();
    var result;
    xmlHttp.onreadystatechange = function() { 
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200){
            result = xmlHttp.responseText;
        }
    }
    xmlHttp.open("GET", "get_"+thing_to_get+".php?extra="+extra, false); // true for asynchronous 
    xmlHttp.send(null);
    return JSON.parse(result);
}

/*-----------------------------------------------------------
/* Fonctions d'itinialisation de l'appli:
/* L'une récup tous les projets (pour admin et opérateur)
/* L'autre seulement les projets de l'utilisateur
/* TODO: les fonctions d'initialisation doivent être sécurisée dans
/* une fonction immédiatement exécutée
/*-----------------------------------------------------------*/

/**
 * Get a list of ALL projects, not used for normal users interface, only operators and admins are concerned
 * @return all projects as json
 */
function get_liste_projets(){
    return get_from_php("liste_projets");
}

/**
 * Get a list of projects from a specific user
 * @param {string} - The CAS user name to get the projects from
 * @return all projects from given user
 */
function get_liste_projets_user(user){
    return get_from_php("liste_projets_user", user);
}

/*-----------------------------------------------------------
/* Fonctions utilisées 
/*-----------------------------------------------------------*/

/**
 * TODO: cette fonction n'est utilisée qu'une fois,
 * il serait optimale de la définir en exécution immédiate à l'avenir,
 * à l'endroit ou elle est utilisée
 * Envoie un nouveau projet sous forme d'objet projet
 * @param {Projet} - L'objet projet à envoyer
 * @return rien
 */
function envoie_nouveau_projet(projet){
    send_to_php("demande", projet);
}

projets = [];


/**
 * fonction qui récupère et range dans le tableau la liste des projets de tous les utilisateurs
 * Utile pour les admins et les operateurs
 */
function init_variable_liste_projets(){
    var les_propro = get_liste_projets();
    for(var projet in les_propro){
        console.log(JSON.stringify(les_propro[projet]));
        projets[les_propro[projet].id_demande] = new Projet(les_propro[projet]);
    }
}

/**
 * fonction qui récupère et range dans le tableau la liste des projets d'un seul utilisateur
 * Utile pour les demandeurs
 */
 function init_variable_liste_projets(user){
    var les_propro = get_liste_projets_user(user);
    for(var projet in les_propro){
        console.log(JSON.stringify(les_propro[projet]));
        projets[les_propro[projet].id_demande] = new Projet(les_propro[projet]);
    }
}

/**
 * Récupère toutes les demandes qui ont un état donné
 * @param {Enum} etat - L'état de la demande. Valeurs possibles:
 * "en attente de validation", "validée, en attente de fabrication", "en cours de fabrication", "terminée"
 * @returns La liste des demandes à l'état donné
 */
function get_liste_projets_etat(etat){
    var projets2 = [];
    var cpt = 0;
    for(var projet of projets){
        if(projets[projet].etat == etat) {
            projets2[cpt++] = projets[projet];
        }
    }
    return projets2;
}


/**
 * Récupère toutes les demandes qui ont un nom ou une personne donnée
 * @param {String} nom - Le nom ou une partie du nom d'un projet, d'une personne ou un login cas
 * @returns La liste des demandes contenant au moins une partie du nom donné
 */
 function get_liste_projets_nom(nom){
    var projets2 = [];
    var cpt = 0;
    for(var projet in projets){
        projet = projets[projet];
        if(projet.nom_projet.includes(nom) || projet.prenom.includes(nom)|| projet.nom.includes(nom)|| projet.login_cas.includes(nom)) {
            projets2[cpt++] = projet;
        }
    }
    return projets2;
}



class Projet{
    constructor(projet){
        this.id = projet.id_demande;
        this.login_cas = projet.login_cas;
        this.nom = projet.nom;
        this.prenom = projet.prenom;
        this.mail = projet.mail;
        this.groupe = projet.groupe;
        this.ufr = projet.UFR;
        this.nom_projet = projet.nom_projet;
        this.description_projet = projet.description_projet;
        this.date_limite = projet.date_limite;
        this.etat = projet.etat;
        this.date_fin = projet.date_fin;
        this.date_debut = projet.date_debut;
    }

}

//juste un exemple pour l'appli
ex_demande = new Projet(JSON.parse('{"0":"1","1":"s172746","2":"valentin","3":"Girod","4":"valentin@girod.fr","5":"etu","6":"science et technique","7":"idrm","8":"Interface de demande de réalisation mécaniqueBon là cest du dev, pas de la mécanique, donc projet à ignorer","9":"2022-01-17","10":"en attente de validation","11":null,"12":"0000-00-00","id_demande":"1","login_cas":"s172746","nom":"valentin","prenom":"Girod","mail":"valentin@girod.fr","groupe":"etu","UFR":"science et technique","nom_projet":"idrm","description_projet":"Interface de demande de réalisation mécaniqueBon là cest du dev, pas de la mécanique, donc projet à ignorer","date_limite":"2022-01-17","etat":"en attente de validation","date_fin":null,"date_debut":"0000-00-00"}'));


