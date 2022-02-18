<?php
    include('connect_bdd.php');
    $query_projets = "INSERT INTO demande VALUES (DEFAULT, \"".$_POST['login_cas']."\", \"".$_POST["user_nom"]."\", \"".$_POST["user_prenom"]."\", \"".$_POST["user_mail"]."\", \"".$_POST["projet_equipe_recherche"]."\", \"".$_POST["ufr"]."\", \"".$_POST["projet_intitule"]."\", \"".$_POST["projet_description"]."\", \"".$_POST["projet_datelimite"]."\", \"en attente de validation\", DEFAULT, \"".date("Y-m-d")."\");";
    echo $query_projets;
    $projets = $connect->query($query_projets);
    mysqli_close($connect);
    header('Location: /Projet-M1-IDSRM/HTML/validation.php');
    exit;
?>
