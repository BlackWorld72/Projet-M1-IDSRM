<?php
//require_once $_SERVER['DOCUMENT_ROOT'] .'/Projet-M1-IDSRM/phpCAS/connect_cas.php'; 
//$mail = phpCAS::getAttributes()['mail'];
session_start();
//gestion du type d'utilisateur
require_once($_SERVER['DOCUMENT_ROOT'] .'/Projet-M1-IDSRM/PHP/connect_bdd.php');

$query_role = 'SELECT role FROM role WHERE email="'.$mail.'"';
$result = mysqli_fetch_array($connect->query($query_role));
if(isset($result[0])){
    $_SESSION["user_type"] = $result[0];
}else{
    $_SESSION["user_type"] = "utilisateur";
}
mysqli_close($connect);
?>