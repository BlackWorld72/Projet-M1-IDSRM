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

    $action = $_POST['action']
    $nom_projet = securiser($_POST["projet_intitule"]);
    $description_projet = securiser($_POST["projet_description"]);
    $date_limite = $_POST["projet_datelimite"];
    $id_demande = $_POST["id_demande"];

    if ($action == 'Update') {
        $query_projets = 'UPDATE demande SET nom_projet="'.$nom_projet.'", description_projet="'.$description_projet.'", date_limite="'.$date_limite.'" WHERE id_demande='.$id_demande.';';
    } else if ($action == 'Delete') {
        $query_projets = 'DELETE FROM fichier WHERE id_demande='.$id_demande.';';
        $projets = $connect->query($query_projets);
        $query_projets = 'DELETE FROM demande WHERE id_demande='.$id_demande.';';
    }
    
    $projets = $connect->query($query_projets);
    mysqli_close($connect);
    header('Location: ../voila.html');
    exit;
?>