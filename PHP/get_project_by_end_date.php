<?php
    include('connect_bdd.php');
    $_POST['action'] = 'SELECT * FROM demande ORDER BY date_fin;';
?>