<?php

require_once(WSS_EXTESION_DIR . '/includes/script/class.RequestService.php');

$request_service = new RequestService();

$auth = json_decode($request_service->authenticate());

if($auth->state === 1 && $auth->active){
?>
	
<html>
	<body>
		<h1>Aanvraagformulier</h1>
		<div class="wrapper">
			<form action="<?php echo $_SERVER['PHP_SELF'] . '?page=Web_App_Scanner_menu' ?>" method="post">

				<select name="type">

					<option value="full">full scan</option>
					<option value="BlindSQL">Blind SQL injection</option>
					<option value="SQL">SQL injection</option>
					<option value="XSS">XSS</option>

				</select>

				<select name="report">
					
					<option value="full-report">Volledige report</option>
					<option value="short-report">Korte report</option>

				</select>				

				<input type="button" id="btn-toggle" value="Meer Opties">
				<div id="form-container">

					<p>Als u alternatieve naam en email wilt opgeven dan kan dat met deze twee velden.</p>

					<label>Naam</label>
					<input type="text" name="request_name">

					<label>Email</label>
					<input type="email" name="request_email">

				</div>

				<input type="submit" name="send" value="verstuur">						
			</form>
		</div>
	</body>
</html>

<?php
}else if($auth->state === 1 && !$auth->active){
?>

<html>
	<body>
		<h1>Aanvraag in behandeling</h1>
		<div class="wrapper">
			<p>Uw aanvraag is in behandeling. U ontvangt binnenkort een email met het resultaat van u aanvraag.</p>

			<p>Waneer ben u geschikt om een aanvraag voor een scan te doen?</p>
			<ul>
				<li>u bent klant bent bij S5.</li>
			</ul>

			<p>Zodra u voldoet aan de bovenstaande criteria wordt uw account geactiveerd en kunt u beginnen met het aanvragen van Web Applicatie scans.</p>

			<p>Heeft u geen email ontvangen neem dan contact op met S5.</p>
		</div>
	</body>
</html>

<?php
}else if($auth->state === 0){
?>

<html>
	<body>
		<h1>Register</h1>
		<div class="wrapper">
			<form action="<?php echo $_SERVER['PHP_SELF'] . '?page=Web_App_Scanner_menu' ?>" method="post">

				<label>Naam</label>
				<input type="text" name="register_name">

				<label>Bedrijf</label>
				<input type="text" name="register_company">

				<label>Email</label>
				<input type="email" name="register_email">

				<input type="submit" name="register" value="registreer">		
			</form>
		</div>
	</body>
</html>

<?php
}

if(!empty($_POST['register'])){

	$name = $_POST['register_name'];
	$company = $_POST['register_company'];
	$email = $_POST['register_email'];

	$user = array('register_name' => $name, 'register_company' => $company, 'register_email' => $email);

	if(!empty($name) && !empty($company) && !empty($email)){

		$request_service->register($user);

		echo '<script>window.location.href= "' . $_SERVER['HTTP_REFERER'] . '"</script>';

	}else{

		echo 'Vul alle velden in';
	
	}
}

if(!empty($_POST['send'])){

	$name = $_POST['request_name'];
	$company = $_POST['request_company'];
	$email = $_POST['request_email'];
	$type = $_POST['type'];
	$report_type = $_POST['report'];

	$user = array('request_name' => $name, 'request_company' => $company, 'request_email' => $email, 'type' => $type, 'report' => $report_type);

	$request_service->scan($user);

}


?>