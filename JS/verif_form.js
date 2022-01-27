


 (function() {
    form = document.getElementById("form");
    elements = form.elements;
    for(elem in elements) {
        element = elements[elem];
        if(element.parentNode != undefined){
            element.addEventListener('input',   (event) => {
                event.target.parentElement.classList.add("was-validated");
            });
        }
    }
  }());

  
  