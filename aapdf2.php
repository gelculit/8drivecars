<?php

require_once __DIR__ . '/vendor/autoload.php';

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];

//create mpdf instance
$mpdf = new \Mpdf\Mpdf();


//create PDF
$data = '';

$data .= '<h1>Your Details</h1>';

//add data

$data .= '<strong>First Name</strong> ' . $fname . '<br />';
$data .= '<strong>Last Name</strong> ' . $lname . '<br />';
$data .= '<strong>Email</strong> ' . $email . '<br />';
$data .= '<strong>Phone</strong> ' . $phone . '<br />';

if($message) {
	$data .= '<br /><strong>Message</strong> <br />' . $message;
}

//write PDF
$mpdf->WriteHTML($data);

//output to browser;
$mpdf->Output('myfile.pdf', 'D')

?>