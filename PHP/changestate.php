<?php
    include('connect_bdd.php');
    $_POST['action'] = 'UPDATE demande SET etat_demande="'.$_POST["etat"].'" WHERE id_demande='.$POST['id_demande'].';';
?>