<?php
require 'PHPMailerAutoload.php';

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
if (!isset($_GET['page']))
{
	$num = 1;
}
else
{
	$num = $_GET['page'];
}

$result = $liaisonbdd->query("SELECT * from email where id=".$num);
$resultRequete = 0;
while($row = $result->fetch_assoc())
{
	$num=$num+1;
	$resultRequete=1;
	
	
	$mail = new PHPMailer;                            
	$mail->isSMTP();                                    
	$mail->Host = 'smtp.gmail.com;'; 
	$mail->SMTPAuth = true;                               
	$mail->Username = 'votre adresse email ';                 
	$mail->Password = 'votre mot de passe ';                          
	$mail->SMTPSecure = 'ssl';                           
	$mail->Port = 465;                                    
	$mail->setFrom('thomasvieux043002@gmail.com', 'thomas');             
	$mail->addReplyTo('thomasvieux043002@gmail.com', 'Information');
	$mail->isHTML(true);                                
	$mail->Subject = 'Newletters';
	$mail->Body    = "Bonjour <b>".$row['nom']."</b>";
	$mail->Body    .= "<a href='http://localhost/mail/desabonnement.php?id=".$row['id'].">Se désabonner</a>";
	
	
	$mail->addAddress($row['email'], $row['nom']);
		if(!$mail->send()) {
			echo 'Message could not be sent.';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
			
		} else {
			echo 'Message has been sent';
		}
		sleep(1);
}
if ($resultRequete==1)
{
header("Location: index.php?page=$num");
}