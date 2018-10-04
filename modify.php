<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <title>Add Contact</title>
</head>

<body>
    <?php
        $contact_id = $_GET["id_"];
        echo $contact_id;
    ?>
    <form action="studentadded.php?id=<?php echo $contact_id?>" method="post">
    <h2> Modify Contact </h2>
    <br/>
    <?php
        require_once('mysqli_connect.php');
        $query = "SELECT * FROM contact WHERE ContactId =  $contact_id";
        $response = mysqli_query($dbc, $query);
        if($response){
            $row = mysqli_fetch_array($response);
            $Fname =  $row['Fname'];
            $Mname =  $row['Mname'];
            $Lname =  $row['Lname'];
        }
    ?>
    
    <table border="0">
            <tr>
                <td>First Name</td>
                <td align="center"> <input type="text" name="first_name" size="30" value='<?php echo $Fname?>' /></td>
            </tr>

            <tr>
                <td>Middle Name</td>
                <td align="center"> <input type="text" name="middle_name" size="30"  value='<?php echo $Mname?>'/></td>
            </tr>

            <tr>
                <td>Last Name</td>
                <td align="center"> <input type="text" name="last_name" size="30"  value='<?php echo $Lname?>'/></td>
            </tr>

            <tr>
                <td colspan="2" align="center"><input type="submit" name='modify' value="Modify"/></td>
            </tr>
        </table>
    </form>
</body>

</html>