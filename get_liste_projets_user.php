<?php
    include('connect_bdd.php');
    $user = $_GET['extra'];
    $query_projets = 'SELECT * FROM demande WHERE login_cas="'.$user.'";';
    $projets = $connect->query($query_projets);
    $projets = mysqli_fetch_array($projets);
    echo json_encode($projets); 
?>
