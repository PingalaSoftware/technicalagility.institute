<?php
// Merchant key here as provided by Payu
//$MERCHANT_KEY = "gtKFFx";
$MERCHANT_KEY = "T4GpMY";
// Merchant Salt as provided by Payu
//$SALT = "eCwWELxi";
$SALT = "oxZHBdWr";
// End point - change to https://secure.payu.in for LIVE mode
// End point - change to https://test.payu.in for TEST mode
//$PAYU_BASE_URL = "https://test.payu.in";
$PAYU_BASE_URL = "https://secure.payu.in";
$action = '';

$posted = array();
if (!empty($_POST)) {
	//print_r($_POST);
	foreach ($_POST as $key => $value) {
		$posted[$key] = $value;
	}
}


$formError = 0;

if (empty($posted['txnid'])) {
	// Generate random transaction id
	$txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
} else {
	$txnid = $posted['txnid'];
}
$hash = '';
// Hash Sequence
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
if (empty($posted['hash']) && sizeof($posted) > 0) {
	if (
		empty($posted['key'])
		|| empty($posted['txnid'])
		|| empty($posted['amount'])
		|| empty($posted['firstname'])
		|| empty($posted['email'])
		|| empty($posted['phone'])
		|| empty($posted['productinfo'])
		|| empty($posted['udf1'])
		|| empty($posted['udf2'])
		|| empty($posted['surl'])
		|| empty($posted['furl'])
	) {
		$formError = 1;
	} else {
		$hashVarsSeq = explode('|', $hashSequence);
		$hash_string = '';
		foreach ($hashVarsSeq as $hash_var) {
			$hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
			$hash_string .= '|';
		}

		$hash_string .= $SALT;


		$hash = strtolower(hash('sha512', $hash_string));
		$action = $PAYU_BASE_URL . '/_payment';
	}
} elseif (!empty($posted['hash'])) {
	$hash = $posted['hash'];
	$action = $PAYU_BASE_URL . '/_payment';
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="assets/img/favicon.png">
	<title>Technical Agility Conference</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Akronim">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Amaranth">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Black+Ops+One">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Monoton">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Pacifico">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.css">
	<link rel="stylesheet" href="assets/css/styles.min.css">

</head>

<body onLoad="submitPayuForm()">
	<div>
		<nav class="navbar navbar-dark navbar-expand-md fixed-top" style="color:#ffffff;width:100%;background-color:rgba(0,0,0,0.74);">
			<div class="container"><a class="navbar-brand" href="index.html" id="brand">TAC2018</a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
				<div class="collapse navbar-collapse" id="navcol-1">
					<ul class="nav navbar-nav ml-auto" id="nav-id" style="font-family:Amaranth, sans-serif;">
						<li class="nav-item" role="presentation"><a class="nav-link active" href="index.html">Home</a></li>
						<li class="nav-item" role="presentation"><a class="nav-link active" href="http://tac2018.com/#register">Register</a></li>
						<li class="nav-item" role="presentation"><a class="nav-link active" href="schedule.html" style="color:#ef741d">Schedule</a></li>
						<li class="nav-item" role="presentation"><a class="nav-link active" href="http://tac2018.com/#topic">Topics</a></li>
						<li class="nav-item" role="presentation"><a class="nav-link active" href="http://tac2018.com/#speaker">Speaker</a></li>
						<li class="nav-item" role="presentation"><a class="nav-link active" href="http://tac2018.com/#sponsors">Sponsors</a></li>
						<li class="nav-item" role="presentation"><a class="nav-link active" href="http://tac2018.com/#partner">Partner</a></li>
						<li class="nav-item" role="presentation"><a class="nav-link active" href="http://tac2018.com/#team">Team</a></li>
						<li class="nav-item" role="presentation"><a class="nav-link active" href="team-award.html">Team Award</a></li>
						<li class="nav-item" role="presentation"><a class="nav-link active" href="http://tac2018.com/#contact">Contact</a></li>
					</ul>
				</div>
			</div>
		</nav>
	</div>
	<div class="features-blue" style="background:linear-gradient(135deg,#65A0F8,#1A111E);" id="speaker">
		<div class="container">
			<div class="intro">
				<h2 class="text-center" style="padding-top:100px;">Checkout</h2>
				<hr>
				<p class="text-center"></p>
			</div>
			<div class="row">
				<div class="col-md-4">
				</div>
				<div class="col-md-4">
					<!-- Custom Code -->

					<?php if ($formError) { ?>

						<span style="color:red">Please fill all mandatory fields.</span>
						<br />
						<br />
					<?php } ?>
					<div class="form-area">
						<form action="<?php echo $action; ?>" method="post" name="payuForm">
							<input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
							<input type="hidden" name="hash" value="<?php echo $hash ?>" />
							<input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
							<input type="hidden" name="amount" value="<?php echo (empty($posted['amount'])) ? '' : $posted['amount'] ?>" />
							<input type="hidden" name="productinfo" value="<?php echo (empty($posted['productinfo'])) ? '' : $posted['productinfo'] ?>" />

							<br style="clear:both">
							<h3 style="margin-bottom: 20px; text-align: center; color:#111;">Your Details*</h3>

							<div class="form-group">
								<input class="form-control" name="firstname" id="firstname" value="<?php echo (empty($posted['firstname'])) ? '' : $posted['firstname']; ?>" placeholder="Name*" required="required" />
							</div>
							<div class="form-group">
								<input class="form-control" name="email" id="email" value="<?php echo (empty($posted['email'])) ? '' : $posted['email']; ?>" placeholder="Email*" required="required" />
							</div>
							<div class="form-group">
								<input class="form-control" name="phone" value="<?php echo (empty($posted['phone'])) ? '' : $posted['phone']; ?>" placeholder="Phone No*" required="required" />
							</div>
							<div class="form-group">
								<input class="form-control" name="udf1" value="<?php echo (empty($posted['udf1'])) ? '' : $posted['udf1']; ?>" placeholder="Company*" required="required" />
							</div>
							<div class="form-group">
								<input class="form-control" name="udf2" value="<?php echo (empty($posted['udf2'])) ? '' : $posted['udf2']; ?>" placeholder="Designation*" required="required" />
							</div>
							<input type="hidden" name="surl" value="http://tac2018.com/success.php" size="64" />
							<input type="hidden" name="furl" value="http://tac2018.com/failure.php" size="64" /></td>

							<!--  <tr>
								  <td><b>Optional Parameters</b></td>
								</tr>
								<tr>
								  <td>Last Name: </td>
								  <td><input name="lastname" id="lastname" value="<?php echo (empty($posted['lastname'])) ? '' : $posted['lastname']; ?>" /></td>
								  <td>Cancel URI: </td>
								  <td><input name="curl" value="" /></td>
								</tr>
								<tr>
								  <td>Address1: </td>
								  <td><input name="address1" value="<?php echo (empty($posted['address1'])) ? '' : $posted['address1']; ?>" /></td>
								  <td>Address2: </td>
								  <td><input name="address2" value="<?php echo (empty($posted['address2'])) ? '' : $posted['address2']; ?>" /></td>
								</tr>
								<tr>
								  <td>City: </td>
								  <td><input name="city" value="<?php echo (empty($posted['city'])) ? '' : $posted['city']; ?>" /></td>
								  <td>State: </td>
								  <td><input name="state" value="<?php echo (empty($posted['state'])) ? '' : $posted['state']; ?>" /></td>
								</tr>
								<tr>
								  <td>Country: </td>
								  <td><input name="country" value="<?php echo (empty($posted['country'])) ? '' : $posted['country']; ?>" /></td>
								  <td>Zipcode: </td>
								  <td><input name="zipcode" value="<?php echo (empty($posted['zipcode'])) ? '' : $posted['zipcode']; ?>" /></td>
								</tr>
								<tr>
								  <td>UDF1: </td>
								  <td><input name="udf1" value="<?php echo (empty($posted['udf1'])) ? '' : $posted['udf1']; ?>" /></td>
								  <td>UDF2: </td>
								  <td><input name="udf2" value="<?php echo (empty($posted['udf2'])) ? '' : $posted['udf2']; ?>" /></td>
								</tr>
								<tr>
								  <td>UDF3: </td>
								  <td><input name="udf3" value="<?php echo (empty($posted['udf3'])) ? '' : $posted['udf3']; ?>" /></td>
								  <td>UDF4: </td>
								  <td><input name="udf4" value="<?php echo (empty($posted['udf4'])) ? '' : $posted['udf4']; ?>" /></td>
								</tr>
								<tr>
								  <td>UDF5: </td>
								  <td><input name="udf5" value="<?php echo (empty($posted['udf5'])) ? '' : $posted['udf5']; ?>" /></td>
								  <td>PG: </td>
								  <td><input name="pg" value="<?php echo (empty($posted['pg'])) ? '' : $posted['pg']; ?>" /></td>
								</tr>-->
							<?php if (!$hash) { ?>
								<input type="submit" class="btn btn-success" value="Pay Now" />
							<?php } ?>

						</form>

					</div>

				</div>
			</div>

		</div>
	</div>
	<div class="footer-dark" id="contact">
		<footer>
			<div class="container">
				<div class="row">
					<div class="col-md-6 item contact text-center"><a href="tel:+91 63614 58940" style="color:#fff;text-decoration:none;"><i class="icon ion-ios-telephone"></i> +91 821 070 1149</a></div>
					<div class="col item contact text-center"><a href="mailto:info@tac2018.com" style="color:#fff;text-decoration:none;"><i class="icon ion-ios-email"></i> info@tac2018.com</a></div>
				</div><br>
				<div class="row">
					<div class="col-md-12 item social"><a href="https://www.facebook.com/TechAgileConf"><i class="icon ion-social-facebook"></i></a><a href="https://twitter.com/TechAgilConf"><i class="icon ion-social-twitter"></i></a><a href="https://www.linkedin.com/company/technical-agility-conference"><i class="icon ion-social-linkedin"></i></a><a href="#"><i class="icon ion-social-googleplus"></i></a></div>
				</div>
				<p class="copyright">Copyright © 2018 TAC2018, All rights reserved.</p>
			</div>
		</footer>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.js"></script>
</body>

</html>
<script>
	var hash = '<?php echo $hash ?>';

	function submitPayuForm() {
		if (hash == '') {
			return;
		}
		var payuForm = document.forms.payuForm;
		payuForm.submit();
	}
</script>