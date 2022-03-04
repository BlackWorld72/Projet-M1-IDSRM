<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <?php require_once $_SERVER['DOCUMENT_ROOT'] .'/Projet-M1-IDSRM/HTML/header.php' ?>
        <script src="/Projet-M1-IDSRM/JS/gestion_demandes.js"></script>
        <title>Consulter mes demandes</title>
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
                        <div id="partie_gauche_demande" class="container col-sm-6">
                                <nav id="menu_demandes" class="navbar navbar-expand-lg nav nav-pills flex-column flex-sm-row">
                                    <a class="flex-sm-fill text-sm-center nav-link active">En attente</a>
                                    <a class="flex-sm-fill text-sm-center nav-link">En cours</a>
                                    <a class="flex-sm-fill text-sm-center nav-link">Terminé</a>
                                </nav>

                                <div id="liste_demandes" class="d-grid gap-2 ">
                                    <button class="bouton_liste_demandes w-100 btn btn-outline-primary" type="button">Pièce de remorque très grande</button>
                                    <button class="bouton_liste_demandes w-100 btn btn-primary" type="button">Pièce de remorque</button>
                                
                                </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="container">
                                <h2 id="titre_projet">Pièce de remorque</h2>
                                <div class="row">
                                    <div class="col align-self-start">
                                        <p class="fs-5" id="demandeur_nom">GIROD</p>
                                    </div>
                                    <div class="col align-self-center">
                                        <p class="fs-5" id="demandeur_prenom">Valentin</p>
                                    </div>
                                    <div class="col align-self-end">
                                        <p class="fs-5" id="demandeur_mail">Valentin@girod.fr</p>
                                    </div>
                                </div>
                                <textarea style="resize:none" rows="4" class="border-secondary rounded border border-4 form-control" readonly>Ceci est une description de projet super longue qui devrait permettre de mieux comprendre la pièece</textarea>
                                <div class="row">
                                    <div class="col align-self-start">
                                        <button type="button" class="btn btn-labeled btn-success">
                                        <span class="btn-label"><i class="fa fa-download"></i></span> Télécharger les fichiers</button>
                                    </div>
                                    <div class="col align-self-end">
                                        <p class="fs-5">Date limite : <a id="date_limite">22/02/2022</a></p>
                                    </div>
                                </div>
                                <p class="fs-5">Suivi de la pièce : <a id="suivis">Étude et conception</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
    </body>
</html>