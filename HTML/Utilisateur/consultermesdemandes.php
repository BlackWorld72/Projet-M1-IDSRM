<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <?php require_once $_SERVER['DOCUMENT_ROOT'] .'/Projet-M1-IDSRM/HTML/header.php' ?>
        <script src="/Projet-M1-IDSRM/JS/Utilisateur/gestion_demandes.js"></script>
        <script src="/Projet-M1-IDSRM/JS/Utilisateur/afficher_demandes.js"></script>
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
                                    <a id="demande_EnAttente" class="flex-sm-fill text-sm-center nav-link active" onclick="getDemandesAvecEtat('En attente')">En attente</a>
                                    <a id="demande_EnCours" class="flex-sm-fill text-sm-center nav-link" onclick="getDemandesAvecEtat('En cours')">En cours</a>
                                    <a id="demande_Terminee" class="flex-sm-fill text-sm-center nav-link" onclick="getDemandesAvecEtat('Terminée')">Terminée</a>
                                </nav>
                                <div id="liste_demandes" class="d-grid gap-2 ">
                                    <!-- La liste des demandes-->
                                </div>
                        </div>
                        <div id="description_demande" class="col-sm-6">
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
                                <!-- /!\ Garder temporairement pour les pages Admin et operateur-->
                                <!--<div class="row">
                                    <div class="col align-self-start">
                                        <p class="fs-5 info_demande" id="nom_demandeur">
                                            Nom du demandeur
                                        </p>
                                    </div>
                                    <div class="col align-self-center">
                                        <p class="fs-5 info_demande" id="prenom_demandeur">
                                            Prénom du demandeur
                                        </p>
                                    </div>
                                    <div class="col align-self-end">
                                        <p class="fs-5 info_demande" id="email_demandeur">
                                            Email du demandeur
                                        </p>
                                    </div>
                                </div>-->
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
                                        </p>
                                        <p id="date_fin_info" class="fs-5 info_demande_importante">Date de fin :
                                            <a id="date_fin"><!-- Date de fin de la demande --></a>
                                        </p>
                                    </div>
                                </div>
                                <p id="suivi_info" class="fs-5 info_demande_importante">Suivi de la pièce :
                                    <a id="suivi"><!-- Suivi de la pièce en production --></a>
                                </p>
                                <div id="boutons_gestion_demande" class="row boutons_gestion_demande">
                                    <div class="col-sm-6 text-center">
                                        <button type="button" class="smaller-btn">
                                            <span id="modifier_demande" class="btn-label"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span> Modifier la demande</button>
                                    </div>
                                    <div class="col-sm-6 text-center">
                                        <button type="button" class="smaller-btn">
                                            <span id="supprimer_demande" class="btn-label"><i class="fa fa-trash-o" aria-hidden="true"></i></span> Supprimer la demande</button>
                                    </div>
                                </div>
                            </div>
                            <script type="text/javascript">initialiser_affichage_demandes(<?php //echo phpCAS::getUser(); ?>)</script>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>