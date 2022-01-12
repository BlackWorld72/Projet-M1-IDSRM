<?php
    include('connect_bdd.php');
    $user = GET_['extra'];
    $query_projets = 'SELECT nom_projet FROM demande WHERE login_cas='.$user.';';
    $projets = $connect->query($query_projets);
    echo json_encode($projets); 
?>