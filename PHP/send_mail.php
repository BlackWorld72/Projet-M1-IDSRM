<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
require_once('detection_utilisateur.php');
        
//si l'utilisateur n'est pas authentifié il ne peux pas faire ça
if(!isset($_SESSION['idsrm_login_cas'])) return false;

$m = json_decode(file_get_contents('php://input'), true);
$mail['sender'] = $m[0];
$mail['content'] = $m[1];
$mail['to'] = $m[2];
$mail['subject'] = $m[3];


if(!isset($mail)){
    $mail = json_decode($_POST['extra'], true);
}

$sender = "ne-pas-repondre@idsrm.univ-lemans.fr";
if( isset( $mail['sender'] ) ){
    $sender = $mail['sender'];
}

$content = $mail['content'];

$current_url_path = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$url = substr($current_url_path, -4) == ".php" ?
    implode("/", array_slice((explode("/", $current_url_path)), 0, -1)) : $current_url_path;

$roles = [];
$roles = json_decode(file_get_contents($url.'/Administrateur/select_role.php'),true);

$i = 0;
$to = [];
if(strcmp($mail['to'], "administrateur") == 0){
    foreach ($roles as $role) {
        if(strcmp($role['role'], "administrateur") ==0){
            $to[$i++] = $role['email'];
        }
    }
}else{
    $to = $mail['to'];
}

$headers = 'From: '. $sender . "\r\n" .
    'Reply-To: ' . $sender . "\r\n" .
    'Content-type: text/plain; charset=UTF-8' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

$subject = '[IDSRM] - '.$mail['subject'];
$subject = '=?utf-8?B?'.base64_encode($subject).'?=';
$message = $content;

if(is_array($to)){
    foreach($to as $cible){
        mail($cible, $subject, $message, $headers);
    }
}
else{
    mail($to, $subject, $message, $headers);
}

//log utile en cas de spam de mails, dans /var/log/syslog
syslog(1, "L'utilisateur ".$_SESSION['idsrm_login_cas']." est responsable de l'envoie d'un mail.");

?>
