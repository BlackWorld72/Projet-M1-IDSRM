let demandes = [];

/**
 * Initialisation de la page (récupération des demandes de l'utilisateur + affichage de la liste des demandes "En attente")
 */
function initialiser_affichage_demandes(id_demandeur){
    demandes = init_variable_liste_projets();
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
    document.getElementById('priorite').hidden = true;


    // Affichage des boutons associés aux demandes
    for (let demande in demandesAvecEtat){
        document.getElementById("liste_demandes").innerHTML += "<button id=\"" + demandesAvecEtat[demande].id + "\" class=\"bouton_liste w-100 btn btn-outline-primary\" type=\"button\" onclick=\"afficher_informations_demande('" + demandesAvecEtat[demande].id + "');\">" + demandesAvecEtat[demande].nom_projet + "</button>";
    }

    // Gestion des boutons "En attente", "En cours" et "Terminée"
    switch (etat) {
        case "En attente":
            document.getElementById("demande_EnAttente").setAttribute("class","flex-sm-fill text-sm-center nav-link active");
            document.getElementById("demande_EnCours").setAttribute("class","flex-sm-fill text-sm-center nav-link");
            document.getElementById("demande_Terminee").setAttribute("class","flex-sm-fill text-sm-center nav-link");
            document.getElementById('bloc_suivi').hidden = false;
            document.getElementById('bloc_suivi_en_attente').hidden = false;
            document.getElementById('bloc_suivi_en_cours').hidden = true;
            document.getElementById('boutons_gestion_demande').hidden = false;
            document.getElementById('date_limite_info').hidden = false;
            document.getElementById('date_fin_info').hidden = true;
            document.getElementById('demander_prise_rdv').hidden = false;
            break;
        case "En cours":
            document.getElementById("demande_EnAttente").setAttribute("class","flex-sm-fill text-sm-center nav-link");
            document.getElementById("demande_EnCours").setAttribute("class","flex-sm-fill text-sm-center nav-link active");
            document.getElementById("demande_Terminee").setAttribute("class","flex-sm-fill text-sm-center nav-link");
            document.getElementById('bloc_suivi').hidden = false;
            document.getElementById('bloc_suivi_en_attente').hidden = true;
            document.getElementById('bloc_suivi_en_cours').hidden = false;
            document.getElementById('boutons_gestion_demande').hidden = false;
            document.getElementById('date_limite_info').hidden = false;
            document.getElementById('date_fin_info').hidden = true;
            document.getElementById('demander_prise_rdv').hidden = false;
            break;
        case "Terminée":
            document.getElementById("demande_EnAttente").setAttribute("class","flex-sm-fill text-sm-center nav-link");
            document.getElementById("demande_EnCours").setAttribute("class","flex-sm-fill text-sm-center nav-link");
            document.getElementById("demande_Terminee").setAttribute("class","flex-sm-fill text-sm-center nav-link active");
            document.getElementById('bloc_suivi').hidden = true;
            document.getElementById('boutons_gestion_demande').hidden = true;
            document.getElementById('date_limite_info').hidden = true;
            document.getElementById('date_fin_info').hidden = false;
            document.getElementById('demander_prise_rdv').hidden = true;
            break;
    }
}

/**
 * Affichage de la description d'une demande à partir de son identifiant
 * @param id_demande identifiant de la demande
 */
