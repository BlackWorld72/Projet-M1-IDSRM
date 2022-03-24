<?php
    include('connect_bdd.php');
    
    $query_projets = 'SELECT * FROM demande;';
    $result_projets = $connect->query($query_projets);
    $projets = [];
    while ($row = mysqli_fetch_array($result_projets)) {
        $row['date_debut'] = (new DateTime($row['date_debut']))->format('d/m/Y');
        $row['date_limite'] = (new DateTime($row['date_limite']))->format('d/m/Y');
        $row['date_fin'] = (new DateTime($row['date_fin']))->format('d/m/Y');
        $projets[$row['id_demande']] = $row;
    }
    mysqli_close($connect);
    echo json_encode($projets); 
?>
