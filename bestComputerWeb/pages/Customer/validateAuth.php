<?php
//sette page vérifie qu'il s'agit bien d'un employé
//connection à la base de donné
	include_once("../../bd/config.php"); 
  $user = null;
  if(empty($_SESSION) || !$_SESSION) {
    session_start();
  }
 
 if($_SESSION['email'] && $_SESSION["role"] != "employe"){
  $query = "SELECT * FROM user WHERE email = '".$_SESSION["email"]."' limit 1";
  $res = mysqli_query($conn, $query);
  $user = mysqli_fetch_assoc($res);
  if (!$user) {
    header("Location: ../error.php");
  }
 } else {
   header("Location: ../error.php");
 }
 ?>
