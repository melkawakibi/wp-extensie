<html>
	<body>
		<div class="wrapper">
			<form action="<?php echo $_SERVER['PHP_SELF'] . '?page=Web_App_Scanner_menu' ?>" method="post">

				<label>Naam</label>
				<input type="text" name="name">

				<label>Bedrijf</label>
				<input type="text" name="company">

				<label>Email</label>
				<input type="email" name="email">

				<input type="submit" name="submit" value="verstuur">		
			</form>
		</div>
	</body>
</html>

<?php

global 
$current_user;
get_currentuserinfo();

echo 'Username: ' . $current_user->user_login . '<br>';
echo 'User email: ' . $current_user->user_email . '<br>';
echo 'User level: ' . $current_user->user_level . '<br>';
echo 'User first name: ' . $current_user->user_firstname . '<br>';
echo 'User last name: ' . $current_user->user_lastname . '<br>';
echo 'User display name: ' . $current_user->display_name . '<br>';
echo 'User ID: ' . $current_user->ID . '<br>';

$hash =  crc32($current_user->user_login);

echo 'Hash: ' . $hash . '<br>'; 

$cms_id = 
$name = $_POST['name'];
$company = $_POST['company'];
$email = $_POST['email'];

$url = 'http://localhost:8887/request_scan';
$data = array('cms_id' => $user_id,'name' => $name, 'comapany' => $company, 'email' => $email);

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec ($ch);

curl_close ($ch);

var_dump($result);

?>