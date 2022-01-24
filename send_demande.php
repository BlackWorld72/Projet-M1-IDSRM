<?php
    include('connect_bdd.php');
    $demande = json_decode($_POST['extra'], true);
    $query_projets = "INSERT INTO demande VALUES (DEFAULT, \"".$demande["login_cas"]."\", \"".$demande["nom"]."\", \"".$demande["prenom"]."\", \"".$demande["mail"]."\", \"".$demande["groupe"]."\", \"".$demande["ufr"]."\", \"".$demande["nom_projet"]."\", \"".$demande["description_projet"]."\", \"".$demande["date_limite"]."\", \"".$demande["etat"]."\", DEFAULT, \"".date("Y-m-d")."\");";
    $projets = $connect->query($query_projets);
    mysqli_close($connect);
?>