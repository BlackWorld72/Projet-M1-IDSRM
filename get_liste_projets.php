<?php
    include('connect_bdd.php');
    
    $query_projets = 'SELECT * FROM demande;';
    $projets = $connect->query($query_projets);
    $projets = mysqli_fetch_array($projets);
    echo json_encode($projets); 
?>
