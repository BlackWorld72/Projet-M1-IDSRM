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

$id_demande = securiser($_POST['id_demande']);
$suivi_demande = securiser($_POST['suivi_demande']);

print($suivi_demande);
print($id_demande);

if  ($suivi_demande === "Terminée") {
    $query_roles = $connect->prepare("UPDATE demande SET etat_demande=?, suivi_demande=? WHERE id_demande=?;");
    $query_roles->bind_param('sss', $suivi_demande,$suivi_demande, $id_demande);

    $query_roles->execute();
} else {
    $query_roles = $connect->prepare("UPDATE demande SET suivi_demande=? WHERE id_demande=?;");
    $query_roles->bind_param('ss', $suivi_demande, $id_demande);

    $query_roles->execute();
}

mysqli_close($connect);
header('Location: /Projet-M1-IDSRM/HTML/validation.php');
exit;