<?php
    require_once($_SERVER['DOCUMENT_ROOT'] .'/Projet-M1-IDSRM/PHP/detection_utilisateur.php');
        
    include('connect_bdd.php');
    if(!isset($_SESSION['idsrm_login_cas']) || strcmp("utilisateur", $_SESSION["user_type"])==0) return false;
    $query_projets = 'SELECT * FROM demande;';
    $result_projets = $connect->query($query_projets);
    $projets = [];
    $demandeurs = [];
    while ($row = mysqli_fetch_array($result_projets)) {
        $row['date_debut'] = (new DateTime($row['date_debut']))->format('d/m/Y');
        $row['date_limite'] = (new DateTime($row['date_limite']))->format('d/m/Y');
        $row['date_fin'] = (new DateTime($row['date_fin']))->format('d/m/Y');
        $projets[$row['id_demande']] = $row;
        $demandeur[$row['id_demande']] = $row['login_cas'];
    }

    $query_projets = $connect->prepare("SELECT * FROM `personne` WHERE `id_cas` = ?");
    $query_projets->bind_param('s', $value);
    foreach($demandeur as $key => $value){
        $query_projets->execute();
        $result = $query_projets->get_result();
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $projets[$key]['nom'] = $row['nom'];
        $projets[$key]['prenom'] = $row['prenom'];
        $projets[$key]['mail'] = $row['mail'];
        $projets[$key]['groupe'] = $row['groupe'];
    }
    mysqli_close($connect);
    echo json_encode($projets); 
?>
