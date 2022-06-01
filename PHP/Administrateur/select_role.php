<?php
    require_once($_SERVER['DOCUMENT_ROOT'] .'/Projet-M1-IDSRM/PHP/connect_bdd.php');
    if(strcmp("administrateur", $_SESSION["user_type"])!=0) return false;
    $query_roles = "SELECT * FROM role";
    $resultat_roles = $connect->query($query_roles);

    $id_role = 0;
    $roles = [];

    while ($row = mysqli_fetch_array($resultat_roles)) {
        $roles[] = $row;
        $id_role++;
    }
    mysqli_close($connect);

    echo json_encode($roles);

exit;
