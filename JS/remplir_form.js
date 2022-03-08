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

document.getElementById("intitule").value = ex_demande.nom_projet
document.getElementById("description").value = ex_demande.description_projet
document.getElementById("datelimite").value = ex_demande.date_limite
document.getElementById("equipe_recherche").value = ex_demande.groupe
document.getElementById("etat").textContent = "Etat : " + ex_demande.etat

if (ex_demande.etat != "en attente de validation") {
    document.getElementById("modifiydiv").setAttribute("style","display:none; visibility:hidden;")
}
