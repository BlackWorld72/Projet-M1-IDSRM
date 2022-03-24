<?php

$m = json_decode(file_get_contents('php://input'), true);
$mail['sender'] = $m[0];
$mail['content'] = $m[1];
$mail['subject'] = $m[3];
$mail['to'] = $m[2];
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
$message = $content;

if(is_array($to)){
    foreach($to as $cible){
        mail($cible, $subject, $message, $headers);
    }
}
else{
    mail($to, $subject, $message, $headers);
}

?>
