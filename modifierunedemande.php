<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <!-- Bootstrap CSS -->
    <?php require_once 'phpCAS/connect_cas.php' ?>
    <link href="./CSS/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./CSS/styles.css">
    <title>Modifier une demande</title>
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
            <li><a href="faireunedemande.html">Faire une demande</a>
            <li><a href="prendrerendezvous.html">Prendre un rendez-vous</a>
            <li><a class="active" href="mesdemandes.html">Consulter mes demandes</a>
            <li><a href="?logout=">Déconnexion</a>
        </ul>
    </section>
    <section>
        <main class="pageDroite">
            <div class="contenuPageDroite">
                <div class="titrePage">
                    <h1><b>IDSRM</b></h1>
                </div>
                <div class="row formulaire">
                    <div class="col-sm-6">
                        <div class="container">
                            <form id="form" action="./PHP/modify_demande.php" method="POST">
                                <input type="hidden" readonly id="login_cas" name="login_cas" value="s172746" required>
                                <input type="hidden" readonly id="ufr" name="ufr" value="Sciences et Techniques" required>
                               	<input type="hidden" readonly id="id_demande" name="id_demande" value="4">
				 <div class="row">
                                    <div class="col-sm-12" >
                                        <label for="email" id="etat" class="form-label"></label>
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
                                </div>
                           
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <h2>Visualisation des fichiers</h2>
						<div include-html="./affichage_fichier.html"></div>
                        <script>includeHTML();</script>
                        <button class="btn btn-primary btn-lg" type="submit", name="submit" onclick="return confirm('Etes vous sûr de modifier cette demande ?')" value="Update">Modifier</button>
                        <button class="btn btn-primary btn-lg" type="submit", name="submit" onclick="return confirm('Etes vous sûr de supprimer cette demande ?')" value="Delete">Supprimer</button>
                        </form>
                    </div>
                </div>
                
            </div>
        </main>
    </section>
</body>
<script src="JS/remplir_form.js"></script>
</html>

