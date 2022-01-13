<?php
    include('connect_bdd.php');
    $query_projets = 'SELECT * FROM demande;';
    $projets = $connect->query($query_projets);
    echo json_encode($projets); 
?>