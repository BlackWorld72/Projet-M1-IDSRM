<?php
    include('connect_bdd.php');
    if(!isset($_SESSION['idsrm_login_cas'])) return false;
    
    $user = $_GET['extra'];
    $query_projets = 'SELECT * FROM demande WHERE login_cas="'.$user.'";';
    $query_user = 'SELECT * FROM personne WHERE id_cas="'.$user.'";';
    $result_projets = $connect->query($query_projets);
    $result_user = $connect->query($query_user);
    $row_user = mysqli_fetch_array($result_user);
    $projets = [];
    while ($row = mysqli_fetch_array($result_projets)) {
        $row['nom'] = $row_user['nom'];
        $row['prenom'] = $row_user['prenom'];
        $row['mail'] = $row_user['mail'];
        $row['groupe'] = $row_user['groupe'];
        $row['date_debut'] = (new DateTime($row['date_debut']))->format('d/m/Y');
        $row['date_limite'] = (new DateTime($row['date_limite']))->format('d/m/Y');
        $row['date_fin'] = (new DateTime($row['date_fin']))->format('d/m/Y');
        $projets[$row['id_demande']] = $row;
    }
    mysqli_close($connect);
    echo json_encode($projets); 
?>
