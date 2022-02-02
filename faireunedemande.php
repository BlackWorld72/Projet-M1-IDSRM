<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <?php require_once 'phpCAS/connect_cas.php' ?>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./CSS/styles.css">
    <title>Faire une demande</title>
    <script src="./JS/include_html.js"></script>
    <script src="./JS/STL/three.min.js"></script>
    <script src="./JS/STL/STLLoader.js"></script>
    <script src="./JS/STL/OrbitControls.js"></script>
    <script src="./JS/visualiser_fichier.js"></script>
</head>
<body>
    <section class="menu">
        <img class="logoLeMansUniversite"
             src="./res/logo-le-mans-universite.png"
             alt="Logo Le Mans Université">
        <ul class="navbar">
            <li><a class="active" href="faireunedemande.html">Faire une demande</a>
            <li><a href="prendrerendezvous.html">Prendre un rendez-vous</a>
            <li><a href="mesdemandes.html">Consulter mes demandes</a>
            <li><a href="?logout=">Déconnexion</a>
        </ul>
    </section>
    <section>
        <div class="pageDroite">
            <div class="contenuPageDroite">
                <div class="titrePage">
                    <h1><b>IDSRM</b></h1>
                </div>
                <div class="row formulaire">
                    <form id="form" action="./PHP/send_demande_html.php" method="POST">
                    <div class="col-sm-6">
                        <div class="container">
                                <input type="hidden" id="login_cas" name="login_cas" value="s172746">
                                <input type="hidden" id="ufr" name="ufr" value="Sciences et Techniques">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="nom"  class="form-label">Nom</label>
                                        <input type="text" readonly class="form-control" id="nom" name="user_nom" value="<?php echo  explode(".", phpCAS::getAttributes()['mail'])[1] ?>">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="prenom" class="form-label">Prénom</label>
                                        <input type="text" readonly class="form-control" id="prenom" name="user_prenom" value="<?php echo explode(".", phpCAS::getAttributes()['mail'])[0] ?>">
                                    </div>
                                    <div class="col-sm-12" >
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" readonly class="form-control" id="email" name="user_mail" value="<?php echo phpCAS::getAttributes()['mail'] ?>">
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label for="intitule" class="form-label">Intitulé du projet</label>
                                        <input type="text" class="form-control" id="intitule" name="projet_intitule"  required>
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="description" class="form-label">Description du projet</label>
                                        <textarea class="form-control" id="description" name="projet_description" placeholder="Description du projet" required></textarea>
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
                                            <select class="form-select" id="prisedeRDV" size=2 required>
						<option selected value="N">Non</option>
						<option value="O">Oui</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <h2>Visualisation des fichiers</h2>
			<div include-html="./affichage_fichier.html"></div>
                        <script> includeHTML(); </script>
                    </div>
                    <button class="btn btn-primary btn-lg" type="submit" name="submit" value="Submit">Envoyer</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
<script src="./JS/verif_form.js"></script>

</body>

</html>
