<?php
  $user = 'idrm';
  $database = 'idrm';
  $pwd = '8HLT88eGT6rM!&4q';
  $server = 'localhost';
  $connect = mysqli_connect($server, $user, $pwd, $database) or die("probleme de connexion dans la base de donnee $server");
  $connect->set_charset("utf8");
?>