<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <title>Contact Info</title>
</head>
<body>
	<form action = "displayContacts.php" method="GET">
		<input type = "text" name="search">
		<input type = "submit" value="Search">
	</form>
<?php
// Get a connection for the database
require_once('mysqli_connect.php');

$searchString = $_GET["search"];
$search = explode(" ", $searchString);

if($search){
	// Create a query for the database
	$query = "SELECT DISTINCT contact.* FROM contact 
			  LEFT JOIN address ON contact.ContactId = address.Contact_Id
			  LEFT JOIN phone ON contact.ContactId = phone.Contact_Id
			  LEFT JOIN date ON contact.ContactId = date.Contact_Id
			  WHERE ";
	
	foreach($search as $searchVar){
		$ser = "'%" . $searchVar. "%'";
		$query .= "(contact.ContactId LIKE " . $ser . " OR Address LIKE ". $ser ." OR City LIKE ". $ser ." OR State LIKE ". $ser ." OR Zip LIKE ". $ser ."
		OR Fname LIKE ". $ser ." OR Mname LIKE ". $ser ." OR Lname LIKE ". $ser ."
		OR Area_Code LIKE ". $ser ." OR Number LIKE ". $ser ." OR Date LIKE ". $ser ."OR CONCAT(Area_Code,'', Number) LIKE ". $ser .") AND ";
	}

	$query = substr($query, 0, strlen($query) - 4);
	
	$response = mysqli_query($dbc, $query);

	// If the query executed properly proceed
	if($response){

		echo '<table align="left"
		cellspacing="5" cellpadding="8" class="table table-striped">

		<tr><td align="left"><b>Contact Id</b></td>
		<td align="left"><b>First Name</b></td>
		<td align="left"><b>Middle Name</b></td>
		<td align="left"><b>Last Name</b></td>
		<td align="left"><b>Delete</b></td>
		<td align="left"><b>Modify</b></td></tr>';

		// mysqli_fetch_array will return a row of data from the query
		// until no further data is available
		while($row = mysqli_fetch_array($response)){
			$id = $row['ContactId'];
			echo '<tr><td align="left">' . 
			$row['ContactId'] . '</td><td align="left">' . 
			$row['Fname'] . '</td><td align="left">' . 
			$row['Mname'] . '</td><td align="left">' .
			$row['Lname'] . '</td><td align="left">'.
			'<a href="delete.php?id = '.$row['ContactId'].'"> Delete </a></td>'.
			'</td><td align="left">'. '<a href="modify.php?id = '.$row['ContactId'].'"> Modify </a></td>';

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