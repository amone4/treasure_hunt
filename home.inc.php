<?php
$error='';
if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])) {
	$error='enter valid fields';
	$p = nullArray(array('team','pass'));
	if (postVars($p)) {
		$p['pass'] = '\''.hash('sha256',$p['pass']).'\'';
		if (mysqli_num_rows(select('treasure_hunt_teams',array('team'=>$p['team'],'pass'=>$p['pass']),array('team')))) {
			$_SESSION['logged'] = $p['team'];
			header('Location: ./');
		}
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Treasure Hunt</title>

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

	<style type="text/css">
		body,html{
			width: 100%;
		}
	</style>
</head>
<body style="background: #ffd480;">

	<div class="w3-hide-small w3-hide-medium">
		<div class="w3-container w3-padding-64" style="background: url('images/loginback.jpg');">
			<div style="margin-top: 17%; margin-left: 75%;">
				<div class="w3-container" style="border: 2px solid #333300; border-radius: 5px; background: transparent;">
					<h3 class="w3-center" style="color: #333300"><b>Login</b></h3>
					<hr style="width: 20%; border: 1px solid #333300; margin-left: 40%;">
					<form action="" class="w3-center" method="POST" role="form">
						<div id="error"><?php echo $error; ?></div>
						<div class="form-group">
							<label for="team" style="color: #000000 ;"><h4><b>Team Number</b></h4></label>
							<input type="text" class="form-control" id="team" name="team" placeholder="Enter Team Number">
						</div>
						<div class="form-group">
							<label for="pass" style="color: #000000 ;"><h4><b>Password</b></h4></label>
							<input type="text" class="form-control" id="pass" name="pass" placeholder="Enter Password">
						</div>
						<button type="submit" name="submit" class="w3-btn w3-brown w3-text-white w3-hover-blue" style="margin-bottom: 2%">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="w3-hide-large">
		<div class="w3-center w3-container">
			<img src="images/logo.png" style="width: 80%; margin-bottom: 20%;">
			<div class="w3-container" style="border: 5px solid #333300; border-radius: 5px; background: transparent; width: 60%; margin: 0 auto;">
				<h2 class="w3-center" style="color: #333300"><b>Login</b></h2>
				<hr style="width: 20%; border: 3px solid #333300; margin-left: 40%;">
				<form action="" class="w3-center" method="POST" role="form">
					<div id="error"><?php echo $error; ?></div>
					<div class="form-group">
						<label for="team" style="color: #000000 ;"><h3><b>Team Number</b></h3></label>
						<input type="text" class="form-control" id="team" name="team" required="required" placeholder="Enter Team Number">
					</div>
					<div class="form-group">
						<label for="pass" style="color: #000000 ;"><h3><b>Password</b></h3></label>
						<input type="password" name="pass" id="pass" class="form-control" required="required" placeholder="Enter Password">
					</div>
					<button type="submit" name="submit" class="w3-btn w3-brown w3-text-white w3-hover-blue" style="margin-bottom: 2%">Submit</button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>