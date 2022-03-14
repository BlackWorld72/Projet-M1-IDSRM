<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <?php require_once $_SERVER['DOCUMENT_ROOT'] .'/Projet-M1-IDSRM/HTML/header.php' ?>
        <title>Gerer les roles</title>
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
                                <a id="all" class="flex-sm-fill text-sm-center nav-link active" onclick='initRoles("all")'>Tous</a>
                                <a id="ope" class="flex-sm-fill text-sm-center nav-link" onclick='getSpeRole("operateur","ope")'>Opérateur</a>
                                <a id="admin" class="flex-sm-fill text-sm-center nav-link" onclick='getSpeRole("administrateur","admin")'>Administrateur</a>
                            </nav>

                            <div id="liste_demandes" class="d-grid gap-2 ">
                                
                            </div>
                            <div class="d-grip gap-2"  style="margin-top: 15%;">
                                <button id="btn_ajouter_role" class="w-100 btn btn-primary" onclick="renderAddRole()">Ajouter un nouvel utilisateur</button>
                            </div>
                        </div>
                        <div id="description_role" class="col-sm-6">
                            <div id="message_informatif">
                                <p class="text-center">Veuillez appuyer sur une personne pour voir ses informations ou appuyer sur "Ajouter un nouvel utilisateur" pour créer un utilisateur avec un rôle "Administrateur" ou "Opérateur".</p>
                            </div>
                            <div id="informations_role" class="container" hidden>
                                <div class="row">
                                    <form>
                                        <div id="blocNom" style="visibility: hidden; display: none;" class="col-sm-6">
                                            <label for="nom"  class="form-label">Nom</label>
                                            <input type="text" class="form-control" id="nom" name="user_nom" value="">
                                        </div>
                                        <div id="blocPrenom" style="visibility: hidden; display: none;" class="col-sm-6">
                                            <label for="prenom" class="form-label">Prénom</label>
                                            <input type="text" class="form-control" id="prenom" name="user_prenom" value="">
                                        </div>
                                        <div class="col-sm-12" >
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="user_mail" value="" required>
                                        </div>
                                        <div class="col-sm-12" >
                                            <label for="email" class="form-label">Rôle</label>
                                            <div class="col-sm-4">
                                                <select class="form-select" id="role" required>
                                                    <option selected></option>
                                                    <option value="Administrateur">Administrateur</option>
                                                    <option value="Opérateur">Opérateur</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div id="subform" style="margin-top: 30px; text-align: center;"></div> 
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script type="text/javascript" src="/Projet-M1-IDSRM/JS/Administrateur/gestion_roles.js"></script>
    </body>
</html>