<?php

        
    include('connect_bdd.php');
    //si l'utilisateur n'est pas authentifié il ne peux pas faire ça
    if(!isset($_SESSION['idsrm_login_cas'])) return false;
    //si l'utilisateur n'est ni un admin ni un opérateur il ne peux pas modifier un suivis
    if(strcmp("administrateur", $_SESSION["user_type"])!=0 && strcmp("operateur", $_SESSION["user_type"])!=0) return false;
    
    $_POST['action'] = 'UPDATE demande SET etat_demande="'.$_POST["etat"].'" WHERE id_demande='.$POST['id_demande'].';';
?>