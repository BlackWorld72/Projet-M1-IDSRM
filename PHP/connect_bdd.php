<?php
  mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
  $user = 'idrm';
  $database = 'idrm2';
  $pwd = '8HLT88eGT6rM!&4q';
  $server = 'localhost';
  $connect = mysqli_connect($server, $user, $pwd, $database) or die("probleme de connexion dans la base de donnee $server");
  $connect->set_charset("utf8");
  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }
?>