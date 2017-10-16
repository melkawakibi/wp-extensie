<?php

require_once(WSS_EXTESION_DIR . '/includes/script/class.RequestService.php');

$request_service = new RequestService();
$currentUser = new CurrentUser;

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
					<option value="Quickscan">Quick scan</option>

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
					<input type="email" name="alt_email">

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
		<div class="wrapper">

			<p> Bedankt voor het instaleren van SecurityReport Pandora </p>

			<p>	Voer een snelle scan uit op uw website en zie of uw website kwetsbaarheden heeft.
				Dit is een standaard account voor een Premium account kunt u contact opnemen met S5. </p>

			<p>	Met de Premiumaccount kunt u meer uit Pandora halen.</p>
				<p>Scan op meerdere kwetsbaarheden:</p>
				<ul>
					<li>SQLi</li>
					<li>XSS</li>
				</ul>

			<ul>
				<li>Contactgegevens</li>
				<li>[adres]</li>
				<li>[telefoonnummer]</li>
			</ul>

			<form action="<?php echo $_SERVER['PHP_SELF'] . '?page=Web_App_Scanner_menu' ?>" method="post">
				
				<input type="hidden" name="type" value="Quickscan">
				<input type="hidden" name="report" value="short-report">

				<input type="submit" name="send" value="Snelle scan">

			</form>
			


		</div>
	</body>
</html>

<?php
}else if($auth->state === 0){
?>

<html>
	<body>
		<div class="wrapper">

			<h1>Register</h1>

			<hr>
					
			<form action="<?php echo $_SERVER['PHP_SELF'] . '?page=Web_App_Scanner_menu' ?>" method="post">

				<label>Naam</label>
				<input type="text" name="register_name">

				<label>Bedrijf</label>
				<input type="text" name="register_company">

				<label>E-mail</label>
				<select id="email" name="email">
					<option value="<?php echo $currentUser->getEmail() ?>"><?php echo $currentUser->getEmail() ?></option>
					<option value="alt-email">Alternatieve E-mail</option>
				</select>

				<div class="email-wrapper">
					<label>Alternatieve E-mail</label>
					<input type="text" name="alt_email">
				</div>

				<label>token</label>
				<input id="token" type="password" name="token">

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
	$email = '';
	$token = '';

	if(isset($_POST['alt_email'])){
		$email = $_POST['alt_email'];
	}

	if(isset($_POST['token'])){
		$token = md5(uniqid($_POST['token'], true));
	}else{
		$token = md5(generateRandomString(), true);
	}

	$user = array('register_name' => $name, 'register_company' => $company, 'alt_email' => $email, 'token' => $token);

	if(!empty($name) && !empty($company)){

		add_token($token);	

		$request_service->register($user);

		echo '<script>window.location.href= "' . $_SERVER['HTTP_REFERER'] . '"</script>';

	}else{

		echo '<h2> Naam en Bedrijf zijn verplichte velden </h2>';
	
	}
}

if(!empty($_POST['send'])){

	$name = $_POST['request_name'];
	$company = $_POST['request_company'];
	$email = $_POST['alt_email'];
	$type = $_POST['type'];
	$report_type = $_POST['report'];

	$user = array('request_name' => $name, 'request_company' => $company, 'request_email' => $email, 'type' => $type, 'report' => $report_type);

	$request_service->scan($user);

}

function add_token($token)
{
	add_option('token', $token);
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

?>