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

ex_demande = new Projet(JSON.parse('{"0":"1","1":"s172746","2":"Girod","3":"Valentin","4":"valentin@girod.fr","5":"etu","6":"science et technique","7":"idrm","8":"Interface de demande de réalisation mécaniqueBon là cest du dev, pas de la mécanique, donc projet à ignorer","9":"2022-01-17","10":"en attente de validation","11":null,"12":"0000-00-00","id_demande":"1","login_cas":"s172746","nom":"Girod","prenom":"Valentin","mail":"valentin@girod.fr","groupe":"etu","UFR":"science et technique","nom_projet":"idrm","description_projet":"Interface de demande de réalisation mécaniqueBon là cest du dev, pas de la mécanique, donc projet à ignorer","date_limite":"2022-01-17","etat":"en attente de validation","date_fin":null,"date_debut":"0000-00-00"}'));

document.getElementById("intitule").value = ex_demande.nom_projet
document.getElementById("description").value = ex_demande.description_projet
document.getElementById("datelimite").value = ex_demande.date_limite
document.getElementById("equipe_recherche").value = ex_demande.groupe
document.getElementById("etat").textContent = "Etat : " + ex_demande.etat

if (ex_demande.etat != "en attente de validation") {
    document.getElementById("modifiydiv").setAttribute("style","display:none; visibility:hidden;")
}
