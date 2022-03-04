/**
 * Send something to a given php file with POST method
 * @param {string} thing_to_get - The name of the php file to get the data from, without "send_" and ".php".
 * @param {string} extra - The extra parameter to send as php GET variable.
 * @return nothing
 */
 function send_to_php(thing_to_send, extra = "null"){
    fetch("/Projet-M1-IDSRM/PHP/send_"+thing_to_send+".php", {
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
    xmlHttp.open("GET", "/Projet-M1-IDSRM/PHP/get_"+thing_to_get+".php?extra="+extra, false); // true for asynchronous 
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
    for(var projet in projets){
        projet = projets[projet];
        if(projet.etat == etat) {
            projets2[cpt++] = projet;
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
        this.etat = projet.etat_demande;
        this.date_fin = projet.date_fin;
        this.date_debut = projet.date_debut;
        this.suivi = projet.suivi_demande;
    }

}

function lister_projets(etat){
    projets2 = get_liste_projets_etat(etat);
    liste_projets = document.querySelector('#liste_demandes');
    html_liste = "";
    for(var index in projets2){
        projet = projets2[index];
        console.log(projet);
        html_liste += '<button class="bouton_liste_demandes w-100 btn btn-outline-primary" type="button" onclick="afficher_infos_projet('+index+', \''+etat+'\')">'+projet.nom_projet+" - "+projet.date_debut+"</button>";
    }
    liste_projets.innerHTML = html_liste;
}

function afficher_infos_projet(index_projet, etat){
    projets2 = get_liste_projets_etat(etat);
    projet = projets2[index_projet];
    document.querySelector('#description').innerHTML=projet.description_projet;
    document.querySelector('#date_limite').innerHTML=projet.date_limite;
}


