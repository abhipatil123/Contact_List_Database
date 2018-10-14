<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" >
	<link rel="stylesheet" type="text/css" href="displayContact.css"/>
	<title>Contact Info</title>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script>
		 $(document).ready(function () {
           
            $(document).on("click", "#del", function () {
				if (!confirm("Do you want to delete?")){
					return false;
				}
                $ad_id=$(this).val();
                console.log($ad_id);
                
                $.ajax({
                    url: "http://localhost/contactlist/Contact_List_Database/delete.php",
                    type: "POST",
                    data: "ad_id="+$ad_id,
                    success: function (data) {
                        
                    },
                    error: function (data) {
                        alert("An error occurred while loading XML file.");
                    },
				});
				
				alert("Contact deleted with Contact Id: " + $ad_id);
				location.reload();
			});
		});
	</script>
</head>
<body>
	<h2 style="text-align: center"> Welcome to Contact Management System</h2>	
	<nav class="navbar navbar-light bg-light justify-content-between">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item">
					<a class="nav-link" href= "test.html"> Add New Contact</a>
				</li>
			</ul>
			<form class="form-inline my-2 my-lg-0" action = "displayContacts.php" method="GET">
				<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
				<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
			</form>
	</nav>
<?php
// Get a connection for the database
require_once('mysqli_connect.php');

$searchString = $_GET["search"];
$search = explode(" ", $searchString);

if($searchString){
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

		echo '<div class="container"> <table align="left" class="table table-bordered"
		cellspacing="5" cellpadding="8" class="table table-striped">

		<tr><th align="left"><b>Contact Id</b></th>
		<th align="left"><b>First Name</b></th>
		<th align="left"><b>Middle Name</b></th>
		<th align="left"><b>Last Name</b></th>
		<th align="left"><b>Delete</b></th>
		<th align="left"><b>Modify</b></th></tr>';

		// mysqli_fetch_array will return a row of data from the query
		// until no further data is available
		while($row = mysqli_fetch_array($response)){
			$id = $row['ContactId'];
			echo '<tr><td align="left">' . 
			$row['ContactId'] . '</td><td align="left">' . 
			$row['Fname'] . '</td><td align="left">' . 
			$row['Mname'] . '</td><td align="left">' .
			$row['Lname'] . '</td><td align="left">'.
			'<button id="del" type ="button" class="btn btn-danger btn-sm" value = "'.$id.'">DEL</button>'.
			
			'</td><td align="left">'. '<a href="modify.php?id = '.$row['ContactId'].'"> Modify </a></td>';

			echo '</tr>';
		}

		echo '</table>';
		echo '</div>';
	} else {

		echo "Couldn't issue database query<br />";

		echo mysqli_error($dbc);

	}
}

// Close connection to the database
mysqli_close($dbc);

?>