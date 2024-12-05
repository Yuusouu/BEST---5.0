<!DOCTYPE html>
<html lang="en">
<head>
	<title>Mariano</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="include.css">
	
</head>

<body style="background-color: #4b5795">
	<div id="container">
		<?php include('header.php'); ?>
		<?php include('nav.php'); ?>
		<?php include('info-col.php'); ?>
		<div id='content'>
		<?php 
			if ($_SERVER['REQUEST_METHOD'] == 'POST'){
				//error array
				$errors = array();
				//first name
				if(empty($_POST['fname'])){
					$errors[] = 'Please Input your first name.';
				}else{
					$fn = trim($_POST['fname']);

				}
				if(empty($_POST['lname'])){
					$errors[] = "Please input your last name.";
				}else{
					$ln = trim($_POST['lname']);
				}
				if(empty($_POST['email'])){
					$errors[] = "Please input your email.";
				}else{
					$e = trim($_POST['email']);
				}
				if (!empty($_POST['psword1'])){
					if($_POST['psword1'] != $_POST['psword2']){
						$errors[] = "Password do not match";
					}else{
						$p = trim($_POST['psword1']);
						$p = hash('sha256', $_POST['psword1']);
					}
				}else{
					$errors[] = 'Please input your password.';
				}
				if(empty($errors)){
					require('mysqli_connect.php');
					$q = "INSERT INTO users(fname, lname, email, psword, registration_date, user_lvl) values('$fn', '$ln', '$e', '$p', NOW(), 0);";
					$result = @mysqli_query($dbcon, $q);
					if($result) { //kung laman ay true uwu
						header("asd.php");
						exit();
					}else{
						//display error
						echo '<h2>System Error</h2>
						<p class="error">Your registration failed due to an unexpected error. Sorry for the inconvenience.
						haha?</p>';
						//debugging
						echo'<p>'.mysqli_error($dbcon).'</p>';
					}
					//closing data base
					mysqli_close($dbcon);
					include('footer.php');
					exit();

				}else{
					echo '<h2>Error!</h2><p class="erro">The following error(s) occured:<br/>';
					foreach($errors as $msg) {
						echo " - $msg<br/>\n";
					}
					echo '</p><h3>Please try again<br/>';
				}
			}
		?>
			<h2>Registration page</h2>
		<form action="register.php" method="post">
		<p class="input">
			<label class="label" for="fname">First Name:</label>
			<input type="text" id="fname" name="fname" size="30" maxlength="40"
			value="<?php if(isset($_POST['fname'])) echo $_POST["fname"]; ?>">
		 </p>

		 <p class="input">
			<label class="label" for="lname">Last Name:</label>
			<input type="text" id="lname" name="lname" size="30" maxlength="40"
			value="<?php if(isset($_POST['lname'])) echo $_POST["lname"]; ?>">
		 </p>

		 <p class="input">
			<label class="label" for="email">Email:</label>
			<input type="email" id="email" name="email" size="30" maxlength="40"
			value="<?php if(isset($_POST['email'])) echo $_POST["email"]; ?>">
		 </p>

		 <p class="input">
			<label class="label" for="psword1">Password:</label>
			<input type="password" id="psword1" name="psword1" size="20" maxlength="40"
			value="<?php if(isset($_POST['psword1'])) echo $_POST["psword1"]; ?>">
		</p>
		<p class="input">
			<label class="label" for="psword2">Repeat Password:</label>
			<input type="password" id="psword2" name="psword2" size="30" maxlength="40"
			value="<?php if(isset($_POST['psword2'])) echo $_POST["psword2"]; ?>">
<br>
<br>
		 <input type="submit" id="submit" name="submit" value="Register">
		</form>
		</div>
	</div>
	<?php include('footer.php'); ?>
</body>

<html>