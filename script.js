var all_files = []
actual_index = -1

/**
 * Render SDL model
 * @param {file} model 
 * @param {string} elementID 
 */
function STLViewer(model, elementID) {
    var elem = document.getElementById(elementID)

    var camera = new THREE.PerspectiveCamera(70, elem.clientWidth/elem.clientHeight, 1, 1000);

    var renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
    renderer.setSize(elem.clientWidth, elem.clientHeight);
    elem.appendChild(renderer.domElement);


    window.addEventListener('resize', function () {
        renderer.setSize(elem.clientWidth, elem.clientHeight);
        camera.aspect = elem.clientWidth/elem.clientHeight;
        camera.updateProjectionMatrix();
    }, false);

    var controls = new THREE.OrbitControls(camera, renderer.domElement);
    controls.enableDamping = true;
    controls.rotateSpeed = 0.5;
    controls.dampingFactor = 0.1;
    controls.enableZoom = true;
    controls.autoRotate = true;
    controls.autoRotateSpeed = 0;

    var scene = new THREE.Scene();
    scene.add(new THREE.HemisphereLight(0xffffff, 1.5));


    (new THREE.STLLoader()).load(model, function (geometry) {
        var material = new THREE.MeshPhongMaterial({ 
            color: 0xff5533, 
            specular: 100, 
            shininess: 100 });
        var mesh = new THREE.Mesh(geometry, material);
            scene.add(mesh);

        var middle = new THREE.Vector3();
            geometry.computeBoundingBox();
            geometry.boundingBox.getCenter(middle);
            mesh.geometry.applyMatrix(new THREE.Matrix4().makeTranslation( 
                                          -middle.x, -middle.y, -middle.z ) );

        var largestDimension = Math.max(geometry.boundingBox.max.x,
                                            geometry.boundingBox.max.y, 
                                            geometry.boundingBox.max.z)
                camera.position.z = largestDimension * 1.5;
        
        var animate = function () {
                    requestAnimationFrame(animate);
                    controls.update();
                    renderer.render(scene, camera);
                }; 
        animate();
    });
}

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

/**
 * Check if file is an image
 * @param {file} file 
 * @returns 
 */
function isImage(file) {
    var imageType = /^image\//;
    return imageType.test(file.type)
}

/**
 * Create / Update the select file
 * @param {file list} files 
 * @returns 
 */
function createSelectingFiles(files) { 

    if (files.length == 0) {
        return
    }

    all_files = files
    let inp = document.getElementById("selectFiles")
    
    if (!inp) {
        inp = document.createElement('select')
    }
    else {
        removeOptions(inp)
    }
    
    inp.setAttribute("onChange", "onChangeSelectFiles()")
    inp.setAttribute("name", "selectFiles");
    inp.setAttribute("id", "selectFiles");
    for (let i = 0 ; i < files.length ; i++) {
        let opt = document.createElement('option')
        opt.textContent = String(files[i].name)
        opt.setAttribute("value", files[i]);    
        inp.append(opt)
    }
    document.getElementById("divselectfile").append(inp)
    onChangeSelectFiles()
}

/**
 * Update visualizing file
 */
function onChangeSelectFiles() {
    let inp = document.getElementById("selectFiles")
    actual_index = inp.selectedIndex
    document.getElementById("model").innerHTML = "";
    document.getElementById("visuimg").innerHTML = "";
    document.getElementById("visuembed").innerHTML = "";
    reader = new FileReader()
    reader.readAsDataURL(all_files[actual_index])
    reader.onload = function(e) {
        if (isImage(all_files[actual_index])) { // Image
            let f = document.getElementById("visuimg")
            f.setAttribute("src", this.result)
            f.setAttribute("style", "display: block; background-color: #333; width: 50%;")
            document.getElementById("visuembed").setAttribute("style", "display: none;")
            document.getElementById("model").setAttribute("style", "display: none;")
            
        }
        else if (all_files[actual_index].type == "application/pdf") { // PDF
            let f = document.getElementById("visuembed")
            f.setAttribute("src", this.result)
            f.setAttribute("style", "display: block; background-color: #333; width: 50%;")
            document.getElementById("visuimg").setAttribute("style", "display: none;")
            document.getElementById("model").setAttribute("style", "display: none;")
        }  
        else { // STL
            document.getElementById("model").setAttribute("style", "display: block; width: 50%; height: 500px")
            STLViewer(this.result, "model")
            document.getElementById("visuembed").setAttribute("style", "display: none;")
            document.getElementById("visuimg").setAttribute("style", "display: none;")
        }          
    }
}

/**
 * Remove all options from a select
 * @param {Select object} selectElement 
 */
function removeOptions(selectElement) {
    var i, L = selectElement.options.length - 1;
    for(i = L; i >= 0; i--) {
       selectElement.remove(i);
    }
 }
