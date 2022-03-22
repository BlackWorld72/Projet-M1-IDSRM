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
 * @param etat - l'état sélectionné depuis l'interface utilisateur (valeurs : "En attente", "En cours")
 */
function getDemandesAvecEtat(etat){
    let demandesAvecEtat = get_liste_projets_etat(demandes, etat);

    document.getElementById("liste_demandes").innerHTML = "";
    document.getElementById("zone_prise_rdv").hidden = true;
    document.getElementById("message_informatif").hidden = false;

    // Affichage des boutons associés aux demandes
    for (let demande in demandesAvecEtat){
        document.getElementById("liste_demandes").innerHTML += "<button id=\"" + demandesAvecEtat[demande].id + "\" class=\"bouton_liste w-100 btn btn-outline-primary\" type=\"button\" onclick=\"afficher_prise_rdv('" + demandesAvecEtat[demande].id + "');\">" + demandesAvecEtat[demande].nom_projet + " - " + demandesAvecEtat[demande].suivi + "</button>";
    }

    // Gestion des boutons "En attente" et "En cours"
    switch (etat) {
        case "En attente":
            document.getElementById("demande_EnAttente").setAttribute("class","flex-sm-fill text-sm-center nav-link active");
            document.getElementById("demande_EnCours").setAttribute("class","flex-sm-fill text-sm-center nav-link");
            break;
        case "En cours":
            document.getElementById("demande_EnAttente").setAttribute("class","flex-sm-fill text-sm-center nav-link");
            document.getElementById("demande_EnCours").setAttribute("class","flex-sm-fill text-sm-center nav-link active");
            break;
    }
}

/**
 * Affichage de la zone "Prise de rendez-vous"
 * @param id_demande identifiant de la demande
 */
function afficher_prise_rdv(id_demande){
    let demande = get_projet_id(demandes, id_demande);

    document.getElementById('message_informatif').hidden = true;
    document.getElementById('zone_prise_rdv').hidden = false;

    document.getElementById("rediger_mail").innerHTML = "Bonjour,\n" +
        "\n" +
        "Je souhaiterais ajouter de nouvelles informations pour la création de ma pièce. Serait-il possible de convenir ensemble d'un rendez-vous ?\n" +
        "\n" +
        "Bien cordialement,\n" +
        "\n" + demande.prenom + " " + demande.nom;


    // Gestion des boutons "active" ou non
    let boutons_demande = document.getElementsByClassName("bouton_liste");
    for (let i = 0; i < boutons_demande.length ; i++){
        if (boutons_demande[i].id === demande.id){
            boutons_demande[i].setAttribute("class","bouton_liste w-100 btn btn-outline-primary active");
        } else {
            boutons_demande[i].setAttribute("class","bouton_liste w-100 btn btn-outline-primary");
        }
    }

    let bouton_envoyer_mail = document.getElementById("envoyer_prise_rdv");

    bouton_envoyer_mail.onclick = function(e) {
        envoyer_mail_demande_rdv(id_demande);
    }
}

function envoyer_mail_demande_rdv(id_demande) {
    let confirmation = confirm('Êtes vous sûr d\'envoyer ce mail pour la demande ' + get_projet_id(demandes, id_demande).nom_projet + ' ?');
    if (confirmation) {
        // TODO
    }
}