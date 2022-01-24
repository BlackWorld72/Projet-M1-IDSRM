<head>
    <link rel="stylesheet" media="all" href="./CSS/bootstrap 3.3.6.min.css">
</head>
<h1>Modifier l&#039;Utilisateur: s172746</h1>
<div class="utilisateur-form">
    <form id="w0" action="/index.php?r=utilisateur%2Fupdate&amp;uid=s172746" method="post">
        <div class="form-group col-md-6">
            <label class="control-label" for="utilisateur-nom">Nom</label>
            <input type="text" id="utilisateur-nom" class="form-control" name="Utilisateur[nom]" value="Girod" readonly maxlength="100">
            <div class="help-block"></div>
        </div>
        <div class="form-group col-md-6">
            <label class="control-label" for="utilisateur-prenom">Prénom</label>
            <input type="text" id="utilisateur-prenom" class="form-control" name="Utilisateur[prenom]" value="Valentin" readonly maxlength="100">
            <div class="help-block"></div>
        </div>
        <div class="form-group col-md-6">
            <label class="control-label" for="utilisateur-mail">Mail</label>
            <input type="text" id="utilisateur-mail" class="form-control" name="Utilisateur[mail]" value="Valentin.Girod.Etu@univ-lemans.fr" readonly maxlength="255">
            <div class="help-block"></div>
        </div>
        <div class="form-group col-md-6 required">
            <label class="control-label" for="utilisateur-mail_contact">Mail de contact</label>
            <input type="text" id="utilisateur-mail_contact" class="form-control" name="Utilisateur[mail_contact]" value="" maxlength="255" aria-required="true">
            <div class="help-block"></div>
        </div>
        <div class="form-group col-md-6">
            <label class="control-label" for="utilisateur-composante">Composante</label>
            <input type="text" id="utilisateur-composante" class="form-control" name="Utilisateur[composante]" value="1" readonly maxlength="45">
            <div class="help-block"></div>
        </div>
        <div class="form-group col-md-2">
            <label class="control-label" for="utilisateur-mail_contact">Date de fin maximale</label>
            <input class="form-control" type="date" >
            <div class="help-block"></div>
        </div>
        <div class="form-group col-md-6">
            <label class="control-label" for="utilisateur-service_formation">Formation ou Service</label>
            <input type="text" id="utilisateur-service_formation" class="form-control" name="Utilisateur[service_formation]" value="M1 INFORMATIQUE" maxlength="200">
            <div class="help-block"></div>
        </div>
        <div class="form-group col-md-12">
            <button type="submit" class="btn btn-primary">Modifier</button>    
        </div>
    </form>
</div>
<script  src="./script.js"></script>