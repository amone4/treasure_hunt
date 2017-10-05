<!DOCTYPE html>
<html lang="">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Treasure Hunt</title>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<style>
		body,html{
			height: 100%;
		}
	</style>
<body>
	<div class="container" style="padding: 0; margin: 0; background: transparent;">
		<a class="nav navbar-nav"  href="#">
			<div class="row">
				<div class="w3-col" style="width: 25%"><img src="images/icon.png" width="95%"></div>
				<div class="w3-col w3-hide-small w3-text-black" style="width: 60%"><h4 style="margin-left: 9%"><b>Online</b></h4><h2 style="margin-left: 9%"><b>Treasure Hunt</b></h2></div></a>
				<div class="pull-right text-capitalize"><a href="./?signout">sign out</a><br /><a href="./?pass">change password</a></div>
			</div>
		</a>
	</div>

	<?php
	// getting the date
	$date = date('d-H-i-s');

	// if the hunt hasn't started
	if ($date < retDate('d-H-i-s','5-11-00-00')) {
		die('<br><div class="container">Contain Your Excitement For Some More Time</div>');

	// determining the question number
	} elseif ($date < retDate('d-H-i-s','5-12-00-00')) {
		if ($date < retDate('d-H-i-s','5-11-20-00')) {
			$qno = 1;
		} elseif ($date < retDate('d-H-i-s','5-11-40-00')) {
			$qno = 2;
		} else {
			$qno = 3;
		}

	// if the hunt has ended
	} else {
		die('<br><div class="container">The Hunt Has Ended</div>');
	}

	// recording response on requestion
	if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])) {
		$p = nullArray(array('answer1','answer2'));
		if (postVars($p)) {
			$p['answer1'] = '\''.$p['answer1'].'\'';
			$p['answer2'] = '\''.$p['answer2'].'\'';
			if (mysqli_num_rows(select('treasure_hunt_answers',array('team'=>$_SESSION['logged'],'qno'=>$qno),array('qno')))==1) {
				update('treasure_hunt_answers', array('answer1'=>$p['answer1'],'answer2'=>$p['answer2'],'submitted'=>'NOW()'), array('team'=>$_SESSION['logged'],'qno'=>$qno));
			} else {
				insert('treasure_hunt_answers', array('team'=>$_SESSION['logged'],'qno'=>$qno,'submitted'=>'NOW()','answer1'=>$p['answer1'],'answer2'=>$p['answer2']));
			}
		}
	}

	// getting the already recorded response, if it exists
	if (mysqli_num_rows($result = select('treasure_hunt_answers',array('team'=>$_SESSION['logged'],'qno'=>$qno),array('answer1','answer2')))==1) {
		$result = mysqli_fetch_assoc($result);
	} else {
		unset($result);
		$result['answer1'] = $result['answer2'] = '';
	}
	?>

	<div class="w3-container" style="margin-top: 7.5%;border: 1px solid #ccc; width: 80%; margin-left: 10%;">
		<h2 class="w3-center">Analyse the given Picture to reach an Answer</h2>
		<div class="w3-conatiner w3-center">

			<!-- displaying question -->
			<?php if ($qno==1) { ?>
			<img class="w3-center w3-card-4" id="1" width="600" src=""><br><br>
			<?php } elseif ($qno==2) { ?>
			<img class="w3-center w3-card-4" id="2" width="600" src=""><br><br>
			<?php } else { ?>
			<img class="w3-center w3-card-4" id="3" width="600" src=""><br><br>
			<?php } ?>

			<!-- form to get the answer of the user -->
			<h3>Submission</h3>
			<form action="" method="POST" role="form">
				<legend>Answer</legend>
				<div class="row">
					<div class="form-group col-xs-6">
						<label class="w3-label" for="answer1">Answer 1</label>
						<input type="text" class="form-control" id="answer1" name="answer1" placeholder="Enter Your Answer" value="<?php echo $result['answer1']; ?>">
					</div>
					<div class="form-group col-xs-6">
						<label class="w3-label" for="answer2">Answer 2</label>
						<input type="text" class="form-control" id="answer2" name="answer2" placeholder="Enter Your Answer" value="<?php echo $result['answer2']; ?>">
					</div>
				</div>

				<button type="submit" name="submit" class="btn btn-primary">Submit</button>
			</form>
		</div>
	</div>
</body>
</html>