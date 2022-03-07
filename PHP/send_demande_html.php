<?php
    include('connect_bdd.php');
    
    $query_projets = "INSERT INTO demande VALUES (DEFAULT, \"".$_POST['login_cas']."\", \"".$_POST["user_nom"]."\", \"".$_POST["user_prenom"]."\", \"".$_POST["user_mail"]."\", \"".$_POST["projet_equipe_recherche"]."\", \"".$_POST["ufr"]."\", \"".$_POST["projet_intitule"]."\", \"".$_POST["projet_description"]."\", \"".$_POST["projet_datelimite"]."\", \"en attente de validation\", DEFAULT, \"".date("Y-m-d")."\");";
    echo $query_projets;
    $projets = $connect->query($query_projets);
    $id = $connect->insert_id;

    $uploads_dir = '../upload_files';
    $countfiles = count($_FILES['fichiers']['name']);
    for($i=0;$i<$countfiles;$i++){
        $tmp_name = $_FILES["fichiers"]["tmp_name"][$i];
        $name = $id."-".basename($_FILES["fichiers"]["name"][$i]);
        $type = $_FILES['fichiers']['type'][$i];
        move_uploaded_file($tmp_name, "$uploads_dir/$name");

        $query_projets = 'INSERT INTO fichier VALUES (DEFAULT, '.$id.', "'.$type.'", "'.$uploads_dir.'/'.$name.'");';
        $req = $connect->query($query_projets);
    }

    mysqli_close($connect);
    header('Location: '.require_once $_SERVER['DOCUMENT_ROOT'] .'/Projet-M1-IDSRM/HTML/validation.php');
    exit;
?>