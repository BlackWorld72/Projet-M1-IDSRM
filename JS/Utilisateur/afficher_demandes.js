let demandes = [];

/**
 * Initialisation de la page (récupération des demandes de l'utilisateur + affichage de la liste des demandes "En attente")
 */
function initialiser_affichage_demandes(idDemandeur){
    demandes = init_variable_liste_projets(idDemandeur);
    //demandes = init_variable_liste_projets('s172746');       // test en local
    getDemandesAvecEtat("En attente");
}

/**
 * Affichage de toutes les demandes de l'utilisateur à partir d'un état donné
 * @param etat - l'état sélectionné depuis l'interface utilisateur (valeurs : "En attente", "En cours", "Terminée")
 */
function getDemandesAvecEtat(etat){
    let demandesAvecEtat = get_liste_projets_etat(demandes, etat);

    document.getElementById("liste_demandes").innerHTML = "";
    document.getElementById('informations_demande').hidden = true;
    document.getElementById('message_informatif').hidden = false;
    document.getElementById('message_erreur').hidden = true;

    // Affichage des boutons associés aux demandes
    for (let demande in demandesAvecEtat){
        document.getElementById("liste_demandes").innerHTML += "<button id=\"" + demandesAvecEtat[demande].id + "\" class=\"bouton_demande w-100 btn btn-outline-primary\" type=\"button\" onclick=\"afficher_informations_demande('" + demandesAvecEtat[demande].id + "');\">" + demandesAvecEtat[demande].nom_projet + "</button>";
    }

    // Gestion des boutons "En attente", "En cours" et "Terminée"
    switch (etat) {
        case "En attente":
            document.getElementById("demande_EnAttente").setAttribute("class","flex-sm-fill text-sm-center nav-link active");
            document.getElementById("demande_EnCours").setAttribute("class","flex-sm-fill text-sm-center nav-link");
            document.getElementById("demande_Terminee").setAttribute("class","flex-sm-fill text-sm-center nav-link");
            document.getElementById('suivi_info').hidden = false;
            document.getElementById('boutons_gestion_demande').hidden = false;
            document.getElementById('date_limite_info').hidden = false;
            document.getElementById('date_fin_info').hidden = true;
            break;
        case "En cours":
            document.getElementById("demande_EnAttente").setAttribute("class","flex-sm-fill text-sm-center nav-link");
            document.getElementById("demande_EnCours").setAttribute("class","flex-sm-fill text-sm-center nav-link active");
            document.getElementById("demande_Terminee").setAttribute("class","flex-sm-fill text-sm-center nav-link");
            document.getElementById('suivi_info').hidden = false;
            document.getElementById('boutons_gestion_demande').hidden = true;
            document.getElementById('date_limite_info').hidden = false;
            document.getElementById('date_fin_info').hidden = true;
            break;
        case "Terminée":
            document.getElementById("demande_EnAttente").setAttribute("class","flex-sm-fill text-sm-center nav-link");
            document.getElementById("demande_EnCours").setAttribute("class","flex-sm-fill text-sm-center nav-link");
            document.getElementById("demande_Terminee").setAttribute("class","flex-sm-fill text-sm-center nav-link active");
            document.getElementById('suivi_info').hidden = true;
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

    if (demande) {
        document.getElementById('informations_demande').hidden = false;

        // On affiche les informations de la demande sur la partie droite
        document.getElementById('titre_projet').innerHTML = demande.nom_projet;
        document.getElementById('description_projet').innerHTML = demande.description_projet;
        //document.getElementById('nom_demandeur').innerHTML = demande.nom;
        //document.getElementById('prenom_demandeur').innerHTML = demande.prenom;
        //document.getElementById('email_demandeur').innerHTML = demande.mail;
        document.getElementById('date_limite').innerHTML = demande.date_limite;
        document.getElementById('suivi').innerHTML = demande.suivi;
        document.getElementById('date_debut').innerHTML = demande.date_debut;
        document.getElementById('date_fin').innerHTML = demande.date_fin;
    } else {
        document.getElementById('message_erreur').hidden = false;
    }

    // Gestion des boutons "active" ou non
    let boutons_demande = document.getElementsByClassName("bouton_demande");
    for (let i = 0; i < boutons_demande.length ; i++){
        if (boutons_demande[i].id === demande.id){
            boutons_demande[i].setAttribute("class","bouton_demande w-100 btn btn-outline-primary active");
        } else {
            boutons_demande[i].setAttribute("class","bouton_demande w-100 btn btn-outline-primary");
        }
    }
}