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
