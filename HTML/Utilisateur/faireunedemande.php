<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">

    <!-- Connexion CAS -->
    <?php //require_once 'phpCAS/connect_cas.php' ?>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="../../CSS/styles.css">
    <title>Faire une demande</title>
    <script src="../../JS/STL/three.min.js"></script>
    <script src="../../JS/STL/STLLoader.js"></script>
    <script src="../../JS/STL/OrbitControls.js"></script>
    <script src="../../JS/visualiser_fichier.js"></script>
</head>
<body>
    <?php include("../nav-bar.php"); ?>
    <section>
        <div class="pageDroite">
            <div class="contenuPageDroite">
                <div class="titrePage">
                    <h1><b>IDSRM</b></h1>
                </div>

                <div class="row formulaire">
                    <div class="col-sm-12">
                        <div class="contenuFormulaire">
                            <form id="form" action="../../PHP/send_demande_html.php" method="POST">
                                <input type="hidden" readonly id="login_cas" name="login_cas" value="s172746" required>
                                <input type="hidden" readonly id="ufr" name="ufr" value="Sciences et Techniques" required>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="nom"  class="form-label">Nom</label>
                                                <input type="text" readonly class="form-control" id="nom" name="user_nom" value="<?php //echo explode(".", phpCAS::getAttributes()['mail'])[1] ?>" required>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="prenom" class="form-label">Prénom</label>
                                                <input type="text" readonly class="form-control" id="prenom" name="user_prenom" value="<?php //echo explode(".", phpCAS::getAttributes()['mail'])[0] ?>" required>
                                            </div>
                                            <div class="col-sm-12" >
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" readonly class="form-control" id="email" name="user_mail" value="<?php //echo phpCAS::getAttributes()['mail'] ?>" required>
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
                                                <input class="form-control" type="file" id="fichiers" multiple>
                                            </div>
                                            <div class="row col-sm-12">
                                                <label for="datelimite" class="col-sm-4 col-form-label">Date limite</label>
                                                <div class="col-sm-6">
                                                    <input type="date" class="form-control" id="datelimite" name="projet_datelimite" required>
                                                </div>
                                            </div>
                                            <div class="row col-sm-10">
                                                <label for="equipe_recherche" class="col-sm-6 col-form-label">Nom de l’équipe de recherche</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control" id="equipe_recherche" name="projet_equipe_recherche" placeholder="Nom de l'équipe de recherche" required>
                                                </div>
                                            </div>
                                            <div class="row col-sm-10">
                                                <label for="prisedeRDV" class="col-sm-6 col-form-label">Souhaitez-vous un rendez-vous ?</label>
                                                <div class="col-sm-4">
                                                    <select class="form-select" id="prisedeRDV" required>
                                                        <option selected></option>
                                                        <option value="O">Oui</option>
                                                        <option value="N">Non</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <h2 id="visualisationFichierTitre">Visualisation des fichiers</h2>
                                        <?php include("../affichage_fichier.html") ?>
                                        <div class="text-center bouton-formulaire">
                                            <button type="submit" name="submit" value="Submit">Envoyer</button>
                                        </div>
                                        <script src="../../JS/verif_form.js"></script>
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
