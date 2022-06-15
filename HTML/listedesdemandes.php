<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <?php require_once $_SERVER['DOCUMENT_ROOT'] .'/HTML/header.php' ?>
        <script src="/JS/gestion_demandes.js"></script>
        <script src="/JS/afficher_demandes.js"></script>
        <script type="text/javascript" src="/JS/jquery-1.8.3.min.js"></script>
        <title>Consulter mes demandes</title>
    </head>
    <body>
        <?php include($_SERVER['DOCUMENT_ROOT'] ."/HTML/nav-bar.php");
            echo '<script> user_type = "'.$_SESSION["user_type"].'";</script>';
            ?>
        <section>
            <div class="pageDroite">
                <div class="contenuPageDroite">
                    <div class="titrePage">
                        <h1><b>IDSRM</b></h1>
                    </div>
                    <div class="row formulaire">
                        <div id="partie_gauche_demande" class="container col-sm-5">
                            <nav id="menu_demandes" class="sticky-top bg-white navbar navbar-expand-lg nav nav-pills flex-column flex-sm-row">
                                <a id="demande_EnAttente" class="flex-sm-fill text-sm-center nav-link active" onclick="getDemandesAvecEtat('En attente')">En attente</a>
                                <a id="demande_EnCours" class="flex-sm-fill text-sm-center nav-link" onclick="getDemandesAvecEtat('En cours')">En cours</a>
                                <a id="demande_Terminee" class="flex-sm-fill text-sm-center nav-link" onclick="getDemandesAvecEtat('Terminée')">Terminée</a>
                                <?php 
                                    if(strcmp($_SESSION["user_type"], "operateur") == 0){
                                        echo "<script> document.getElementById('demande_EnAttente').hidden = true;</script>";
                                    }
                                    ?>
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
                            <form id="form" enctype="multipart/form-data" action="/PHP/modify_demande.php" method="POST">
                                <input type="hidden" readonly id="mail_demande" name="mail_demande" value="" required>
                                <input type="hidden" readonly id="login_cas" name="login_cas" value="<?php echo $_SESSION['idsrm_login_cas'] ?>" required>
                                <input type="hidden" readonly id="id_demande" name="id_demande" value="" required>
                                <div id="modify_block" class="container" style="visibility: hidden; display:none;">
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
                                        <input class="form-control" onchange="createSelectingFiles(this.files)" accept=".txt, .png, .jpeg, .jpg, .stl, .pdf, .ai, .gif, .bmp, .dxf, .svf, .f3d, .sldprt, .obj, .dwg, step, .doc, .docx, .csv, .xls, .xlsx, .ppt, .pptx, .odt, .ods" type="file" name="fichiers[]" id="fichiers" multiple>
                                    </div>
                                    <div class="row col-sm-12">
                                        <label for="datelimite" class="col-sm-4 col-form-label">Date limite</label>
                                        <div class="col-sm-6">
                                            <input type="date" class="form-control" id="datelimite" name="projet_datelimite" required>
                                        </div>
                                    </div>
                                    <div class="row boutons_gestion_demande">
                                        <div class="col-sm-6 text-center">
                                            <button id="btn_modify" type="submit" class="smaller-btn" name="action" onclick="return confirm('Êtes vous sûr de modifier cette demande ?')" value="Update" style="background-color:#db4c3b;">Confirmer</button>
                                        </div>
                                        <div class="col-sm-6 text-center">
                                            <button id="btn_remove" type="button" class="smaller-btn" name="action" onclick="cancel_modify_demande()" value="Delete" style="background-color:#db4c3b;">Annuler</button>
                                        </div>
                                    </div>
                                </div>
                                <div id="informations_demande" class="container" hidden>
                                    <h2 id="titre_projet" readonly class="titre_cote_droit">
                                        <!-- Nom de la demande -->
                                    </h2>
                                    <!-- /!\ Garder temporairement pour les pages Admin et operateur-->
                                    <div id="identite_demandeur" class="row">
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
                                    <?php 
                                        //idendité du demandeur caché si utilisateur standard, car il ne peux voir que ses demandes de toute façon
                                        if(strcmp($_SESSION["user_type"], "utilisateur") == 0){
                                            echo "<script> document.getElementById('identite_demandeur').hidden = true;</script>";
                                        }
                                        ?>
                                    <!-- Description de la demande -->
                                    <div class="info_demande">
                                        <textarea id="description_projet" name="description_projet" style="resize:none" class="border-secondary rounded border border-4 form-control" readonly>
                                        </textarea>
                                    </div>
                                    <div class="row info_demande">
                                        <div id="div_download_files" class="col align-self-start">
                                            <a id="download_button" download="fichiers.zip"><button id="btn_dl_files" type="button" class="smaller-btn"><span class="btn-label"><i class="fa fa-download"></i></span> Télécharger les fichiers</button></a>
                                        </div>
                                        <div class="col align-self-end">
                                            <p class="fs-5 info_demande_importante">
                                                Date de début :
                                                <a id="date_debut">
                                                    <!-- Date de début de la demande -->
                                                </a>
                                            </p>
                                            <p id="date_limite_info" class="fs-5 info_demande_importante">
                                                Date limite :
                                                <a id="date_limite">
                                                    <!-- Date limite de la demande -->
                                                </a>
                                                <a id="priorite" hidden>URGENT</a>
                                            </p>
                                            <p id="date_fin_info" class="fs-5 info_demande_importante">
                                                Date de fin :
                                                <a id="date_fin">
                                                    <!-- Date de fin de la demande -->
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                    <div id="bloc_suivi">
                                        <div id="bloc_suivi_en_attente" class="row col-sm-12">
                                            <div class="col-sm-4">
                                                <p id="suivi_info" class="fs-5 info_demande_importante">Suivi de la pièce :</p>
                                            </div>
                                            <div class="col-sm-8">
                                                <p id="suivi" class="fs-5">
                                                    <!-- Suivi de la pièce en production -->
                                                </p>
                                            </div>
                                            <!--ce div fais déborder le bouton  -->
                                            <div class="text-center">
                                                <button type="button" class="smaller-btn">
                                                <span id="valider_piece" class="btn-label">Valider la demande</button>
                                                <!---->
                                            </div>
                                        </div>
                                        <div id="bloc_suivi_en_cours" class="row col-sm-12">
                                            <label for="suivi_select" class="info_demande_importante col-sm-4 col-form-label">Suivi de la pièce :</label>
                                            <div class="col-sm-8">
                                                <select class="form-select fs-5" id="suivi_select" required>
                                                    <option value="redaction_cahier_charges">Rédaction du cahier des charges</option>
                                                    <option value="etude_conception">Étude et conception</option>
                                                    <option value="realisation_fabrication">Réalisation et fabrication</option>
                                                    <option value="montage">Montage</option>
                                                    <option value="livraison">Livraison</option>
                                                    <option value="terminee">Terminée</option>
                                                </select>
                                            </div>
                                            <div class="mt-3 text-center"> 
                                                <button type="button" class="smaller-btn">
                                                <span id="mettre_a_jour_suivi" class="btn-label">Mettre à jour le statut</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="boutons_gestion_demande" class="row boutons_gestion_demande">
                                        <div class="col-sm-6 text-center">
                                            <button id="btn_modify" type="button" class="smaller-btn" name="action" onclick="modify_demande()" value="Update"><span id="modifier_demande" class="btn-label"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span> Modifier la demande</button>
                                        </div>
                                        <div class="col-sm-6 text-center">
                                            <button id="btn_remove" type="submit" class="smaller-btn" name="action" onclick="confirm('Etes vous sûr de supprimer cette demande ?')" value="Delete"><span id="supprimer_demande" class="btn-label"><i class="fa fa-trash-o" aria-hidden="true"></i></span> Supprimer la demande</button>
                                        </div>
                                    </div>
                                    <div id="btn_prise_rdv" class="row bouton_envoyer_prise_rdv">
                                        <div class="col-sm-12 text-center">
                                            <button id="demander_prise_rdv" type="button" class="smaller-btn">Demander un rendez-vous</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <?php 
                                if(strcmp($_SESSION["user_type"], "utilisateur") == 0){
                                    echo '<script type="text/javascript">initialiser_affichage_demandes("' . $_SESSION['idsrm_login_cas'] . '")</script>';
                                }else{
                                    echo '<script type="text/javascript">initialiser_affichage_toutes_demandes()</script>';
                                }
                                if(strcmp($_SESSION["user_type"], "administrateur") == 0){
                                    echo '<script type="text/javascript">getDemandesAvecEtat("En attente");</script>';
                                }
                                
                                
                                ?>
                        </div>
                        <!-- TODO: rendre les textes configurables -->
                        <div id='prise_rdv' class='col-sm-6'>
                            <div id='zone_prise_rdv' class='container' hidden>
                                <h2 id='titre_prise_rdv' class='titre_cote_droit'>
                                    Prise de rendez-vous
                                </h2>
                                <!-- Prise de rendez-vous -->
                                <?php if(strcmp($_SESSION["user_type"], "utilisateur") == 0){
                                        echo "<p id='message_information_redaction_mail'>Pour prendre un rendez-vous avec un administrateur responsable du suivi de votre pièce, veuillez rédiger votre mail ci-dessous.</p>";
                                        
                                    
                                    }else { //administrateur
                                        echo "<p id='message_information_redaction_mail'>Pour prendre un rendez-vous avec le demandeur, veuillez rédiger votre mail ci-dessous.</p>";
                                        
                                    }
                                    ?>    
                                <div class='zone_redaction_mail'>
                                    <textarea id='rediger_mail' style='resize:none' rows='18' class='border-secondary rounded border border-4 form-control'>
                                    </textarea>
                                </div>";
                                <div id='boutons_gestion_demande' class='row boutons_gestion_demande'>
                                    <div class='col-sm-6 text-center'>
                                        <button id='annuler_prise_rdv' type='button' class='smaller-btn'>Annuler</button>
                                    </div>
                                    <div class='col-sm-6 text-center'>
                                        <button id='envoyer_prise_rdv' type='button' class='smaller-btn'>Demander un rendez-vous</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php 
                            if(strcmp($_SESSION["user_type"], "operateur") == 0){
                                echo "<script> document.getElementById('prise_rdv').hidden = true;</script>";
                                echo "<script> document.getElementById('btn_prise_rdv').hidden = true;</script>";
                            }
                            ?>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>