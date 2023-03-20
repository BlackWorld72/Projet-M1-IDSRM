<?php
    require_once($_SERVER['DOCUMENT_ROOT'] .'/PHP/detection_utilisateur.php');

    if(strcmp("administrateur", $_SESSION["user_type"])==0){
        $lien = "Administrateur/listedesdemandes.php";
    }else if(strcmp("operateur", $_SESSION["user_type"])==0){
        $lien = "Operateur/listedesdemandes.php";
    }else{
        $lien = "Utilisateur/faireunedemande.php";
    }

    echo "<meta http-equiv='refresh' content='0; URL=HTML/$lien' />";
?>

