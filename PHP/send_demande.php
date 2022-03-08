<?php
    include('connect_bdd.php');
    $demande = json_decode($_POST['extra'], true);
    $query_projets = "INSERT INTO demande VALUES (DEFAULT, \"".$demande["login_cas"]."\", \"".$demande["nom"]."\", \"".$demande["prenom"]."\", \"".$demande["mail"]."\", \"".$demande["groupe"]."\", \"".$demande["ufr"]."\", \"".$demande["nom_projet"]."\", \"".$demande["description_projet"]."\", \"".$demande["date_limite"]."\", \"".$demande["etat"]."\", DEFAULT, \"".date("Y-m-d")."\");";
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
    exit()
?>