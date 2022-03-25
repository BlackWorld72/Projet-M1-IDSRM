<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">

    <?php require_once $_SERVER['DOCUMENT_ROOT'] .'/Projet-M1-IDSRM/HTML/header.php' ?>
    <title>Faire une demande</title>
    <script src="/Projet-M1-IDSRM/JS/STL/three.min.js"></script>
    <script src="/Projet-M1-IDSRM/JS/STL/STLLoader.js"></script>
    <script src="/Projet-M1-IDSRM/JS/STL/OrbitControls.js"></script>
    <script src="/Projet-M1-IDSRM/JS/visualiser_fichier.js"></script>
</head>
<body>
<?php include($_SERVER['DOCUMENT_ROOT'] ."/Projet-M1-IDSRM/HTML/nav-bar.php"); ?>
<section>
    <div class="pageDroite">
        <div class="contenuPageDroite">
            <div class="titrePage">
                <h1><b>IDSRM</b></h1>
            </div>

            <div class="row formulaire">
                <div class="col-sm-12">
                    <div class="contenuFormulaire">
                        <form id="form" enctype="multipart/form-data" action="/Projet-M1-IDSRM/PHP/send_demande_html.php" method="POST">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="row">
                                        <input type="hidden" readonly id="login_cas" name="login_cas" value="<?php echo phpCAS::getUser(); ?>" required>
                                        <input type="hidden" readonly id="ufr" name="ufr" value="inconnue<?php //echo phpCAS::getAttributes()['webCodeComposante']; ?>" required>

                                        <div class="col-sm-6">
                                            <label for="nom"  class="form-label">Nom</label>
                                            <input type="text" readonly class="form-control" id="nom" name="user_nom" value="<?php echo phpCAS::getAttributes()['Sn']; ?>" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="prenom" class="form-label">Prénom</label>
                                            <input type="text" readonly class="form-control" id="prenom" name="user_prenom" value="<?php echo phpCAS::getAttributes()['givenName']; ?>" required>
                                        </div>
                                        <div class="col-sm-12" >
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" readonly class="form-control" id="email" name="user_mail" value="<?php echo phpCAS::getAttributes()['mail']; ?>" required>
                                        </div>
                                        <div class="form-group col-sm-12">
                                            <label for="intitule" class="form-label">Intitulé du projet</label>
                                            <input type="text" class="form-control" id="intitule" name="projet_intitule" placeholder="Intitulé du projet"  required>
                                        </div>
                                        <div class="col-sm-12">
                                            <label for="description" class="form-label">Description du projet</label>
                                            <textarea class="form-control" id="description" name="projet_description" placeholder="Description du projet" rows="6" required></textarea>
                                        </div>
                                        <div class="col-sm-12">
                                            <label for="fichiers" class="form-label">Plan(s)</label>
                                            <input class="form-control" onchange="createSelectingFiles(this.files)" accept=".png, .jpeg, .jpg, .stl, .pdf" type="file" name="fichiers[]" id="fichiers" multiple>
                                        </div>
                                        <div class="row col-sm-12">
                                            <label for="datelimite" class="col-sm-4 col-form-label">Date limite</label>
                                            <div class="col-sm-6">
                                                <input type="date" min="<?php echo date('Y') . '-' . date('m') . '-' . date('d'); ?>" value="<?php echo date('Y')+1 . '-' . date('m') . '-' . date('d'); ?>" class="form-control" id="datelimite" name="projet_datelimite">
                                            </div>
                                        </div>
                                        <div class="row col-sm-10">
                                            <label for="equipe_recherche" class="col-sm-6 col-form-label">Nom de l’équipe de recherche</label>
                                            <div class="col-sm-6">
                                                <select class="form-control" id="equipe_recherche" name="projet_equipe_recherche" required>
                                                    <option value="" disabled selected></option>
                                                    <option value="Matériaux">Matériaux</option>
                                                    <option value="Transducteurs">Transducteurs</option>
                                                    <option value="Guides et Structures">Structures</option>
                                                    <option value="Enseignement">Enseignant</option>
                                                    <option value="Etudiant">Etudiant</option>
                                                    <option value="Autre">Autre</option>
                                                </select>    
                                            </div>
                                        </div>
                                        <div class="row col-sm-10">
                                            <label for="prisedeRDV" class="col-sm-6 col-form-label">Souhaitez-vous un rendez-vous ?</label>
                                            <div class="col-sm-4">
                                                <select class="form-select" id="prisedeRDV" required>
                                                    <option value="O">Oui</option>
                                                    <option selected value="N">Non</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <h2 id="visualisationFichierTitre" class="titre_cote_droit">Visualisation des fichiers</h2>
                                    <?php include($_SERVER['DOCUMENT_ROOT'] ."/Projet-M1-IDSRM/HTML/affichage_fichier.html") ?>
                                    <div class="text-center bouton-formulaire">
                                        <button type="submit" name="submit" value="Submit">Envoyer</button>
                                    </div>
                                    <script src="/Projet-M1-IDSRM/JS/verif_form.js"></script>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>
