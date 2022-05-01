<?php
    include('connect_bdd.php');
    //si l'utilisateur n'est pas authentifié il ne peux pas faire ça
    if(!isset($_SESSION['idsrm_login_cas'])) return false;
    function escape_sql_wild($s) /* escapes SQL pattern wildcards in s. */ {
      $result = array();
      foreach(str_split($s) as $ch)
        {
          if ($ch == "\\" || $ch == "%" || $ch == "_") { $result[] = "\\"; } /*if*/
          $result[] = $ch;
        } /*foreach*/
      return implode("", $result);
    }

    function securiser($value) { return escape_sql_wild(strip_tags(trim($value))); }

    foreach ($_POST as $param_name => $param_val) {
      echo "Param: $param_name; Value: $param_val<br />\n";
    }

    $action = $_POST['action'];
    $nom_projet = securiser($_POST["projet_intitule"]);
    $description_projet = securiser($_POST["projet_description"]);
    $date_limite = $_POST["projet_datelimite"];
    $login_cas = $_POST["login_cas"];
    $id_demande = $_POST["id_demande"];
    $mail_demandeur = $_POST['mail_demande'];

    //Si l'utilisateur n'est ni l'auteur de la demande, ni un admin, il ne peux pas modifier la demande
    if(strcmp($_SESSION['idsrm_login_cas'], $login_cas) !=0 && strcmp("administrateur", $_SESSION["user_type"])!=0) return false;
    
    /* Verification de l'utilisateur - Securisation de la requete */
    $query_projets = 'SELECT login_cas FROM demande WHERE id_demande='.$id_demande.';';
	  $projets = $connect->query($query_projets);
    $row = $projets->fetch_assoc(); 
		if ($row['login_cas'] != $login_cas) {
            mysqli_close($connect);
            header('Location: /Projet-M1-IDSRM/HTML/validation.php');
            exit();
		}

    /* Modification / Suppression */
    if ($action == 'Update') {
        $query_projets = 'UPDATE demande SET nom_projet="'.$nom_projet.'", description_projet="'.$description_projet.'", date_limite="'.$date_limite.'" WHERE id_demande='.$id_demande.';';
        $projets = $connect->query($query_projets);
    } else if ($action == 'Delete') {
        $query_projets = 'DELETE FROM fichier WHERE id_demande='.$id_demande.';';
        $projets = $connect->query($query_projets);
        $query_projets = 'DELETE FROM demande WHERE id_demande='.$id_demande.';';
        $projets = $connect->query($query_projets);
    }

    mysqli_close($connect);

    //envoie d'un mail pour notifier l'utilisateur
    $url = "http://altea.univ-lemans.fr/Projet-M1-IDSRM/PHP/send_mail.php";
    $content[0] = null;
    $content[1] = "Votre demande a été modifiée. Si vous n'êtes pas à l'origine de ces modifications, vous pouvez consulter celles-ci sur la plateforme demande-meca.";
    $content[2] = $mail_demandeur;  
    $content[3] = "Demande modifiée: ".$nom_projet;

    $content = json_encode($content);

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $content);

    $json_response = curl_exec($curl);
    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);


    if ( $status != 200 ) {
        die("Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
    }


    curl_close($curl);

    header('Location: /Projet-M1-IDSRM/HTML/validation.php');
    exit;
?>
