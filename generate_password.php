<?php
require_once 'connect.inc.php';
require_once 'phpfunc.inc.php';

$result = select('treasure_hunt_teams');

while ($row = mysqli_fetch_assoc($result)) {
	$password = '';
	$password .= substr($row['name1'], 0, 2);
	$password .= substr($row['roll1'], 0, 2);
	$password .= substr($row['phone1'], 0, 2);
	$password .= substr($row['name2'], 0, 2);
	$password .= substr($row['roll2'], 0, 2);
	$password .= substr($row['phone2'], 0, 2);
	$password = '\''.hash('sha256',$password).'\'';

	update('treasure_hunt_teams', array('pass'=>$password), array('team'=>$row['team']));
}

?>