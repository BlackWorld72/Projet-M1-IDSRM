<?php
    include($_SERVER['DOCUMENT_ROOT'] .'/Projet-M1-IDSRM/PHP/connect_bdd.php');
    $mail = "valentin.girod.etu@univ-lemans.fr";//phpCAS::getAttributes()['mail'];
    $query_role = 'SELECT role FROM role WHERE email="'.$mail.'"';
    $_SESSION["user_type"] = mysqli_fetch_array($connect->query($query_role))[0];
    mysqli_close($connect);
    if(!isset($_SESSION["user_type"])){
        $_SESSION["user_type"] = "utilisateur";
    }

    if(strcmp("administrateur", $_SESSION["user_type"])==0){
        $lien = "Administrateur/consulterlesdemandes.php";
    }else if(strcmp("operateur", $_SESSION["user_type"])==0){
        $lien = "Operateur/consulterlesdemandes.php";
    }else{
        $lien = "Utilisateur/faireunedemande.php";
    }

    echo "<meta http-equiv='refresh' content='0; URL=HTML/$lien' />";
?>
