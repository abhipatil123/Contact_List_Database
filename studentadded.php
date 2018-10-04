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
    
    
    if(empty($data_missing)){
        
        require_once('mysqli_connect.php');
        
        if(!$button){
            
            $query = "INSERT INTO contact ( ContactId, Fname, Mname, Lname) VALUES ( NULL, '$f_name', '$m_name',  '$l_name')";
            
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
                
                mysqli_close($dbc);
                
            } else {
                
                echo 'Error Occurred<br />';
                echo mysqli_error($query);
                
                mysqli_stmt_close($stmt);
                
                mysqli_close($dbc);
                
            }
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
            echo "<a herf = 'addStudent.html'> Home </a>";
            exit;
        }
        
    } else {    
        
        echo 'You need to enter the following data<br />';
        
        foreach($data_missing as $missing){
            
            echo "$missing<br />";
            
        }
        echo "<br />";
        
    }
    
// }else{
//    echo "Error: isSet is Null";
// }

?>

 <form action="http://localhost/contactlist/Contact_List_Database/studentadded.php" method="post">
        
    <table border="0">
        <tr>
            <td>First Name</td>
            <td align="center"> <input type="text" name="first_name" size="30" /></td>
        </tr>

        <tr>
            <td>Middle Name</td>
            <td align="center"> <input type="text" name="middle_name" size="30" /></td>
        </tr>

        <tr>
            <td>Last Name</td>
            <td align="center"> <input type="text" name="last_name" size="30" /></td>
        </tr>

        <tr>
            <td colspan="2" align="center"><input type="submit" value="Send"/></td>
        </tr>
    </table>

  </form>
</body>
</html>