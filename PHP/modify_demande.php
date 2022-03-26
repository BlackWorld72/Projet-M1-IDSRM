<?php
    include('connect_bdd.php');

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

    /* Verification de l'utilisateur - Securisation de la requete */
    $query_projets = 'SELECT login_cas FROM demande WHERE id_demande='.$id_demande.';';
	  $projets = $connect->query($query_projets);
    $row = $projets->fetch_assoc(); 
		if ($row['login_cas'] != $login_cas) {
        mysqli_close($connect);
        header('Location: /Projet-M1-IDSRM/HTML/validation.php');
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

    $query_projets = 'SELECT mail FROM demande WHERE id_demande='.$id_demande.';';
    $projets = $connect->query($query_projets);
    $row = $projets->fetch_assoc(); 
    $projets = $connect->query($query_projets);
    mysqli_close($connect);

    $mail['to'] = $row['mail'];
    $mail['content'] = "Votre demande a été modifiée";
    $mail['subject'] = "Demande modifiée: ".$nom_projet;

    header('Location: /Projet-M1-IDSRM/HTML/validation.php');
    exit;
?>