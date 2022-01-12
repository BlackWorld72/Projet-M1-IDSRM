<?php
    include('connect_bdd.php');
    $query_projets = 'SELECT nom_projet FROM demande;';
    $projets = $connect->query($query_projets);
    echo json_encode($projets); 
?>