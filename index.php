<?php
    require_once($_SERVER['DOCUMENT_ROOT'] .'/Projet-M1-IDSRM/PHP/detection_utilisateur.php');

    if(strcmp("administrateur", $_SESSION["user_type"])==0){
        $lien = "Administrateur/consulterlesdemandes.php";
    }else if(strcmp("operateur", $_SESSION["user_type"])==0){
        $lien = "Operateur/consulterlesdemandes.php";
    }else{
        $lien = "Utilisateur/faireunedemande.php";
    }

    echo "<meta http-equiv='refresh' content='0; URL=HTML/$lien' />";
?>
