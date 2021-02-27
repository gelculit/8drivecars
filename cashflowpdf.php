<?php include "../../8driveAdmin/db.php"; ?>

<?php
require_once __DIR__ . '/vendor/autoload.php';


$checkfrom = $_GET['checkfrom'];
$checkto = $_GET['checkto'];
$paymadetotal = $_GET['paymadetotal'];
$stamp_indate = $_GET['stamp_indate'];
$stamp_retdate = $_GET['stamp_retdate'];
$paymadetotalform = number_format($paymadetotal, 2);

$start_day = date('d', $stamp_indate);
//$start_month = date('F', $stamp_indate);
$start_month = date('M', $stamp_indate);
$start_year = date('Y', $stamp_indate);
									
$end_day = date('d', $stamp_retdate);
//$end_month = date('F', $stamp_retdate);
$end_month = date('M', $stamp_retdate);
$end_year = date('Y', $stamp_retdate);

$placeholdfrom = "{$start_month} {$start_day}  {$start_year}";
$placeholdto = "{$end_month} {$end_day} {$end_year}";

$title = "{$start_month}{$start_day}to{$end_month}{$end_day}";

//create mpdf instance
$mpdf = new \Mpdf\Mpdf();


//create PDF
$data = '';



$data .= '<div class="container">';
$data .= '<div class="row">';

$data .= '<div  class="col-md-6">';
$data .= '<table class="table table-bordered table-hover table-striped table-condensed">';
											
$data .= '<tbody>';
												
$data .= '<tr>';
$data .= '<td><h6><strong><center>' . $placeholdfrom . ' To ' . $placeholdto . '</center></strong></h6></td>';
$data .= '</tr>';
$data .= '</tbody>';
$data .= '</table>';
$data .= '</div>';
		
							
$data .= '<div  class="col-md-6">';
$data .= '<table class="table table-bordered table-hover">';
											
$data .= '<tbody>';
												
$data .= '<tr>';
$data .= '<td><h6><strong>Total Amount:</strong></h6></td>';
$data .= '<td><h6><strong>Php ' . $paymadetotalform . '</strong></h6></td>';
$data .= '</tr>';
$data .= '</tbody>';
$data .= '</table>';
$data .= '</div>';




$data .= '<table class="table table-bordered table-hover table-striped table-condensed">';
								
$data .= '<thead>';
$data .= '<tr>';
$data .= '<th><strong><center>Date</center></strong></th>';
$data .= '<th><strong><center>Total Daily Amount</center></strong></th>';
										   
																					
$data .= '</tr> ';
$data .= '</thead>';




$cashQuery = "SELECT * FROM car_cash_inventory WHERE car_rent_status = 'Completed / Returned'";
$cashQuery = mysqli_query($connection, $cashQuery);
				
while($row = mysqli_fetch_assoc($cashQuery)) {
	
	$date_completed = $row['date_completed'];
	$date_completed1 = strtotime($date_completed);
					
	if($date_completed1 >= $stamp_indate AND $date_completed1 <= $stamp_retdate) {

		$cash_day = date('d', $date_completed1);
		$cash_month = date('M', $date_completed1);
		$cash_year = date('Y', $date_completed1);
		$pay_date =  "{$cash_month} {$cash_day}, {$cash_year}";
		$pay_made = $row['actual_payment_made'];
		$pay_made = number_format($pay_made,2);
		
		
		
		$data .= '<tbody>';
		$data .= '<tr>';
		$data .= '<td><center><strong>{$pay_date}</strong></center></td>';
		$data .= '<td><center><strong>{$pay_made}</strong></center></td>';
		$data .= '</tr>';
		$data .= '</tbody>';
		
	}				


}






$data .= '</div>'; //row
$data .= '</div>'; //container



//write PDF
$mpdf->WriteHTML($data);

//output to browser;
$mpdf->Output($title . '.pdf', 'D')

//header("Location: cashflow.php");


?>