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

$name = $_POST['name'];
$company = $_POST['company'];
$email = $_POST['email'];

echo $name . ' ' . $company .  ' ' . $email;

?>