<?php
include "db.php";

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

if(isset($_GET['id'])){
    $id = $_GET['id'];
}
   

echo $id;
$id = mysqli_real_escape_string($conn, $id);
$publish_note = mysqli_query($conn, "UPDATE notes SET Status=7 WHERE ID=$id");

if ($publish_note){
    header('Location:Dashboard-1.php');
    $query="SELECT SellerID,Note_Title FROM notes where ID=$id";
	$result= mysqli_query($conn, $query);
	while($row=mysqli_fetch_assoc($result)){
		$sellerid=$row['SellerID'];
		$title=$row['Note_Title'];
		
	}
	$query="SELECT FirstName, LastName, EmailID FROM users where ID=$sellerid";
	$result=mysqli_query($conn,$query);
	while($row=mysqli_fetch_array($result)){	  
	    $email=$row['EmailID'];
		$fname=$row['FirstName'];
		$lname=$row['LastName'];
	
	}
	
	$mail_sent=false;
	
	    require 'PHPMailer/Exception.php';
        require 'PHPMailer/PHPMailer.php';
        require 'PHPMailer/SMTP.php';

        $mail = new PHPMailer(true);

        try{
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = PHPMailer :: ENCRYPTION_STARTTLS;
                $mail->Port = 587;  
                $mail->Username = "axita31.khunt@gmail.com";
                $mail->Password = 'axita31khunt';

                // Sender and recipient settings
                $mail->setFrom("axita31.khunt@gmail.com", 'NotesMarketPlace');
                $mail->addAddress($email, $fname . $lname);
                $mail->addReplyTo("axita31.khunt@gmail.com", 'NotesMarketPlace');
                $mail->IsHTML(true);
                $mail->Subject = "$fname $lname sent his note for review ";
                $mail->Body = "Hello Admin,  <br><br>

                We want to inform you that, $fname $lname sent his note  <br>$title for review. Please look at the notes and take required actions.   
                <br><br>
                Regards,  Notes Marketplace ";
                $mail->AltBody = '';
                $mail->send();
                $mail_sent = true;
            } catch (Exception $e) {
                echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
            }
	
		  }	  
 else {
   echo "please try again";
}