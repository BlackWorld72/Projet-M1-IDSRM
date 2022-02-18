/**
 * Classe représentant un role
 */
class Role {
    constructor(personne){
        this.nom = personne.nom
        this.prenom = personne.prenom
        this.email = personne.email
        this.role = personne.role
    }
}

/**
 * Permet d'afficher le panel de droite pour ajouter un nouvel utilisateur 
 */
function renderAddRole() {
    activeRole = -1

    document.getElementById("nom").value = ""
    document.getElementById("blocNom").setAttribute("style", "visibility: hidden; display: none;")
    document.getElementById("blocPrenom").setAttribute("style", "visibility: hidden; display: none;")
    document.getElementById("prenom").value = ""
    document.getElementById("email").value = ""
    document.getElementById("email").readOnly = false

    document.getElementById("role").selectedIndex = 0

    div = document.getElementById("subform")
    div.textContent = ""

    btn = document.createElement("button")
    btn.setAttribute("class","btn btn-primary btn-lg")
    btn.setAttribute("type","submit")
    btn.setAttribute("name","submit")
    btn.setAttribute("value","Ajouter")
    btn.textContent = "Ajouter"
    btn.setAttribute("style","margin-left: 10px;")
    btn.onclick = function(e) {
        let conf = confirm('Etes vous sûr de vouloir ajouter ce rôle ?')
        if (conf) {
            addRole()
        }
    }
    div.append(btn)
}

var activeRole = -1

/**
 * Permet de récupéré le prénom et le nom d'une personne via son email de l'université
 * @param email 
 * @returns 
 */
function getFirstNameLastNameFromEmail(email) {
    let tmp = email.split('@')
    tmp = tmp.split('.')
    return [tmp[0],tmp[1]]
}

/**
 * Permet d'obtenir tout les rôles via la BDD
 * A MODIFIER QUAND REQUETES FAITES
 * @returns 
 */
function getAllRoles() {
    return [new Role(JSON.parse('{"nom": "HENRY", "prenom": "ALLAN", "email": "allan.henry.etu@univ-lemans.fr", "role":"Opérateur"}')),new Role(JSON.parse('{"nom": "GIROD", "prenom": "Valentin", "email": "valentin.girod.etu@univ-lemans.fr", "role":"Administrateur"}'))]
}

/**
 * Permet d'afficher les rôles que de la catégorie souhaiter (Admin, Opérateur, Tous)
 */
function initRoles(id) {
    let div = document.getElementById("liste_demandes")
    updateBar(id)
    div.textContent = ""
    for (let i = 0 ; i < roles.length ; i++) {
        let btn = document.createElement("button")
        btn.textContent = roles[i].nom + " " + roles[i].prenom + " - " + roles[i].role
        btn.setAttribute("class","w-100 btn btn-primary")
        btn.setAttribute("onclick", "setValues(" + i + ")")
        div.append(btn)
    }
}

/**
 * Permet de mettre à jour la bar de navigation
 * @param {*} id 
 */
function updateBar(id) {
    document.getElementById("all").setAttribute("class","flex-sm-fill text-sm-center nav-link")
    document.getElementById("ope").setAttribute("class","flex-sm-fill text-sm-center nav-link")
    document.getElementById("admin").setAttribute("class","flex-sm-fill text-sm-center nav-link")

    document.getElementById(id).setAttribute("class","flex-sm-fill text-sm-center nav-link active")
}

/**
 * Permet d'afficher toutes les personnes attribué à un rôle spécifique
 * @param {*} spe 
 * @param {*} id 
 */
function getSpeRole(spe, id) {
    let div = document.getElementById("liste_demandes")
    updateBar(id)
    div.textContent = ""
    for (let i = 0 ; i < roles.length ; i++) {
        if (roles[i].role == spe) {
            let btn = document.createElement("button")
            btn.textContent = roles[i].nom + " " + roles[i].prenom + " - " + roles[i].role
            btn.setAttribute("class","w-100 btn btn-primary")
            btn.setAttribute("onclick", "setValues(" + i + ")")
            div.append(btn)
        }   
    }
}

/**
 * Action effectuer après avoir cliquer sur le bouton modifier un role
 */
function modifyrole() {
    console.log("modif")
}

/**
 * Action effectuer après avoir cliquer sur le bouton supprimer un role
 */
function deleterole() {
    console.log("delete")
}

/**
 * Action effectuer après avoir cliquer sur le bouton ajouter un role
 */
function addRole() {
    console.log("add")
}

/**
 * Permet d'afficher les boutons modifier et supprimer
 */
function msbuttons() {
    div = document.getElementById("subform")
    div.textContent = ""
    tab = ["modifier", "supprimer"]
    for (let i = 0 ; i < tab.length ; i++) {
        btn = document.createElement("button")
        btn.setAttribute("class","btn btn-primary btn-lg")
        btn.setAttribute("type","submit")
        btn.setAttribute("name","submit")
        btn.setAttribute("value",tab[i])
        btn.textContent = tab[i]
        btn.setAttribute("style","margin-left: 10px;")
        btn.onclick = function(e) {
            let conf = confirm('Etes vous sûr de vouloir ' + tab[i] + ' cette demande ?')
            if (conf) {
                if (tab[i] == "modifier") {
                    modifyrole()
                }
                else {
                    deleterole()
                }
            }
        }
        div.append(btn)
    }                         
}

/**
 * Permet d'afficher les valeurs du rôle d'une personne
 */
function setValues(id) {
    activeRole = id
    document.getElementById("nom").value = roles[id].nom
    document.getElementById("nom").readOnly = true
    document.getElementById("blocNom").setAttribute("style", "visibility: show; display: block;")
    document.getElementById("blocPrenom").setAttribute("style", "visibility: show; display: block;")
    document.getElementById("prenom").value = roles[id].prenom
    document.getElementById("prenom").readOnly = true
    document.getElementById("email").value = roles[id].email
    document.getElementById("email").readOnly = true
    let index = 1
    if (roles[id].role == "Opérateur") {
        index = 2
    }
    
    document.getElementById("role").selectedIndex = index
    msbuttons()
}

/**** Initialisation ****/
var roles = getAllRoles() 
initRoles("all")
renderAddRole()