let demandes = [];

/**
 * Initialisation de la page (récupération des demandes de l'utilisateur + affichage de la liste des demandes "En attente")
 */
function initialiser_affichage_demandes(){
    demandes = init_variable_liste_projets();
    getDemandesAvecEtat("En cours");
}

/**
 * Affichage de toutes les demandes de l'utilisateur à partir d'un état donné
 * @param etat - l'état sélectionné depuis l'interface utilisateur (valeurs : "En cours", "Terminée")
 */
function getDemandesAvecEtat(etat){
    let demandesAvecEtat = get_liste_projets_etat(demandes, etat);

    document.getElementById("liste_demandes").innerHTML = "";
    document.getElementById('informations_demande').hidden = true;
    document.getElementById('message_informatif').hidden = false;
    document.getElementById('message_erreur').hidden = true;
    document.getElementById('priorite').hidden = true;

    // Affichage des boutons associés aux demandes
    for (let demande in demandesAvecEtat){
        document.getElementById("liste_demandes").innerHTML += "<button id=\"" + demandesAvecEtat[demande].id + "\" class=\"bouton_liste w-100 btn btn-outline-primary\" type=\"button\" onclick=\"afficher_informations_demande('" + demandesAvecEtat[demande].id + "');\">" + demandesAvecEtat[demande].nom_projet + "</button>";
    }

    // Gestion des boutons "En attente", "En cours" et "Terminée"
    switch (etat) {
        case "En cours":
            document.getElementById("demande_EnCours").setAttribute("class","flex-sm-fill text-sm-center nav-link active");
            document.getElementById("demande_Terminee").setAttribute("class","flex-sm-fill text-sm-center nav-link");
            document.getElementById('bloc_suivi').hidden = false;
            document.getElementById('date_limite_info').hidden = false;
            document.getElementById('date_fin_info').hidden = true;
            break;
        case "Terminée":
            document.getElementById("demande_EnCours").setAttribute("class","flex-sm-fill text-sm-center nav-link");
            document.getElementById("demande_Terminee").setAttribute("class","flex-sm-fill text-sm-center nav-link active");
            document.getElementById('bloc_suivi').hidden = true;
            document.getElementById('date_limite_info').hidden = true;
            document.getElementById('date_fin_info').hidden = false;
            break;
    }
}

/**
 * Affichage de la description d'une demande à partir de son identifiant
 * @param id_demande identifiant de la demande
 */
function afficher_informations_demande(id_demande){
    demande = get_projet_id(demandes, id_demande);

    document.getElementById('message_informatif').hidden = true;
    document.getElementById('message_erreur').hidden = true;
    document.getElementById('priorite').hidden = true;

    if (demande) {
        document.getElementById('informations_demande').hidden = false;

        // On affiche les informations de la demande sur la partie droite
        document.getElementById('titre_projet').innerHTML = demande.nom_projet;
        document.getElementById('description_projet').innerHTML = demande.description_projet;
        desc1 = document.getElementById('description_projet');
        desc1.innerHTML = demande.description_projet;
        desc1.rows = countLines(desc1);
        document.getElementById('nom_demandeur').innerHTML = demande.nom;
        document.getElementById('prenom_demandeur').innerHTML = demande.prenom;
        document.getElementById('email_demandeur').innerHTML = demande.mail;
        document.getElementById('date_limite').innerHTML = demande.date_limite;
        is_demande_urgente(demande.date_limite);
        set_select_suivi_demande(demande.suivi);
        let bouton_mettre_a_jour_suivi = document.getElementById("mettre_a_jour_suivi");

        bouton_mettre_a_jour_suivi.onclick = function(e) {
            mettre_a_jour_suivi_demande(id_demande);
        }

        document.getElementById('date_debut').innerHTML = demande.date_debut;
        document.getElementById('date_fin').innerHTML = demande.date_fin;
    } else {
        document.getElementById('message_erreur').hidden = false;
    }

    // Gestion des boutons "active" ou non
    let boutons_demande = document.getElementsByClassName("bouton_liste");
    for (let i = 0; i < boutons_demande.length ; i++){
        if (boutons_demande[i].id === demande.id){
            boutons_demande[i].setAttribute("class","bouton_liste w-100 btn btn-outline-primary active");
        } else {
            boutons_demande[i].setAttribute("class","bouton_liste w-100 btn btn-outline-primary");
        }
    }
}

function set_select_suivi_demande(suivi_demande) {
    switch (suivi_demande) {
        case "Rédaction du cahier des charges":
            document.getElementById('suivi_info').options[0].selected = true;
            break;
        case "Étude et conception":
            document.getElementById('suivi_info').options[1].selected = true;
            break;
        case "Réalisation et fabrication":
            document.getElementById('suivi_info').options[2].selected = true;
            break;
        case "Montage":
            document.getElementById('suivi_info').options[3].selected = true;
            break;
        case "Livraison":
            document.getElementById('suivi_info').options[4].selected = true;
            break;
    }
}

/**
 * Vérifie s'il reste moins de 10 jours entre la date d'aujourd'hui et la date limite
 * @param date_limite la date limite de la demande
 */
function is_demande_urgente(date_limite) {
    date_limite = new Date(date_limite);
    let current_date = Date.now();
    let nb_jours_diff = Math.round((current_date - date_limite.getTime()) / (1000 * 3600 * 24));

    if (nb_jours_diff <= 10 && nb_jours_diff > 0) {
        document.getElementById('priorite').hidden = false;
    }
}

/**
 * Met à jour le suivi d'une demande et si le suivi à changer est "Terminée", l'état de la demande est aussi changé en "Terminée"
 * @param id_demande l'identifiant de la demande
 */
function mettre_a_jour_suivi_demande(id_demande) {
    let demande = get_projet_id(demandes, id_demande);
    let nouveau_statut = document.getElementById('suivi_info').selectedOptions[0].innerHTML;
    if (demande.suivi !== nouveau_statut) {
        let confirmation = confirm('Êtes vous sûr de changer le statut "'+ demande.suivi + '" par "' + nouveau_statut + '" pour la demande "' + demande.nom_projet + '" ?');
        if (confirmation) {
            modifier_suivi_demande(id_demande, nouveau_statut);
        }
    } else {
        confirm('Le nouveau statut doit être différent de l\'actuel ('+ demande.suivi + ') ');
    }
}

function countLines(theArea){
    var theLines = theArea.value.replace((new RegExp(".{"+theArea.cols+"}","g")),"\n").split("\n");
    while(theLines[theLines.length-1]=="") theLines.length--;
    return theLines.length;
  }