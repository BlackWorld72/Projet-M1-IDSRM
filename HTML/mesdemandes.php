<!DOCTYPE html>
<html lang="fr">
    <head>
        <?php require_once 'phpCAS/connect_cas.php' ?>
        <meta charset="UTF-8">
        <!-- Bootstrap CSS -->    
        <link href="../CSS/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../CSS/styles.css">
        <title>Mes Demandes</title>
        <script src="../JS/include_html.js"></script>
    </head>
    <body>
        <?php include("./nav-bar.php"); ?>
        <section>
            <div class="pageDroite">
                <div class="contenuPageDroite">
                    <div class="titrePage">
                        <h1><b>IDSRM</b></h1>
                    </div>
                    <div class="row formulaire">
                        <div style="border-right: 1px solid #333;" class="container col-sm-6">
                                <nav class="navbar navbar-expand-lg nav nav-pills flex-column flex-sm-row">
                                    <a class="flex-sm-fill text-sm-center nav-link active" href="#">En attente</a>
                                    <a class="flex-sm-fill text-sm-center nav-link" href="#">En cours</a>
                                    <a class="flex-sm-fill text-sm-center nav-link" href="#">Terminé</a>
                                </nav>

                                <div id="liste_demandes" class="d-grid gap-2 ">
                                    <button class="btn btn-primary" type="button">Pièce de remorque très grande</button>
                                    <button class="btn btn-primary" type="button">Pièce de remorque</button>
                                
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
                                        <span class="btn-label"><i class="fa fa-download"></i></span>Télécharger les fichiers</button>
                                    </div>
                                    <div class="col align-self-end">
                                        <p class="fs-5">Date limite: <a id="date_limite">22/02/2022</a></p>
                                    </div>
                                </div>
                                <p class="fs-5">Suivi de la pièce: <a id="suivis">Étude et conception</a></p>
 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="d-grid gap-2">
  <button class="btn btn-primary" type="button">Button</button>
  <button class="btn btn-primary" type="button">Button</button>
</div>
    </body>
</html>