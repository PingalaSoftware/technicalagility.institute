<?php
ob_start();
session_start(); 
$status=$_POST["status"];
$mihpayid = $_POST["mihpayid"];
$mode = $_POST["mode"];
$unmappedstatus = $_POST["unmappedStatus"];
$key = $_POST["key"];
$txnid = $_POST["txnid"];
$amount = $_POST["amount"];
$date_time = $_POST["addedon"];
$productinfo = $_POST["productinfo"];
$name = $_POST["firstname"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$company = $_POST["udf1"];
$designation = $_POST["udf2"];
$udf3 = $_POST["udf3"];
$udf4 = $_POST["udf4"];
$udf5 = $_POST["udf5"];
$hash = $_POST["hash"];
$field9 = $_POST["field9"];
$cardnum = $_POST["cardnum"];
$issuing_bank = $_POST["issuing_bank"];  // $udf1  '.$udf1.'
$card_type = $_POST["card_type"];
$salt="eCwWELxi";

If (isset($_POST["additionalCharges"])) {
       $additionalCharges=$_POST["additionalCharges"];
        $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'||||||'.$udf5.'|'.$udf4.'|'.$udf3.'|'.$designation.'|'.$company.'|'.$email.'|'.$name.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
        
                  }
	else {	  

        $retHashSeq = $salt.'|'.$status.'||||||'.$udf5.'|'.$udf4.'|'.$udf3.'|'.$designation.'|'.$company.'|'.$email.'|'.$name.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;

         }
		 $hash = hash("sha512", $retHashSeq);
		 





		 
       if ($hash != $posted_hash) {
	    //   echo "We have received your pa. Please try again";
		    $servername = "localhost:3306";
			$username = "tac2018db";
			$password = "f2xPs05@";
			$dbname = "a17fd878f_";

			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
			} 

			$sql = "INSERT INTO tac_payment VALUES ('$status', '$mihpayid', '$mode', '$txnid', '$amount', '$date_time', '$productinfo', '$name', '$email', '$phone', '$company', '$designation', '$field9', '$cardnum')";

		if ($conn->query($sql) === TRUE) {
			//echo '<script language="javascript">';
			 //echo 'alert("We have received your payment. Thanks, see you in conference!")';
			 //echo '</script>';
			//echo "<meta http-equiv='refresh' content='0;url='index.html'>";
		echo "We have received your payment. Thanks, see you in conference! <br><a href='http://tac2018.com'>Click here </a> to go conference page";
		} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
		}

		$conn->close();

		   }
	   else {
// Email Template Code //
//@extract($_POST);
$to="info@pingalasoftware.com";
$subject="Order-".$txnid." (Pingala Software)";
$message="<html>
<head>
<title>Order-".$txnid." (Pingla Software)</title>
</head>
<body>
<table width='100%' cellpadding='0' cellspacing='0' border='0' style='line-height:25px;'>
 <tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;padding-left:10px;border-bottom:1px solid #CCCCCC; border-right:1px solid #CCCCCC;'>Name: </td><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;padding-left:10px;border-bottom:1px solid #CCCCCC;'>$firstname</td></tr>
 
 <tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;padding-left:10px;border-bottom:1px solid #CCCCCC; border-right:1px solid #CCCCCC;'>Email Id: </td><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;padding-left:10px;border-bottom:1px solid #CCCCCC;'>$email</td></tr>

<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;padding-left:10px;border-bottom:1px solid #CCCCCC; border-right:1px solid #CCCCCC;'>Phone No: </td><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;padding-left:10px;border-bottom:1px solid #CCCCCC;'>$phone</td></tr>
<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;padding-left:10px;border-bottom:1px solid #CCCCCC; border-right:1px solid #CCCCCC;'>Amount: </td><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;padding-left:10px;border-bottom:1px solid #CCCCCC;'>$amount</td></tr>

  
<tr><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;padding-left:10px;border-bottom:1px solid #CCCCCC; border-right:1px solid #CCCCCC;'>Product: </td><td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;padding-left:10px;border-bottom:1px solid #CCCCCC;'>$productinfo</td></tr>

<tr>

<td style='font-family:Arial, Helvetica, sans-serif; font-size:12px;' colspan='2' align='right'>http://tac2018.com/</td>

  </tr>

</table>

</body>
</html>";
$from="support@pingalasoftware.com";
$headers = "From: Order <$from>\n";
$headers .= "MIME-Version: 1.0\n";
$headers .= "Return-Path: <$from>\n";
$headers .= "Content-Type: text/html;\n";
$headers .= "X-Mailer: PHP/" . phpversion();
//echo $message;	
 //Additional headers
	// Mail it
mail($to,$subject,$message,$headers);
// End ///		   
		   
echo "<h3>Thank You. Your order status is ". $status .".</h3>";
          echo "<h4>Your Transaction ID for this transaction is ".$txnid.".</h4>";
          echo "<h4>We have received a payment of Rs. " . $amount . ". Your order will soon be shipped.</h4>";
           
		   }         
?>	