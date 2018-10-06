<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <title>Add Student</title>
</head>
<body>
<?php
    $button = $_GET["id"];
//if(isset($_POST['submit'])){
    
    $data_missing = array();
    
    if(empty($_POST['first_name'])){

        // Adds name to array
        $data_missing[] = 'First Name';

    } else {

        // Trim white space from the name and store the name
        $f_name = trim($_POST['first_name']);

    }

    if(empty($_POST['middle_name'])){

        // Adds name to array
        $data_missing[] = 'Middle Name';

    } else{

        // Trim white space from the name and store the name
        $m_name = trim($_POST['middle_name']);

    }

    if(empty($_POST['last_name'])){

        // Adds name to array
        $data_missing[] = 'Last Name';

    } else{

        // Trim white space from the name and store the name
        $l_name = trim($_POST['last_name']);

    }

    if(empty($_POST['add_type'])){

        // Adds name to array
        $data_missing[] = 'add_type';

    } else{

        // Trim white space from the name and store the name
        $addtype = trim($_POST['add_type'][0]);

        
    }

    // if(empty($_POST['address'])){

    //     // Adds name to array
    //     $data_missing[] = 'Address';

    // } else{

        // Trim white space from the name and store the name
       
        $address = $_POST['address'][0];

        
   // }

    if(empty($_POST['city'])){

        // Adds name to array
        $data_missing[] = 'City';

    } else{

        // Trim white space from the name and store the name
        $city = $_POST['city'][0];

    }

    if(empty($_POST['state'])){

        // Adds name to array
        $data_missing[] = 'State';

    } else{

        // Trim white space from the name and store the name
        $state = trim($_POST['state'][0]);

    }

    if(empty($_POST['zip'])){

        // Adds name to array
        $data_missing[] = 'Zip Code';

    } else{

        // Trim white space from the name and store the name
        $zip = trim($_POST['zip'][0]);

    }

    if(empty($_POST['areacode'])){

        // Adds name to array
        $data_missing[] = 'Area Code';

    } else{

        // Trim white space from the name and store the name
        $areacode = trim($_POST['areacode'][1]);

    }

    if(empty($_POST['number'])){

        // Adds name to array
        $data_missing[] = 'Phone Number';

    } else{

        // Trim white space from the name and store the name
        $number = trim($_POST['number'][1]);

    }

    if(empty($_POST['day'])){

        // Adds name to array
        $data_missing[] = 'Date';

    } else{

        // Trim white space from the name and store the name
        $date = trim($_POST['day'][1]);

    }
    
    
    if(empty($data_missing)){
        
        require_once('mysqli_connect.php');
        
        if(!$button){

            $query = "INSERT INTO contact ( ContactId, Fname, Mname, Lname) VALUES ( NULL, '$f_name', '$m_name',  '$l_name'
                                                                                    )";
            
            $stmt = mysqli_prepare($dbc, $query);
            
            //i Integers
            //d Doubles
            //b Blobs
            //s Everything Else
            
            mysqli_stmt_bind_param($stmt, "sss", $f_name, $m_name, $l_name);
            
            mysqli_stmt_execute($stmt);
            
            $affected_rows = mysqli_stmt_affected_rows($stmt);
            
            if($affected_rows == 1){
                
                echo 'Contact Entered';
                
                mysqli_stmt_close($stmt);
                
                //mysqli_close($dbc);
                
            } else {
                
                echo 'Error Occurred<br />';
                echo mysqli_error($query);
                
                mysqli_stmt_close($stmt);
                
                //mysqli_close($dbc);
                
            }

            // Create a query for the database
            $query = "SELECT * FROM contact WHERE Fname='$f_name' AND Mname='$m_name' AND Lname='$l_name'";
            // Get a response from the database by sending the connection
            // and the query
            $response = mysqli_query($dbc, $query);

            $id = 0;
            // If the query executed properly proceed
            if($response){
                $row = mysqli_fetch_array($response);
                $id = $row['ContactId'];
            }else{
                "Error";
            }


            $query = "INSERT INTO address ( Contact_Id, Address_type, Address, City, State, Zip) 
                      VALUES ( '$id', '$addtype', '$address', '$city',  '$state', '$zip')";
            
            $result = mysqli_query($dbc, $query);
            if($result){
                "Contact Modified Succesfully";
            }else{
                "Error Occured while adding to address";
            }
            mysqli_close($dbc);

        }
        else{
            $query = "UPDATE  contact  SET  Fname = '$f_name', Mname = '$m_name',  Lname = '$l_name' WHERE ContactId = $button";
            $result = mysqli_query($dbc, $query);
            if($result){
                "Contact Modified Succesfully";
            }else{
                "Error Occured";
            }
            mysqli_close($dbc);
            echo "<br/>";
            echo "<a href = 'addStudent.html'> Home </a>";
            exit;
        }
        
    } else {    
        
        echo 'You need to enter the following data<br />';
        
        foreach($data_missing as $missing){
            
            echo "$missing<br />";
            
        }
        echo "<br />";
        
    }

?>
</body>
</html>