function afficher_informations_demande(id_demande){
    let demande = get_projet_id(demandes, id_demande);

    document.getElementById('message_informatif').hidden = true;
    document.getElementById('message_erreur').hidden = true;
    document.getElementById('priorite').hidden = true;

    if (demande) {
        document.getElementById('informations_demande').hidden = false;

        // On affiche les informations de la demande sur la partie droite
        document.getElementById('titre_projet').innerHTML = demande.nom_projet;
        desc1 = document.getElementById('description_projet');
        desc1.innerHTML = demande.description_projet;
        desc1.rows = countLines(desc1);
        document.getElementById('nom_demandeur').innerHTML = demande.nom;
        document.getElementById('prenom_demandeur').innerHTML = demande.prenom;
        document.getElementById('email_demandeur').innerHTML = demande.mail;
        document.getElementById('date_limite').innerHTML = demande.date_limite;
        is_demande_urgente(demande.date_limite);

        if (demande.etat === "En attente") {
            document.getElementById('suivi_en_attente_valid').innerHTML = demande.suivi;
            let bouton_valider_piece = document.getElementById("valider_piece");

            bouton_valider_piece.onclick = function(e) {
                valider_demande(id_demande);
            }
        } else if (demande.etat === "En cours") {
            set_select_suivi_demande(demande.suivi);
            let bouton_mettre_a_jour_suivi = document.getElementById("mettre_a_jour_suivi");

            bouton_mettre_a_jour_suivi.onclick = function(e) {
                mettre_a_jour_suivi_demande(id_demande);
            }
        }

        document.getElementById('date_debut').innerHTML = demande.date_debut;
        document.getElementById('date_fin').innerHTML = demande.date_fin;
        download_files(id_demande, demande.login_cas)  
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

    if (demande.etat === "En attente" || demande.etat === "En cours") {
        let bouton_demander_mail = document.getElementById("demander_prise_rdv");

        bouton_demander_mail.onclick = function(e) {
            afficher_prise_rdv([demande.prenom, demande.nom]);

            let bouton_annuler_envoi_mail = document.getElementById("annuler_prise_rdv");

            bouton_annuler_envoi_mail.onclick = function(e) {
                enlever_prise_rdv();
            }

            let bouton_envoyer_mail = document.getElementById("envoyer_prise_rdv");

            bouton_envoyer_mail.onclick = function(e) {
                envoyer_mail_demande_rdv(id_demande);
            }
        }

    }
}

function cancel_modify_demande() {
    document.getElementById("modify_block").setAttribute("style","visibility: hidden; display:none;")
    document.getElementById("informations_demande").setAttribute("style","visibility: show; display:block;")
}

function modify_demande() {
    document.getElementById("modify_block").setAttribute("style","visibility: show; display:block;")
    document.getElementById("informations_demande").setAttribute("style","visibility: hidden; display:none;")
}

function download_files(id_demande, login_cas) {
    $.ajax({
        url: '/Projet-M1-IDSRM/PHP/get_files.php',
        type: 'POST',
        data: {id_demande:id_demande, login_cas:login_cas},
        contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
        success: function(response) {
            d = document.getElementById("download_button")
            if (response != -1) {
                document.getElementById("btn_dl_files").disabled = false;
                document.getElementById("btn_dl_files").innerHTML = '<a id="download_button" download="fichiers.zip"><button id="btn_dl_files" type="button" class="smaller-btn"><span class="btn-label"><i class="fa fa-download"></i></span> Télécharger les fichiers</button></a>'
                d.setAttribute("href", response)
            }
            else {
                document.getElementById("btn_dl_files").disabled = true;
                document.getElementById("btn_dl_files").innerHTML = "Aucun fichier"
                d.setAttribute("href", "")
            }
        }
    });
}

function set_select_suivi_demande(suivi_demande) {
    switch (suivi_demande) {
        case "Rédaction du cahier des charges":
            document.getElementById('suivi_select').options[0].selected = true;
            break;
        case "Étude et conception":
            document.getElementById('suivi_select').options[1].selected = true;
            break;
        case "Réalisation et fabrication":
            document.getElementById('suivi_select').options[2].selected = true;
            break;
        case "Montage":
            document.getElementById('suivi_select').options[3].selected = true;
            break;
        case "Livraison":
            document.getElementById('suivi_select').options[4].selected = true;
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
    let nouveau_statut = document.getElementById('suivi_select').selectedOptions[0].innerHTML;
    if (demande.suivi !== nouveau_statut) {
        let confirmation = confirm('Êtes vous sûr de changer le statut "'+ demande.suivi + '" par "' + nouveau_statut + '" pour la demande "' + get_projet_id(demandes, id_demande).nom_projet + '" ?');
        if (confirmation) {
            modifier_suivi_demande(id_demande, nouveau_statut);
        }
    } else {
        confirm('Le nouveau statut doit être différent de l\'actuel ('+ demande.suivi + ') ');
    }
}

/**
 * Valide une demande, le suivi passe de "En attente de validation" à "Rédaction du cahier des charges",
 * et l'état de "En attente" à "En cours"
 * @param id_demande l'identifiant de la demande
 */
function valider_demande(id_demande) {
    let demande = get_projet_id(demandes, id_demande);
    let confirmation = confirm('Êtes vous sûr de valider la demande "' + demande.nom_projet + '" ?');
    if (confirmation) {
        modifier_suivi_demande(id_demande, "Rédaction du cahier des charges", "En cours");
    }
}

/**
 * Affichage de la prise de rdv
 */
function  afficher_prise_rdv(prenom_nom_demandeur) {
    document.getElementById("zone_prise_rdv").hidden = false;
    document.getElementById("partie_gauche_demande").hidden = true;
    document.getElementById('bloc_suivi').hidden = true;
    document.getElementById('boutons_gestion_demande').hidden = true;
    document.getElementById('demander_prise_rdv').hidden = true;

    document.getElementById("rediger_mail").innerHTML =
        "Bonjour " + prenom_nom_demandeur[0] + " " + prenom_nom_demandeur[1] + ",\n" +
        "\n" +
        "J'ai bien pris connaissance de votre projet, mais je souhaiterais convenir d'un rendez-vous avec vous pour clarifier certains points concernant la pièce à créer.\n" +
        "\n" +
        "Bonne journée.";
}

/**
 * Suppression de l'affichage prise de rdv
 */
function enlever_prise_rdv() {
    document.getElementById("zone_prise_rdv").hidden = true;
    document.getElementById("partie_gauche_demande").hidden = false;
    document.getElementById('bloc_suivi').hidden = false;
    document.getElementById('boutons_gestion_demande').hidden = false;
    document.getElementById('demander_prise_rdv').hidden = false;
}

/**
 * Envoi d'un mail au demandeur
 * @param id_demande
 */
function envoyer_mail_demande_rdv(id_demande) {
    let confirmation = confirm('Êtes vous sûr d\'envoyer ce mail pour la demande ' + get_projet_id(demandes, id_demande).nom_projet + ' ?');
    if (confirmation) {
        // TODO

        enlever_prise_rdv();
    }
}

function countLines(theArea){
    var theLines = theArea.value.replace((new RegExp(".{"+theArea.cols+"}","g")),"\n").split("\n");
    while(theLines[theLines.length-1]=="") theLines.length--;
    return theLines.length;
  }