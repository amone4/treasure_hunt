<?php

// file connecting to database and starting session
require_once 'connect.inc.php';
// file containing all the self defined functions
require_once 'phpfunc.inc.php';

// if the person has logged in
if (isset($_SESSION['logged']) && $_SESSION['logged']<300 && $_SESSION['logged']>100) {
	// if the person wants to logout
	if (isset($_GET['signout'])) {
		session_unset();
		require_once 'home.inc.php';

	// if the person wants to change the password
	} elseif (isset($_GET['pass'])) {
		require_once 'pass.inc.php';

	// if the user is just seeing the question
	} else {
		require_once 'question.inc.php';
	}

// if the person has not logged in
} else {
	session_unset();
	require_once 'home.inc.php';
}

?>