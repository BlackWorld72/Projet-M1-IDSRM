<?php
    include('connect_bdd.php');

    function escape_sql_wild($s)
    /* escapes SQL pattern wildcards in s. */
    {
      $result = array();
      foreach(str_split($s) as $ch)
        {
          if ($ch == "\\" || $ch == "%" || $ch == "_")
            {
              $result[] = "\\";
            } /*if*/
          $result[] = $ch;
        } /*foreach*/
      return
          implode("", $result);
    }

    function securiser($value){
        $val = escape_sql_wild(strip_tags(trim($value)));
        return $val;
    }
    $login = securiser($_POST['login_cas']);
    $nom = securiser($_POST["user_nom"]);
    $prenom = securiser($_POST["user_prenom"]);
    $mail = securiser($_POST["user_mail"]);
    $equipe_rech = securiser($_POST["projet_equipe_recherche"]);
    $ufr = securiser($_POST["ufr"]);
    $titre = securiser($_POST["projet_intitule"]);
    $description =  securiser($_POST["projet_description"]);
    $date_lim = securiser($_POST["projet_datelimite"]);
    $suivi = "En attente de validation";
    $etat = "En attente";
    $date_debut = date("Y-m-d"); //aujourd'hui
    $query_projets = $connect->prepare("INSERT INTO demande VALUES (DEFAULT, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, DEFAULT, ?, ?)");
    $query_projets->bind_param('ssssssssssss', $login,$nom,$prenom,$mail,$equipe_rech,$ufr,$titre,$description,$date_lim,$suivi,$date_debut,$etat);

    $query_projets->execute();
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
