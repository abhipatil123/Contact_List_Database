
<?php
    //if(isset($_GET['id'])){
    $contact_id = $_GET["id_"];
    
    if($contact_id){
        // Get a connection for the database
        require_once('mysqli_connect.php'); 

        $query = "DELETE FROM contact WHERE ContactId = $contact_id";
        $result = mysqli_query($dbc, $query);
        

        mysqli_error($result);
        // Close connection to the database
        mysqli_close($dbc);
    }
?>