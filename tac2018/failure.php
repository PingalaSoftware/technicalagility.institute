<?php
$status=$_POST["status"];
$mihpayid = $_POST["mihpayid"];
$mode = $_POST["mode"];
$unmappedstatus = $_POST["unmappedstatus"];
$key = $_POST["key"];
$txnid = $_POST["txnid"];
$amount = $_POST["amount"];
$addedon = $_POST["addedon"];
$productinfo = $_POST["productinfo"];
$firstname = $_POST["firstname"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$udf1 = $_POST["udf1"];
$udf2 = $_POST["udf2"];
$udf3 = $_POST["udf3"];
$udf4 = $_POST["udf4"];
$udf5 = $_POST["udf5"];
$hash = $_POST["hash"];
$field9 = $_POST["field9"];
$cardnum = $_POST["cardnum"];
$issuing_bank = $_POST["issuing_bank"];  // $udf1  '.$udf1.'
$card_type = $_POST["card_type"];
$salt="oxZHBdWr";

If (isset($_POST["additionalCharges"])) {
       $additionalCharges=$_POST["additionalCharges"];
        $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'||||||'.$udf5.'|'.$udf4.'|'.$udf3.'|'.$udf2.'|'.$udf1.'|'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
        
                  }
	else {	  

        $retHashSeq = $salt.'|'.$status.'||||||'.$udf5.'|'.$udf4.'|'.$udf3.'|'.$udf2.'|'.$udf1.'|'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;

         }
		 $hash = hash("sha512", $retHashSeq);
		 

		 
       if ($hash != $posted_hash) {
	       echo "Invalid Transaction. Please try again";
		   }
	   else {
           	   
          echo "<h3>Thank You. Your order status is ". $status .".</h3>";
		  echo "<h4>Your transaction id for this transaction is ".$txnid.". You may try making the payment by clicking the link below.</h4>";
           
		   }         
?>	

<!--Please enter your website homepagge URL -->
<input action="action" onclick="window.history.go(-2); return false;" type="button" value="Try Again" />
<a href="http://tac2018.com">Go to Home Page</a>
