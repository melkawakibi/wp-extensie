<?php

require_once(WSS_EXTESION_DIR . '/includes/script/class.RequestService.php');

$request_service = new RequestService();

if($request_service->authenticate()){
?>
	
<html>
	<body>
		<h1>Aanvraagformulier</h1>
		<div class="wrapper">
			<form action="<?php echo $_SERVER['PHP_SELF'] . '?page=Web_App_Scanner_menu' ?>" method="post">

				<label>Naam</label>
				<input type="text" name="request_name">

				<label>Bedrijf</label>
				<input type="text" name="request_company">

				<label>Email</label>
				<input type="email" name="request_email">

				<select name="type">

					<option value="full">full scan</option>
					<option value="SQLi">SQL injection</option>
					<option value="XSS">XSS</option>

				</select>

				<input type="submit" name="send" value="verstuur">		
			</form>
		</div>
	</body>
</html>

<?php
}else{
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

switch($_POST['submit']){

	case 'send':

	$name = $_POST['request_name'];
	$company = $_POST['request_company'];
	$email = $_POST['request_email'];
	$type = $_POST['type'];

	$user = array('request_name' => $name, 'request_company' => $company, 'request_email' => $email, 'type' => $type);

	$request_service->scan($user);

	break;
	
	case 'register':

	$name = $_POST['register_name'];
	$company = $_POST['register_company'];
	$email = $_POST['register_email'];

	$user = array('register_name' => $name, 'register_company' => $company, 'register_email' => $email);

	$request_service->register($user);

	break;

}


?>