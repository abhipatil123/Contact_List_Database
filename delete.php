
<?php
    //if(isset($_GET['id'])){
    $contact_id = $_POST['ad_id'];
    echo $contact_id;
    if($contact_id){
        // Get a connection for the database
        require_once('mysqli_connect.php'); 

        $query = "DELETE FROM address WHERE Contact_Id = $contact_id";
        echo $query;
        $result = mysqli_query($dbc, $query);
        
        if($result){
            echo "Deleted";
        }           
        else{
            echo "Error";
            mysqli_error($result);
        }

        $query = "DELETE FROM phone WHERE Contact_Id = $contact_id";
        echo $query;
        $result = mysqli_query($dbc, $query);
        
        if($result){
            echo "Deleted";
        }           
        else{
            echo "Error";
            mysqli_error($result);
        }

        $query = "DELETE FROM date WHERE Contact_Id = $contact_id";
        echo $query;
        $result = mysqli_query($dbc, $query);
        
        if($result){
            echo "Deleted";
        }           
        else{
            echo "Error";
            mysqli_error($result);
        }

        $query = "DELETE FROM contact WHERE ContactId = $contact_id";
        echo $query;
        $result = mysqli_query($dbc, $query);
        
        if($result){
            echo "Deleted";
        }           
        else{
            echo "Error";
            mysqli_error($result);
        }
        // Close connection to the database
        mysqli_close($dbc);
    }
?>