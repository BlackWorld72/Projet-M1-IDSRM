var all_files = []
actual_index = -1


/**
 * Check form
 * @returns 
 */
function validateForm() {
    form = document.getElementById("form")
    elements = form.elements

    for(elem in elements) {
        element = elements[elem]
        
        if (element.value == "") {
            alert("Vous devez remplir tout les champs.")
            return
        }

        if (element.type == "text") {
            console.log(element.value)
        }
        else if (element.type == "email") {
            if (!validateEmail(element.value)) {
                alert("Format de l'email non valide")
                return
            }

            console.log(element.value)
        }
        else {
            
        }
    }
}

/**
 * Check email value
 * @param {email} email 
 * @returns 
 */
function validateEmail(email) {
    return String(email).toLowerCase().match(/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);
}


