<?php
include 'db.php';

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

$id = $_GET['ID'];
$id = mysqli_real_escape_string($conn, $id);

$publish_note = mysqli_query($conn, "UPDATE downloads SET IsSellerHasAllowedDownload=1 WHERE ID=$id");

if($publish_note){
    echo "connected";
}
else{
    echo "not".mysqli_error($conn);
}
if ($publish_note){
    header('Location:dashboard.php');
    
    $query="SELECT SellerID,SellerName,Note_Title FROM notes where ID=$id";
	$result= mysqli_query($conn, $query);
	while($row=mysqli_fetch_assoc($result)){
		$sellerid=$row['SellerID'];
		$title=$row['Note_Title'];
	}
	$query="SELECT FirstName, LastName, EmailID FROM users where ID=$sellerid";
	$result=mysqli_query($conn,$query);
	while($row=mysqli_fetch_array($result)){	  
		$sellername=$row['FirstName'];
	}
	
	$query="SELECT DownloaderID FROM downloads WHERE ID=$id";
	$result= mysqli_query($conn, $query);
	while($row=mysqli_fetch_assoc($result)){
	$downloaderid=$row['DownloaderID'];
	}
	
	$query="SELECT FirstName, LastName, EmailID FROM users where ID=$downloaderid";
	$result=mysqli_query($conn,$query);
	while($row=mysqli_fetch_array($result)){
		
		$fname=$row['FirstName'];
		$email=$row['EmailID'];
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
    $mail->addAddress("axita31.khunt@gmail.com");

    $mail->IsHTML(true);
    $mail->Subject = "$fname  Allows you to download a note";
    $mail->Body = "Hello Admins,  $fname
                 <br><br>
                We would like to inform you that, $sellername Allows you to download a note. Please login and see My Download tabs to download particular note. 
                  <br><br>
                Regards,  Notes Marketplace";
				
				
				
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

?>