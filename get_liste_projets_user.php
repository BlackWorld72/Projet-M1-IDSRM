<?php
    include('connect_bdd.php');
    $user = $_GET['extra'];
    $query_projets = 'SELECT * FROM demande WHERE login_cas="'.$user.'";';
    $result_projets = $connect->query($query_projets);
    $projets = [];
    while ($row = mysqli_fetch_array($result_projets)) {
        $projets[$row['id_demande']] = $row;
    }
    mysqli_close($connect);
    echo json_encode($projets); 
?>
