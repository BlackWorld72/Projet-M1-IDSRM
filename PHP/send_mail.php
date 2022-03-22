<?php

if(!isset($mail)){
    $mail = json_decode($_POST['extra'], true);
}
$sender = "ne-pas-repondre@idsrm.univ-lemans.fr";
if( isset( $mail['sender'] ) ){
    $sender = $mail['sender'];
}

$content = $mail['content'];

ob_start();
require 'Administrateur/select_role.php';
$roles = json_decode(ob_get_clean());
ob_end_clean();

$i = 0;
if(strcmp($mail['to'], "administrateur") == 0){
    foreach ($roles as $role) {
        if(strcmp($role['role'], "administrateur") ==0){
            $to[$i++] = $role['email'];
        }
    }
}else{
    $to = $mail['to'];
}



$subject = '[IDSRM] - '.$mail['subject'];
$message = $content;
$headers = 'From: '. $sender . "\r\n" .
    'Reply-To: ' . $sender . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

if(is_array($to)){
    foreach($to as $cible){
        mail($cible, $subject, $message, $headers);
    }
}
else{
    mail($to, $subject, $message, $headers);
}
?>
