<?php
    include('connect_bdd.php');

    $id_demande = $_POST["id_demande"];
    $login_cas = $_POST["login_cas"];

    /* Verification de l'utilisateur - Securisation de la requete */
    $query_projets = 'SELECT login_cas FROM demande WHERE id_demande='.$id_demande.';';
	$projets = $connect->query($query_projets);
    $row = $projets->fetch_assoc(); 
    if ($row['login_cas'] != $login_cas) {
        mysqli_close($connect);
        exit;
    }
    
    $query_projets = 'SELECT path FROM fichier WHERE id_demande='.$id_demande.';';
    $result_projets = $connect->query($query_projets);

    $zip_name =  $_SERVER['DOCUMENT_ROOT'] .'/Projet-M1-IDSRM/upload_files/'.$id_demande.'.zip';
    $zip = new ZipArchive;
	if ($zip->open($zip_name, ZipArchive::CREATE) === TRUE) {
        while ($row = mysqli_fetch_array($result_projets)) {
            $zip->addFile($row['path']);
        }
		$zip->close();
	}

	if (file_exists($zip_name)) {
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename="'.basename($zip_name).'"');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($zip_name));
		mysqli_close($connect);
		echo json_encode($zip_name);
		exit;
	}
    mysqli_close($connect);
    exit;
?>