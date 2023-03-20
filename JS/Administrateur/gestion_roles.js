/**
 * Classe représentant un role
 */
class Role {
    constructor(personne){
        this.email = personne.email
        this.role = personne.role
    }
}

/**
 * Envoie les informations nécessaires à la création / modification / suppression d'un rôle (l'email et le rôle) avec une méthode POST
 * @param type_requete add_role, modify_role, delete_role
 * @param email l'email de l'utilisateur
 * @param role le rôle à créer / ajouter, optionnel car inutile dans le cas d'une suppression
 */
function send_requete_role(type_requete, email, role = null){
    let params;
    if (type_requete === 'delete_role' && role == null) {
        params = 'email=' + email;
    } else {
        params = 'email=' + email + "&role=" + role;
    }

    fetch("/PHP/Administrateur/" + type_requete + ".php", {
        method: 'POST',
        headers: {'Content-Type':'application/x-www-form-urlencoded'},
        body: params
    }).then((response) => {
            if (response.ok) {
                document.getElementById("success").hidden = false;
            } else {
                document.getElementById("error_add_user").hidden = false;
            }
        }
    ).catch((err) => console.error("Une erreur est survenue.", err));

}

/**
 * Demande la liste des rôles avec une appel GET
 * @returns {any}
 */
function get_select_role(){
    var xmlHttp = new XMLHttpRequest();
    var result;
    xmlHttp.onreadystatechange = function() {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200){
            result = xmlHttp.responseText;
        }

        if (xmlHttp.status === 404 || xmlHttp.status === 500) {
            document.getElementById("errors").hidden = false;
            result = null;
        }
    }
    xmlHttp.open("GET", "/PHP/Administrateur/select_role.php", false); // true for asynchronous
    xmlHttp.send(null);
    return JSON.parse(result);
}

/**
 * Permet d'afficher le panel de droite pour ajouter un nouvel utilisateur 
 */
function renderAddRole() {
    setValues(-1)
    document.getElementById("email").value = ""
    document.getElementById("email").readOnly = false

    document.getElementById("role").selectedIndex = 0

    div = document.getElementById("subform")
    div.textContent = ""

    btn = document.createElement("button")
    btn.setAttribute("class","smaller-btn")
    btn.setAttribute("type","submit")
    btn.setAttribute("name","submit")
    btn.setAttribute("value","Ajouter")
    btn.textContent = "Ajouter"
    btn.setAttribute("style","margin-left: 10px;")
    btn.onclick = function(e) {
        let conf = confirm('Etes vous sûr de vouloir ajouter ce rôle ?')
        if (conf) {
            addRole(e)
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
    let liste_roles = get_select_role();
    let roles = [];
    if (liste_roles !== null) {
        for (let key in Object.keys(liste_roles)){
            roles.push(new Role({email: liste_roles[key]['email'], role: liste_roles[key]['role']}));
        }
    }

    return roles;
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
        btn.textContent = roles[i].email
        console.log(roles[i].email)
        btn.setAttribute("class","bouton_liste w-100 btn btn-outline-primary ")
        btn.setAttribute("onclick", "setValues(" + i + ")")
        btn.setAttribute("id", i)
        div.append(btn)
    }
}

/**
 * Permet de mettre à jour la barre de navigation
 * @param {*} id 
 */
function updateBar(id) {
    document.getElementById("all").setAttribute("class","flex-sm-fill text-sm-center nav-link")
    document.getElementById("ope").setAttribute("class","flex-sm-fill text-sm-center nav-link")
    document.getElementById("admin").setAttribute("class","flex-sm-fill text-sm-center nav-link")

    document.getElementById(id).setAttribute("class","flex-sm-fill text-sm-center nav-link active")

    document.getElementById('informations_role').hidden = true;
    document.getElementById('message_informatif').hidden = false;
    
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

        if (roles[i].role === spe) {
            console.log(roles[i].email)
            console.log(spe)
            let btn = document.createElement("button")
            btn.textContent =  roles[i].email

            btn.setAttribute("class","bouton_liste w-100 btn btn-outline-primary")
            btn.setAttribute("onclick", "setValues(" + i + ")")
            btn.setAttribute("id", i)
            div.append(btn)
        }   
    }
}

/**
 * Action effectuée après avoir cliqué sur le bouton modifier un rôle
 */
function modifyrole(e) {
    e.preventDefault()

    email = document.getElementById("email").value
    role = document.getElementById("role").value

    send_requete_role("modify_role", email, role)
}

/**
 * Action effectuée après avoir cliqué sur le bouton supprimer un rôle
 */
function deleterole(e) {
    e.preventDefault()

    email = document.getElementById("email").value

    send_requete_role("delete_role", email)
}

/**
 * Action effectuée après avoir cliqué sur le bouton ajouter un rôle
 */
function addRole(e) {
    e.preventDefault()

    email = document.getElementById("email").value
    role = document.getElementById("role").value

    send_requete_role("add_role", email, role)
}

/**
 * Permet d'afficher les boutons modifier et supprimer
 */
function msbuttons() {
    div = document.getElementById("subform")
    div.textContent = ""
    tab = ["modifier", "supprimer"]
    tabContent = ["<span class='btn-label'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></span> Modifier </button>", "<span class='btn-label'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></span> Supprimer</button>"]
    for (let i = 0 ; i < tab.length ; i++) {
        btn = document.createElement("button")
        btn.setAttribute("class","smaller-btn")
        btn.setAttribute("type","submit")
        btn.setAttribute("name","submit")
        btn.setAttribute("value",tab[i])
        btn.innerHTML = tabContent[i]
        btn.setAttribute("style","margin-left: 10px;")
        btn.onclick = function(e) {
            let conf = confirm('Êtes vous sûr de vouloir ' + tab[i] + ' cette demande ?')
            if (conf) {
                if (tab[i] == "modifier") {
                    modifyrole(e)
                }
                else {
                    deleterole(e)
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
    document.getElementById('informations_role').hidden = false;
    document.getElementById('message_informatif').hidden = true;

    activeRole = id
    if(id!=-1){
        document.getElementById("email").value = roles[id].email
        document.getElementById("email").readOnly = true
        let index = 1
        if (roles[id].role == "Opérateur") {
            index = 2
        }
        document.getElementById("role").selectedIndex = index
        msbuttons()
    }

    // Gestion des boutons "active" ou non
    let boutons_role = document.getElementsByClassName("bouton_liste");
    for (let i = 0; i < boutons_role.length ; i++){
        if (parseInt(boutons_role[i].id) === parseInt(id)){
            boutons_role[i].classList.add("active");
        } else {
            boutons_role[i].classList.remove("active");
        }
    }
    

}

/**** Initialisation ****/
var roles = getAllRoles() 
initRoles("all")