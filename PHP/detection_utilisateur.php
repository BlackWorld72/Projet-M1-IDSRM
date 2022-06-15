<?php
  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }
//AVEC CAS
require_once $_SERVER['DOCUMENT_ROOT'] .'/phpCAS/connect_cas.php'; 
$_SESSION['idsrm_login_cas'] = phpCAS::getUser();
$_SESSION['user_prenom'] = phpCAS::getAttributes()['givenName'];
$_SESSION['user_nom'] = phpCAS::getAttributes()['Sn'];
$_SESSION['user_mail'] = phpCAS::getAttributes()['mail'];

//EN LOCAL SANS CAS 
/*
session_start();
$_SESSION['idsrm_login_cas'] = "s172746";
$_SESSION['user_prenom'] = "Valentin";
$_SESSION['user_nom'] = "Girod";
$_SESSION['user_mail'] = "valentin.girod.etu@univ-lemans.fr";
*/

//gestion du type d'utilisateur
require_once($_SERVER['DOCUMENT_ROOT'] .'/PHP/connect_bdd.php');

$query_role = 'SELECT role FROM role WHERE email="'.$_SESSION['user_mail'].'"';
$result = mysqli_fetch_array($connect->query($query_role));
if(isset($result[0])){
    $_SESSION["user_type"] = $result[0];
}else{
    $_SESSION["user_type"] = "utilisateur";
}
mysqli_close($connect);

//$_SESSION["user_type"] = "utilisateur";

?>
