<?php
$host="localhost";
$user="root";
$password="";
$nombdd="mail";
$table="email";


$liaisonbdd = new mysqli($host, $user, $password, $nombdd);
if($liaisonbdd->connect_errno)
{
	echo "Echec lors de la connexion à Mysql : (".$liaisonbdd->connect_errno.")".$liaison->connect_error;
}

if(isset($_GET['id'])){
  $result = $liaisonbdd->query("Update email set valide=0 where id=".$_GET['id']."");
  echo "Update email set valide=0 where id=".$_GET['id']."";
  if($liaisonbdd->query("Update email set valide=0 where id=".$_GET['id']."")){
    echo "Vous ne receverez plus la Newsletter";
  }
}else{
  echo "erreur";
}

?>

