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
        return escape_sql_wild(strip_tags(trim($value)));
    }
    $login = securiser($_POST["login_cas"]);
    //si l'utilisateur n'est pas enregistré ou n'est pas l'auteur de la demande, il ne peux pas en créer une
    if(!isset($_SESSION['idsrm_login_cas']) || strcmp($_SESSION['idsrm_login_cas'], $login) !=0) return false;
    
    //si utilisateur pas dans la base, on le crée
    $query_projets = $connect->prepare("SELECT count(1) FROM `personne` WHERE `id_cas` = ?");
    $query_projets->bind_param('s', $login);
    $query_projets->bind_result($found);
    $query_projets->execute();
    $query_projets->store_result();
    //si la requête du nom d'utilisateur n'a pas de résultat/a un résultat vide
    if ($found){
        //création de l'utilisateur dans la base
        $nom = securiser($_POST["user_nom"]);
        $prenom = securiser($_POST["user_prenom"]);
        $mail = securiser($_POST["user_mail"]);
        $equipe_rech = securiser($_POST["projet_equipe_recherche"]);
        $ufr = securiser($_POST["ufr"]);
        $query_projets = $connect->prepare("INSERT INTO personne VALUES (?, ?, ?, ?, ?)");
        $query_projets->bind_param('sssss', $login,$nom,$prenom,$mail,$equipe_rech);
        $query_projets->execute();
    }
    
    //création de la demande dans la base
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
    $query_projets = $connect->prepare("INSERT INTO demande VALUES (DEFAULT, ?, ?, ?, ?, ?, DEFAULT, ?, ?)");
    $query_projets->bind_param('sssssss', $login,$titre,$description,$date_lim,$suivi,$date_debut,$etat);
    $query_projets->execute();
    $id = $connect->insert_id;

   
    $uploads_dir = $_SERVER['DOCUMENT_ROOT'] .'/upload_files';
    $countfiles = count($_FILES["fichiers"]["name"]);
    for($i=0;$i<$countfiles;$i++){
        $tmp_name = $_FILES["fichiers"]["tmp_name"][$i];
        $name = $id."-".basename($_FILES["fichiers"]["name"][$i]);
        $type = $_FILES["fichiers"]["type"][$i];
        move_uploaded_file($tmp_name, "$uploads_dir/$name");

        $query_projets = 'INSERT INTO fichier VALUES (DEFAULT, '.$id.', "'.$type.'", "'.$uploads_dir.'/'.$name.'");';
        $req = $connect->query($query_projets);
    }
    mysqli_close($connect);

    //envoie d'un mail pour notifier les admins qu'une nouvelle demande est faite
    //création du tableau contenant les infos du mail
    $prisedeRDV = $_POST["prisedeRDV"];
    $url = "http://".$_SERVER['HTTP_HOST']."/PHP/send_mail.php";
    $content[0] = null;
    $content[1] = "Une nouvelle demande est en atente de validation sur la plateforme demande-méca!";
    if(strcmp($prisedeRDV, "O") == 0){
      $content[1] = $content[1]." L'utilisateur souhaite prendre un rendez-vous (son mail: ".$mail." ).";
    }
    $content[2] = "administrateur";  
    $content[3] = "Nouvelle demande: ".$titre;

    $content = json_encode($content);

    //envoie d'une requête à la page php qui envoie les mails, avec les infos du mail
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $content);

    $json_response = curl_exec($curl);
    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);


    header('Location: /HTML/validation.php');
    exit;
?>
