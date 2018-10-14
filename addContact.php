<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <title>Add Student</title>
</head>
<body>
<?php
    $contactId = $_GET["id"];
//if(isset($_POST['submit'])){
    
    $data_missing = array();

    //print_r($_POST);
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
        for($i = 0; $i < count($_POST['add_type']); $i++){
            $addtype[$i] = trim($_POST['add_type'][$i]);
        }

        

        
    }

    // if(empty($_POST['address'])){

    //     // Adds name to array
    //     $data_missing[] = 'Address';

    // } else{

        // Trim white space from the name and store the name
       
        //$address = $_POST['address'][0];
       
        for($i = 0; $i < count($_POST['address']); $i++){
            $address[$i] = $_POST['address'][$i];
        }
        
   // }
    
   for($i = 0; $i < count($_POST['addressId']); $i++){
        $addressId[$i] = $_POST['addressId'][$i];
       
    }

    for($i = 0; $i < count($_POST['dateId']); $i++){
        $dateId[$i] = $_POST['dateId'][$i];
        
    }

    for($i = 0; $i < count($_POST['phoneId']); $i++){
        $phoneId[$i] = $_POST['phoneId'][$i];
     
    }


    if(empty($_POST['city'])){

        // Adds name to array
        $data_missing[] = 'City';

    } else{

        // Trim white space from the name and store the name
        //$city = $_POST['city'][0];
        for($i = 0; $i < count($_POST['city']); $i++){
            $city[$i] = $_POST['city'][$i];
  
        }

    }

    if(empty($_POST['state'])){

        // Adds name to array
        $data_missing[] = 'state';

    } else{

        // Trim white space from the name and store the name
        //$state = trim($_POST['state'][0]);
        for($i = 0; $i < count($_POST['state']); $i++){
            $state[$i] = $_POST['state'][$i];
  
        }

    }

    if(empty($_POST['zip'])){

        // Adds name to array
        $data_missing[] = 'Zip Code';

    } else{

        // Trim white space from the name and store the name
        //$zip = trim($_POST['zip'][0]);
        for($i = 0; $i < count($_POST['zip']); $i++){
            $zip[$i] = $_POST['zip'][$i];
        
        }

    }

    if(empty($_POST['phone_type'])){

        // Adds name to array
        $data_missing[] = 'phone_type';

    } else{

        // Trim white space from the name and store the name
        for($i = 0; $i < count($_POST['phone_type']); $i++){
            $phonetype[$i] = trim($_POST['phone_type'][$i]);
         
        }
    }

    if(empty($_POST['areacode'])){

        // Adds name to array
        $data_missing[] = 'Area Code';

    } else{

        // Trim white space from the name and store the name
        //$areacode = trim($_POST['areacode'][0]);
        for($i = 0; $i < count($_POST['areacode']); $i++){
            $areacode[$i] = $_POST['areacode'][$i];
            
        }

    }



    if(empty($_POST['number'])){

        // Adds name to array
        $data_missing[] = 'Phone Number';

    } else{

        // Trim white space from the name and store the name
        //$number = trim($_POST['number'][0]);
        for($i = 0; $i < count($_POST['number']); $i++){
            $number[$i] = $_POST['number'][$i];
            
        }

    }

    if(empty($_POST['date_type'])){

        // Adds name to array
        $data_missing[] = 'date_type';

    } else{

        // Trim white space from the name and store the name
        for($i = 0; $i < count($_POST['date_type']); $i++){
            $datetype[$i] = trim($_POST['date_type'][$i]);
            
        }
    }

    if(empty($_POST['day'])){

        // Adds name to array
        $data_missing[] = 'Date';

    } else{

        // Trim white space from the name and store the name
       // $date = trim($_POST['day'][0]);
        for($i = 0; $i < count($_POST['day']); $i++){
            $date[$i] = $_POST['day'][$i];
            
        }

    }
    
    
    if(empty($data_missing)){
        
        require_once('mysqli_connect.php');
        
        if(!$contactId){

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

            for($i = 0; $i < count($address) - 1; $i++){
                $query = "INSERT INTO address ( Contact_Id, Address_type, Address, City, State, Zip) 
                        VALUES ( '$id', '$addtype[$i]', '$address[$i]', '$city[$i]',  '$state[$i]', '$zip[$i]')";
                echo "<br/>";
                echo $query;
                echo "<br/>";
                $result = mysqli_query($dbc, $query);
                if($result){
                    echo "Contact Address Insert Succesfully";
                }else{
                    echo "Error Occured while adding to address";
                }
            }

            for($i = 0; $i < count($areacode) - 1; $i++){
                $query = "INSERT INTO phone ( Contact_Id, Phone_type, Area_Code, Number) 
                        VALUES ( '$id', '$phonetype[$i]', '$areacode[$i]', $number[$i])";
                
                $result = mysqli_query($dbc, $query);
                if($result){
                    echo "Contact Phone inserted Succesfully";
                }else{
                    echo "Error Occured while adding to phone";
                }
            }

            for($i = 0; $i < count($date) - 1; $i++){
                $query = "INSERT INTO date ( Contact_Id, Date_type, Date) 
                        VALUES ( '$id', '$datetype[$i]', '$date[$i]')";
                
                $result = mysqli_query($dbc, $query);
                if($result){
                    "Contact Date Inserted Succesfully";
                }else{
                    "Error Occured while adding to date";
                }
            }
            mysqli_close($dbc);

        }
        else{
            //If two fields are there updates only once
            // Create a query for the database
            echo "Inside Modify code";
            echo "<br/>";
            $selectquery = "SELECT * FROM contact WHERE Fname='$f_name' AND Mname='$m_name' AND Lname='$l_name'";
            // Get a response from the database by sending the connection
            // and the query
            $response = mysqli_query($dbc, $selectquery);

            $id = 0;
            // If the query executed properly proceed
            if($response){
                $row = mysqli_fetch_array($response);
                $id = $row['ContactId'];
                echo $id;
            }else{
                echo "Error while fetching";
            }

            echo "1";
            echo "<br/>";
            $query = "UPDATE  contact  SET  Fname = '$f_name', Mname = '$m_name',  Lname = '$l_name' WHERE ContactId = $contactId";
            $result = mysqli_query($dbc, $query);
            if($result){
                echo "Contact Name Modified Succesfully";
            }else{
                echo "Error Occured: Contact Name";
            }

            for($i = 0; $i < count($address) - 1; $i++){
                if($addressId[$i]){
                    $query = "UPDATE  address  SET  Address_type = '$addtype[$i]', Address = '$address[$i]',  City = '$city[$i]', 
                                                    State = '$state[$i]', Zip = '$zip[$i]' WHERE Address_Id = $addressId[$i]";
                    $result = mysqli_query($dbc, $query);
                    if($result){
                        echo "Contact Address Modified Succesfully";
                    }else{
                        "Error Occured: Contact Address MOdify";
                    }
                }else{
                    
                    $query1 = "INSERT INTO address ( Contact_Id, Address_type, Address, City, State, Zip) 
                        VALUES ( $id, '$addtype[$i]', '$address[$i]', '$city[$i]',  '$state[$i]', '$zip[$i]')";
                    $result1 = mysqli_query($dbc, $query1);
                    if($result1){
                        echo "Contact Address Inserted Succesfully";
                    }else{
                        echo "Error Occured while insering contact address";
                    }
                }
            }
            
            for($i = 0; $i < count($areacode) - 1; $i++){
                if($phoneId[$i]){
                    $query = "UPDATE phone SET Phone_Type = '$phonetype[$i]', Area_Code = '$areacode[$i]', Number = '$number[$i]' WHERE Phone_Id = $phoneId[$i]";
                    
                    $result = mysqli_query($dbc, $query);
                    if($result){
                        echo "Contact Phone Modified Succesfully";
                    }else{
                        echo "Error Occured Contact Phone Modify";
                    }
                }else{
                    $query = "INSERT INTO phone ( Contact_Id, Phone_type, Area_Code, Number) 
                        VALUES ( '$id', '$phonetype[$i]', '$areacode[$i]', '$number[$i]')";
                    $result = mysqli_query($dbc, $query);
                    if($result){
                        "Contact Phone inserted Succesfully";
                    }else{
                        "Error Occured Contact Phone Insert";
                    }
                }
            }

            for($i = 0; $i < count($date) - 1; $i++){
                if($dateId[$i]){
                    $query = "UPDATE date SET Date_Type = '$datetype[$i]', Date = '$date[$i]' WHERE Date_Id = $dateId[$i]";
                    
                    $result = mysqli_query($dbc, $query);
                    if($result){
                        echo "Contact Date Modified Succesfully";
                    }else{
                        echo "Error Occured Contact Date Modify";
                    }
                }else{
                    $query1 = "INSERT INTO date ( Contact_Id, Date_type, Date) 
                        VALUES ( '$id', '$datetype[$i]', '$date[$i]')";
                
                    $result1 = mysqli_query($dbc, $query1);
                    if($result1){
                        echo "Contact Date Modified Succesfully";
                    }else{
                        echo "Error Occured Contact Date Insert";
                    }
                }
            }
            mysqli_close($dbc);
            echo "<br/>";
            echo "<a href = 'addStudent.html'> Home </a>";
            exit;
        }
        
        } //else {    
        
    //     echo 'You need to enter the following data<br />';
        
    //     foreach($data_missing as $missing){
            
    //         echo "$missing<br />";
            
    //     }
    //     echo "<br />";
        
    // }

?>
</body>
</html>