
<?php
    //if(isset($_GET['id'])){
    $id = $_GET['id_'];

    echo $_GET['id_'];
    // }else{
    //     echo "Error";
    // }
    // Get a connection for the database
    require_once('mysqli_connect.php'); 

    $query = "DELETE FROM contact WHERE ContactId=$id";

    $result = mysqli_query($dbc, $query);

    echo $result;
    // Close connection to the database
    mysqli_close($dbc);
?>