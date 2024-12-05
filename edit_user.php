<!doctype html>
<html lang="en">
<head>
	<title>Edit User Info</title>
	<meta charset = "utf-8">
	<link rel="stylesheet" type="text/css" href="include.css">
</head>
<body>
	<div id="container">
		<?php include('header.php'); ?>
		<?php include('nav.php'); ?>
		<?php include('info-col.php'); ?>
		<div id='homepage'>
			<div id="content">
				<h2>EDITORO HAMNIDA</h2>
				<?php
					if ((isset($_GET['id'])) && (is_numeric($_GET['id']))) {
                        $id = $_GET['id'];
                    }elseif ((isset($_POST['id'])) && (is_numeric($_POST['id']))) {
                        $id = $_POST['id'];
                    }else {
                        echo '<p class="error">This page has been accessed by mistake</p>';
                        include('footer.php');
                        exit();
                    }
					require('mysqli_connect.php');
					if($_SERVER['REQUEST_METHOD'] == 'POST') {
						$errors = array();
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

					if (empty($errors)) {
						$q = "UPDATE users SET fname = '$fn', lname = '$ln', email = '$e' WHERE user_id = '$id' LIMIT 1";
						$result = @mysqli_query($dbcon, $q);
						if(mysqli_affected_rows($dbcon) == 1) {
							echo '<h3>Successful edit haha edi wao</h3>';
						} else {
							echo '<h3>Hindi successful edit haha wawa</h3>';
							echo '<p>'.mysqli_error($dbcon).'</p>';
						}
					}else {
						//hotdog yung display
						echo '<p>Please try again</p>';
					}
				}
					$q = "SELECT fname, lname, email from users where user_id = '$id'";
					$result = @mysqli_query($dbcon, $q);
					if (mysqli_num_rows($result) == 1) {
						$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
						//form

						echo '
							<form action = "edit_user.php" method = "post">
							<p class="input">
							<label class="label" for="fname">First Name:</label>
							<input type="text" id="fname" name="fname" size="30" maxlength="40"
							value="'.$row['fname'].'">
		 					</p>

		 					<p class="input">
							<label class="label" for="lname">Last Name:</label>
							<input type="text" id="lname" name="lname" size="30" maxlength="40"
							value="'.$row['lname'].'">
		 					</p>

		 					<p class="input">
							<label class="label" for="email">Email:</label>
							<input type="email" id="email" name="email" size="30" maxlength="40"
							value="'.$row['email'].'">
		 					</p>
						
							<p><input type="submit" id="submit" name="submit" value="Register">
		  					</p>
		  					<p><input type = "hidden" name = "id" value = "'.$id.'">
		  					</p>
							</form>
						';
					}else {
						echo '<h2>Who you</h2>';

					}
					mysqli_close($dbcon);
				?>
			</div>
		</div>
		<?php include('footer.php'); ?>
	</div>
</body>
</html> 