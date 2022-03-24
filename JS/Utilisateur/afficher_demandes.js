let demandes = [];

/**
 * Initialisation de la page (récupération des demandes de l'utilisateur + affichage de la liste des demandes "En attente")
 */
function initialiser_affichage_demandes(idDemandeur){
    demandes = init_variable_liste_projets_par_user(idDemandeur);
    //demandes = init_variable_liste_projets_par_user('s172746');       // test en local
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
        document.getElementById("liste_demandes").innerHTML += "<button id=\"" + demandesAvecEtat[demande].id + "\" class=\"bouton_liste w-100 btn btn-outline-primary\" type=\"button\" onclick=\"afficher_informations_demande('" + demandesAvecEtat[demande].id + "');\">" + demandesAvecEtat[demande].nom_projet + "</button>";
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
            document.getElementById('boutons_gestion_demande').hidden = true;
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
    let demande = get_projet_id(demandes, id_demande);

    document.getElementById('message_informatif').hidden = true;
    document.getElementById('message_erreur').hidden = true;

    if (demande) {
        document.getElementById('informations_demande').hidden = false;

        // On affiche les informations de la demande sur la partie droite
        document.getElementById('id_demande').value = id_demande;
        document.getElementById('titre_projet').innerHTML = demande.nom_projet;
        document.getElementById('intitule').value = demande.nom_projet;
        document.getElementById('description_projet').innerHTML = demande.description_projet;
        document.getElementById("description").innerHTML = demande.description_projet; 
        //document.getElementById('nom_demandeur').innerHTML = demande.nom;
        //document.getElementById('prenom_demandeur').innerHTML = demande.prenom;
        //document.getElementById('email_demandeur').innerHTML = demande.mail;
        document.getElementById('id_demande').value = id_demande;
        document.getElementById('date_limite').innerHTML = demande.date_limite;
        document.getElementById("datelimite").value = demande.date_limite;
        document.getElementById('suivi').innerHTML = demande.suivi;
        document.getElementById('date_debut').innerHTML = demande.date_debut;
        document.getElementById('date_fin').innerHTML = demande.date_fin; 
        download_files(id_demande, document.getElementById("login_cas").value)  
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
                d.setAttribute("href", response)
            }
            else {
                document.getElementById("btn_dl_files").disabled = true;
                d.setAttribute("href", "")
            }
        }
    });
}
