<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <title>Contact Info</title>
</head>
<body>

	<form action = "getstudentinfo.php" method="GET">
		<input type = "text" name="search">
		<input type = "submit" value="Search">
	</form>


<?php
// Get a connection for the database
require_once('mysqli_connect.php');

$search = $_GET["search"];

if($search){
	// Create a query for the database
	$query = "SELECT * FROM contact WHERE Fname LIKE '%$search%'";

	// Get a response from the database by sending the connection
	// and the query
	$response = mysqli_query($dbc, $query);

	// If the query executed properly proceed
	if($response){

		echo '<table align="left"
		cellspacing="5" cellpadding="8" class="table table-striped">

		<tr><td align="left"><b>Contact Id</b></td>
		<td align="left"><b>First Name</b></td>
		<td align="left"><b>Middle Name</b></td>
		<td align="left"><b>Last Name</b></td></tr>';

		// mysqli_fetch_array will return a row of data from the query
		// until no further data is available
		while($row = mysqli_fetch_array($response)){

			echo '<tr><td align="left">' . 
			$row['ContactId'] . '</td><td align="left">' . 
			$row['Fname'] . '</td><td align="left">' . 
			$row['Mname'] . '</td><td align="left">' .
			$row['Lname'] . '</td><td align="left">';

			echo '</tr>';
		}

		echo '</table>';

	} else {

		echo "Couldn't issue database query<br />";

		echo mysqli_error($dbc);

	}
}

// Close connection to the database
mysqli_close($dbc);

?>