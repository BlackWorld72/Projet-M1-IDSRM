<?php
    include('connect_bdd.php');
    $action = $_POST['submit'];
    if ($action == 'Update') {
        $query_projets = 'UPDATE demande SET nom_projet="'.$_POST["projet_intitule"].'", description_projet="'.$_POST["projet_description"].'", date_limite="'.$_POST["projet_datelimite"].'" WHERE id_demande="'.$POST["id_demande"].'";';

    } else if ($action == 'Delete') {
        $query_projets = 'DELETE FROM demande WHERE id_demande="'.$_POST["id_demande"].'";';
    }
    else {
        mysqli_close($connect);
        exit;
    }
    $projets = $connect->query($query_projets);
    mysqli_close($connect);
    header('Location: ../voila.php');
    exit;
?>

