<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <?php require_once $_SERVER['DOCUMENT_ROOT'] .'/Projet-M1-IDSRM/HTML/header.php' ?>
        <script src="/Projet-M1-IDSRM/JS/gestion_demandes.js"></script>
        <script src="/Projet-M1-IDSRM/JS/Operateur/afficher_demandes.js"></script>
        <title>Liste des demandes</title>
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
                        <div id="partie_gauche_demande" class="container col-sm-5">
                                <nav id="menu_demandes" class="navbar navbar-expand-lg nav nav-pills flex-column flex-sm-row">
                                    <a id="demande_EnCours" class="flex-sm-fill text-sm-center nav-link active" onclick="getDemandesAvecEtat('En cours')">En cours</a>
                                    <a id="demande_Terminee" class="flex-sm-fill text-sm-center nav-link" onclick="getDemandesAvecEtat('Terminée')">Terminée</a>
                                </nav>
                                <div id="liste_demandes" class="d-grid gap-2 ">
                                    <!-- La liste des demandes-->
                                </div>
                        </div>
                        <div id="description_demande" class="col-sm-7">
                            <div id="message_informatif">
                                <p class="text-center">Veuillez appuyer sur une demande de pièce pour voir sa description.</p>
                            </div>
                            <div id="message_erreur" hidden>
                                <p class="text-center">Une erreur est survenue. Veuillez réessayer ultérieurement.</p>
                            </div>
                            <div id="informations_demande" class="container" hidden>
                                <h2 id="titre_projet" class="titre_cote_droit">
                                    <!-- Nom de la demande -->
                                </h2>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="fs-5 info_demande" id="prenom_demandeur">
                                            <!--Prénom du demandeur-->
                                        </p>
                                    </div>
                                    <div class="col-sm-3">
                                        <p class="fs-5 info_demande" id="nom_demandeur">
                                            <!--Nom du demandeur-->
                                        </p>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="fs-5 info_demande" id="email_demandeur">
                                            <!--Email du demandeur-->
                                        </p>
                                    </div>
                                </div>
                                <!-- Description de la demande -->
                                <div class="info_demande">
                                    <textarea id="description_projet" style="resize:none" rows="15" class="border-secondary rounded border border-4 form-control" readonly>
                                    </textarea>
                                </div>
                                <div class="row info_demande">
                                    <div class="col align-self-start">
                                        <button type="button" class="smaller-btn">
                                        <span class="btn-label"><i class="fa fa-download"></i></span> Télécharger les fichiers</button>
                                    </div>
                                    <div class="col align-self-end">
                                        <p class="fs-5 info_demande_importante">Date de début :
                                            <a id="date_debut"><!-- Date de début de la demande --></a>
                                        </p>
                                        <p id="date_limite_info" class="fs-5 info_demande_importante">Date limite :
                                            <a id="date_limite"><!-- Date limite de la demande --></a>
                                            <a id="priorite" hidden>URGENT</a>
                                        </p>
                                        <p id="date_fin_info" class="fs-5 info_demande_importante">Date de fin :
                                            <a id="date_fin"><!-- Date de fin de la demande --></a>
                                        </p>
                                    </div>
                                </div>
                                <!-- Suivi de la pièce en production -->
                                <div id="bloc_suivi" class="row col-sm-11">
                                    <label for="suivi_info" class="info_demande_importante col-sm-3 col-form-label">Suivi de la pièce :</label>
                                    <div class="col-sm-6">
                                        <select class="form-select fs-5" id="suivi_info" required>
                                            <option value="redaction_cahier_charges">Rédaction du cahier des charges</option>
                                            <option value="etude_conception">Étude et conception</option>
                                            <option value="realisation_fabrication">Réalisation et fabrication</option>
                                            <option value="montage">Montage</option>
                                            <option value="livraison">Livraison</option>
                                            <option value="terminee">Terminée</option>
                                        </select>
                                    </div>
                                    <!-- ce div fait déborder le bouton de l'écran
                                     <div class="col-sm-2 text-center"> -->
                                        <button type="button" class="smaller-btn">
                                            <span id="mettre_a_jour_suivi" class="btn-label">Mettre à jour le statut</button>
                                     <!-- </div> -->
                                </div>
                            </div>
                            <script type="text/javascript">initialiser_affichage_demandes()</script>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>