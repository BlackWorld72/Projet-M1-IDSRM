<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <?php require_once $_SERVER['DOCUMENT_ROOT'] .'/Projet-M1-IDSRM/HTML/header.php' ?>
        <script src="/Projet-M1-IDSRM/JS/gestion_demandes.js"></script>
        <script src="/Projet-M1-IDSRM/JS/Utilisateur/gestion_prise_rdv.js"></script>
        <title>Prendre un rendez-vous</title>
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
                        </nav>
                        <div id="liste_demandes" class="d-grid gap-2 ">
                            <!-- La liste des demandes-->
                        </div>
                    </div>
                    <div id="prise_rdv" class="col-sm-6">
                        <div id="message_informatif">
                            <p class="text-center">Veuillez appuyer sur une demande de pièce pour pouvoir envoyer un mail.</p>
                        </div>
                        <!--<div id="message_erreur" hidden>
                            <p class="text-center">Une erreur est survenue. Veuillez réessayer ultérieurement.</p>
                        </div>-->
                        <div id="zone_prise_rdv" class="container" hidden>
                            <h2 id="titre_prise_rdv" class="titre_cote_droit">
                                Prise de rendez-vous
                            </h2>
                            <!-- Prise de rendez-vous -->
                            <p id="message_information_redaction_mail">Pour prendre un rendez-vous avec un administrateur responsable du suivi de votre pièce, veuillez rédiger votre mail ci-dessous.</p>
                            <div class="zone_redaction_mail">
                                    <textarea id="rediger_mail" style="resize:none" rows="18" class="border-secondary rounded border border-4 form-control">Bonjour,

Je souhaiterais ajouter de nouvelles informations pour la création de ma pièce. Serait-il possible de convenir ensemble d'un rendez-vous ?

Bien cordialement,

</textarea>
                            </div>
                            <div class="row bouton_envoyer_prise_rdv">
                                <div class="col-sm-12 text-center">
                                    <button id="envoyer_prise_rdv" type="button" class="smaller-btn">Demander un rendez-vous</button>
                                </div>
                            </div>
                        </div>
                        <script type="text/javascript">initialiser_affichage_demandes("<?php echo phpCAS::getUser(); ?>")</script>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </body>
</html>
