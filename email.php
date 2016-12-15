<?php
require 'PHPMailerAutoload.php';
$mysqli = new mysqli("mysql.eecs.ku.edu", "slopez", "Password123!", "slopez");

if ($mysqli->connect_errno) 
{
	printf("Connect failed: %s\n", $mysqli->connect_error);
	exit();
}

session_start();

$groupAdmin = $_SESSION['GroupAdmin'];
$email = $_SESSION['Email'];
$emailGroup = $_SESSSION['EmailGroup'];
$message = $_SESSION['Message'];

$mail = new PHPMailer;
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.mailgun.org';                     // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'postmaster@sandbox6a69e3c5a27c4e62933347af7f951235.mailgun.org';   // SMTP username
$mail->Password = '1df753c05888dcbe7fac82f6f73ffd9d';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable encryption, only 'tls' is accepted

if($emailGroup == "true")
{

}
else
{
	//if($other != "notset")
	/*{
		$mail->From = 'postmaster@sandbox6a69e3c5a27c4e62933347af7f951235.mailgun.org';
		$mail->FromName = 'BillMe';
		$mail->addAddress(9135757472@pm.sprint.com);                 // Add a recipient
		
		$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
	
		$mail->Subject = 'New Activity from BillMe';
		$mail->Body    = "hi";
	
		if(!$mail->send()) {
		    echo 'Message could not be sent.';
		    echo 'Mailer Error: ' . $mail->ErrorInfo;
		} 
		else 
		{
		    echo 'Message has been sent';
		}
	*/

	$mail->From = 'postmaster@sandbox6a69e3c5a27c4e62933347af7f951235.mailgun.org';
	$mail->FromName = 'BillMe';
	$mail->addAddress($email);                 // Add a recipient
	
	$mail->WordWrap = 50;                                 // Set word wrap to 50 characters

	$mail->Subject = 'New Activity from BillMe';
	$mail->Body    = $message;

	if(!$mail->send()) {
	    echo 'Message could not be sent.';
	    echo 'Mailer Error: ' . $mail->ErrorInfo;
	} 
	else 
	{
	    echo 'Message has been sent';
	}
}



