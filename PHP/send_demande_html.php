<?php
    include('connect_bdd.php');

    function securiser($value){
        $val = mysqli_real_escape_string(strip_tags(trim($value)));
        return $val;
    }
    
    $query_projets = $connect->prepare("INSERT INTO demande VALUES (DEFAULT, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, DEFAULT, ?, ?)");
    $query_projets->bind_param(ssssssssssssss, 
        securiser($_POST['login_cas']),
        securiser($_POST["user_nom"]),
        securiser($_POST["user_prenom"]),
        securiser($_POST["user_mail"]),
        securiser($_POST["projet_equipe_recherche"]),
        securiser($_POST["ufr"]),
        securiser($_POST["projet_intitule"]),
        securiser($_POST["projet_description"]),
        securiser($_POST["projet_datelimite"]),
        "en attente de validation",
        date("d/m/Y"),
        "En attente"
    );

    echo $query_projets;
    $projets = $connect->query($query_projets);
    mysqli_close($connect);
    //header('Location: /Projet-M1-IDSRM/HTML/validation.php');
    exit;
?>