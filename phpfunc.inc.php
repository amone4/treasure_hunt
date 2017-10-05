<?php

/**
 * function escapes and returns the passed data, using mysqli_real_escape_string
 * @param  string $data the string which has to be escaped
 * @return string       the string after escaping
 */
function escapeData($data) {
	if (function_exists('mysqli_real_escape_string')) {
		global $conn;
		$data = mysqli_real_escape_string($conn,trim($data));
		$data = strip_tags($data);
	} else {
		$data = mysqli_escape_string(trim($data));
		$data = strip_tags($data);
	}
	return $data;
}

/**
 * function to validate password using regular expressions
 * the password must contain atleast one letter, one digit, no special characters
 * it should be between 8 and 20 characters in length
 * @param  string $password the password to be validated
 * @return boolean           returns true if the password is valid, otherwise false
 */
function validatePassword($password) {
	if (preg_match('%^(a-zA-Z0-9)*(?=\S{8,20})(?=\S*[a-z])(?=\S*[\d])\S*$%', stripslashes(trim($password)))) {
		return true;
	} else {
		return false;
	}
}

/**
 * function returns an associative array with keys being all values in given array and each value being null
 * @param  array $arr array containing the keys of the required associative array
 * @return associative array      returns the associative array with null values
 */
function nullArray($arr) {
	$temp;
	foreach ($arr as $value) {
		$temp[$value]=null;
	}
	return $temp;
}

/**
 * function checks if the POST variables with index in the array are set and not empty, and then escapes them by escapeData function
 * @param  associative array &$get contains indices of POST variables and stores the escaped version of the data
 * @param  string &$err [optional] stores the index which caused the error to generate
 * @return boolean       returns true if data was present, false otherwise
 */
function postVars(&$post,&$err=null) {
	foreach ($post as $key => &$value) {
		if (isset($_POST[$key])&&!empty($_POST[$key])) {
			$value=escapeData($_POST[$key]);
		} else {
			$err=$key;
			return false;
		}
	}
	return true;
}

/**
 * function selects the records satisfying the properties as given by the properties in array
 * @param  string	$table	the name of the table where this is need to be performed
 * @param  associative array	$constraints	tells various constraints which should be satisfied for a record to be selected
 * @param  array	$fields	tells various fields that need to be selected
 * @return MySQL result	object	returns the result object of the query
 */
function select($table, $constraints=null, $fields=null) {
	global $conn;
	$query = 'SELECT ';
	if ($fields!=null) {
		foreach ($fields as $key) {
			$query .= $key.', ';
		}
		$query = chop($query, ' ,');
	} else {
		$query .= '*';
	}
	$query .= ' FROM '.$table;
	if ($constraints!=null) {
		$query .= ' WHERE ';
		foreach ($constraints as $key => $value) {
			$query .= $key.'=';
			$query .= $value;
			$query .= ' AND ';
		}
		$query = chop($query, ' AND ');
	}
	$query .= ';';
	return mysqli_query($conn, $query);
}

/**
 * function inserts data given in the passed array
 * @param  string	$table	the name of the table where this is need to be performed
 * @param  associative array	$fields	contains values to be provided in the columns
 * @return boolean	returns true if record was inserted successfully, false otherwise
 */
function insert($table, $fields) {
	global $conn;
	$query1 = 'INSERT INTO '.$table.' (';
	$query2 = '';
	foreach ($fields as $key => $value) {
		$query1 .= $key.', ';
		$query2 .= $value.', ';
	}
	$query1 = chop($query1,', ');
	$query2 = chop($query2,', ');
	$query1 .= ') VALUES ('.$query2.');';
	mysqli_query($conn, $query1);
	if (mysqli_num_rows($conn)==1) {
		return true;
	} else {
		return false;
	}
}

/**
 * function updates the records satisfying the properties as given by the properties in array
 * @param  string	$table	the name of the table where this is need to be performed
 * @param  associative array	$fields	tells various fields and their values which are to be changed
 * @param  associative array	$constraints	tells various fields and their values which should match for a record to be updated
 * @return integer	returns the number of rows affected
 */
function update($table, $fields, $constraints=null) {
	global $conn;
	$query = 'UPDATE '.$table.' SET ';
	foreach ($fields as $key => $value) {
		$query .= $key.'=';
		$query .= $value;
		$query .= ', ';
	}
	$query = chop($query, ', ');
	$query .= ' WHERE ';
	foreach ($constraints as $key => $value) {
		$query .= $key.'=';
		if (!is_numeric($value)) {
			$query .= "'$value'";
		} else {
			$query .= $value;
		}
		$query .= ' AND ';
	}
	$query = chop($query, ' AND ');
	$query .= ';';
	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}

/**
 * function converts the given date from string to a date time object
 * @param  string $format the format in which the date has been provided
 * @param  string $date   the date whose data type needs to be converted
 * @return DateTime object
 */
function retDate($format,$date) {
	return DateTime::createFromFormat($format,$date)->format($format);
}

?>