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
$etat_demande = securiser($_POST['etat_demande']);
$mail_demandeur = $_POST['mail_demandeur'];

if ($etat_demande === "En cours") {
    $query_roles = $connect->prepare("UPDATE demande SET etat_demande=?, suivi_demande=? WHERE id_demande=?;");
    $query_roles->bind_param('sss', $etat_demande,$suivi_demande, $id_demande);

    $query_roles->execute();
} else if  ($suivi_demande === "Terminée") {
    $query_roles = $connect->prepare("UPDATE demande SET etat_demande=?, suivi_demande=? WHERE id_demande=?;");
    $query_roles->bind_param('sss', $suivi_demande,$suivi_demande, $id_demande);

    $query_roles->execute();
} else {
    $query_roles = $connect->prepare("UPDATE demande SET suivi_demande=? WHERE id_demande=?;");
    $query_roles->bind_param('ss', $suivi_demande, $id_demande);

    $query_roles->execute();
}

mysqli_close($connect);

//envoie d'un mail pour notifier l'utilisateur
$url = "/Projet-M1-IDSRM/PHP/send_mail.php";
$content[0] = null;
$content[1] = "Votre demande de réalisation mécanique a évoluée à l'état suivant: ".$suivi_demande;
$content[2] = "Suivi de votre demande";
$content[3] = $mail_demandeur;  
$content = json_encode($content);

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER,
        array("Content-type: application/json"));
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $content);

$json_response = curl_exec($curl);
$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);


if ( $status != 201 ) {
    die("Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
}


curl_close($curl);


header('Location: /Projet-M1-IDSRM/HTML/validation.php');
exit;