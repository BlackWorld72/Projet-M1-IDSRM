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
    
    $suivi = "en attente de validation";
    $etat = "En attente";

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
        $suivi,
        date("d/m/Y"),
        $etat
    );

    echo $query_projets;
    $projets = $connect->query($query_projets);
    mysqli_close($connect);
    //header('Location: /Projet-M1-IDSRM/HTML/validation.php');
    exit;
?>