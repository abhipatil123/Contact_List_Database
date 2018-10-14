<html>
<head>
    <title>Contact Deleted</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <?php
    $dateId = $_POST['dt_id'];
    // Get a connection for the database
    require_once('mysqli_connect.php');

    $query = "DELETE FROM date WHERE Date_Id = $dateId";
    $response = mysqli_query($dbc, $query);

	// If the query executed properly proceed
	if($response){
        console.log("Deleted");
    }
    else {
        console.log("Not Deleted");
		echo "Couldn't issue database query<br />";

		echo mysqli_error($dbc);

    }
    
    // Close connection to the database
    mysqli_close($dbc);
    ?>
</body>
</html>