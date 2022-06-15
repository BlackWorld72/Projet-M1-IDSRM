<?php
    require_once($_SERVER['DOCUMENT_ROOT'] .'/PHP/detection_utilisateur.php');
        
	include('connect_bdd.php');
	$id_demande = $_POST['id_demande'];
    $login_cas = $_POST['login_cas'];
    if(!isset($_SESSION['idsrm_login_cas'])) return false;
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
	if (mysqli_num_rows($result_projets) == 0) {
		echo -1;
		exit;
	}
    $zip_name = $_SERVER['DOCUMENT_ROOT'] .'/upload_files/fichiers'.$id_demande.'.zip';
    $zip = new ZipArchive;
	if ($zip->open($zip_name, ZIPARCHIVE::CREATE | ZIPARCHIVE::OVERWRITE ) === TRUE) {
        while ($row = mysqli_fetch_array($result_projets)) {
			$file_name = explode("/", $row['path']);
			$length = sizeof($file_name)-1;
            $zip->addFile($row['path'], $file_name[$length]);
        }
		$zip->close();
	}
	mysqli_close($connect);
	echo '/upload_files/fichiers'.$id_demande.'.zip';
    exit;
?>
