<?php
require('connection.inc.php');
require('functions.inc.php');

$email=get_safe_value($con,$_POST['email']);
$type=get_safe_value($con,$_POST['type']);
if($type=='email'){
    $email=get_safe_value($con,$_POST['email']);
    $otp=rand(1111,9999);
    $_SESSION['EMAIL_OTP']=$otp;
    $html="$otp is your OTP from Phoenix Computers";

    include('smtp/PHPMailerAutoload.php');
	$mail=new PHPMailer(true);
	$mail->isSMTP();
	$mail->Host="smtp.gmail.com";
	$mail->Port=587;
	$mail->SMTPSecure="tls";
	$mail->SMTPAuth=true;
	$mail->Username="phoenix.computers07@gmail.com";
	$mail->Password="jvpmytpugdoktrgk";
	$mail->SetFrom("phoenix.computers07@gmail.com");
	$mail->addAddress($email);
	$mail->IsHTML(true);
	$mail->Subject="New OTP";
	$mail->Body=$html;
	$mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
	));
    
	if($mail->send()){
		echo "done";
	}else{
		echo "Error occur";
	}
}

?>