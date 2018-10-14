<html>

<head>
    <title>Add Contact</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
    </script>    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="main.css"/>

    <script>
        $(document).ready(function () {
            $("#add").click(function () {
                $("#address").clone().appendTo("#addressclone").show();

                $(document).on("click", "#del", function () {
                    $(this).parent("#address").remove();
                });

            });
           
            $(document).on("click", "#del_existing", function () {
                $ad_id=$(this).val();
                console.log($ad_id);
                
                $.ajax({
                    url: "http://localhost/contactlist/Contact_List_Database/deleteAddContact.php",
                    type: "POST",
                    data: "ad_id="+$ad_id,
                    success: function (data) {
                        console.log(data);
                    },
                    error: function (data) {
                        alert("An error occurred while loading XML file.");
                    },
                });
                $(this).parent("#address_existing").remove();
            });

            $(document).on("click", "#del_existing", function () {
                $ph_id=$(this).val();                
                $.ajax({
                    url: "http://localhost/contactlist/Contact_List_Database/deletePhoneContact.php",
                    type: "POST",
                    data: "ph_id="+$ph_id,
                    success: function (data) {
                        console.log(data);
                    },
                    error: function (data) {
                        alert("An error occurred while loading XML file.");
                    },
                });
                $(this).parent("#phone_existing").remove();
            });

            $(document).on("click", "#del_existing", function () {
                $dt_id=$(this).val();                
                $.ajax({
                    url: "http://localhost/contactlist/Contact_List_Database/deleteDateContact.php",
                    type: "POST",
                    data: "dt_id="+$dt_id,
                    success: function (data) {
                        console.log(data);
                    },
                    error: function (data) {
                        alert("An error occurred while loading XML file.");
                    },
                });
                $(this).parent("#date_existing").remove();
            });

            $("#addPhone").click(function () {
                $("#phone").clone().appendTo("#phoneclone").show();

                $(document).on("click", "#del", function () {
                    $(this).parent("#phone").remove();
                });

            });

            $("#addDate").click(function () {
                $("#date").clone().appendTo("#dateclone").show();

                $(document).on("click", "#del", function () {
                    $(this).parent("#date").remove();
                });

            });
        });
    </script>
</head>

<body>
    <?php
        $contact_id = $_GET["id_"];
    ?>
    <form action="addContact.php?id=<?php echo $contact_id?>" method="post">
        <h2 style="text-align: center"> Modify Contact </h2>
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

            $query = "SELECT * FROM address WHERE Contact_Id =  $contact_id";
            $response = mysqli_query($dbc, $query);
            $i = 0;
            if($response){
                while($row = mysqli_fetch_array($response)){
                    $addressId[$i] = $row['Address_Id'];
                    $addresstype[$i] =  $row['Address_type'];
                    $address[$i] =  $row['Address'];
                    $city[$i] =  $row['City'];
                    $state[$i] =  $row['State'];
                    $zip[$i] =  $row['Zip'];
                    $i = $i + 1;
                }
            }
            
            $query = "SELECT * FROM date WHERE Contact_Id =  $contact_id";
            $response = mysqli_query($dbc, $query);
            $i = 0;
            if($response){
                while($row = mysqli_fetch_array($response)){
                    $dateId[$i] = $row['Date_Id'];
                    $datetype[$i] =  $row['Date_Type'];
                    $date[$i] =  $row['Date'];
                    $i = $i + 1;
                }
            }

            $query = "SELECT * FROM phone WHERE Contact_Id =  $contact_id";
            $response = mysqli_query($dbc, $query);
            $i = 0;
            if($response){
                while($row = mysqli_fetch_array($response)){
                    $phoneId[$i] = $row['Phone_Id'];
                    $phonetype[$i] =  $row['Phone_Type'];
                    $areacode[$i] =  $row['Area_Code'];
                    $number[$i] =  $row['Number'];
                    $i = $i + 1;
                }
            }
        ?>
        <div class = "container">
            <fieldset class="scheduler-border">
                <legend class="scheduler-border">Name</legend>
                <div id="Name">
                    <table>
                        <tr>
                            <td > <input type="text" name="first_name" size="30" value= '<?php echo $Fname?>' class="form-control"/></td>
                        </tr>

                        <tr>
                            <td > <input type="text" name="middle_name" size="30" value='<?php echo $Mname?>' class="form-control"/></td>
                        </tr>

                        <tr>
                            <td > <input type="text" name="last_name" size="30" value='<?php echo $Lname?>' class="form-control"/></td>
                        </tr>
                    </table>
                </div>
            </fieldset>
            <br />

            <button id="add" type="button" class="btn btn-primary btn-sm">ADD Address Info</button>

            <?php for($i = 0; $i < count($address); $i++){?>
                <fieldset class="scheduler-border">
                <legend class="scheduler-border">Address Old</legend>
                    <div id="address_existing">
                        <table id="tab" class="wrapper">

                            <tr id="row" class="abcd">
                            <tr>
                                <td>
                                    <input list="add_type" value='<?php echo  $addresstype[$i]?>' name="add_type[]">
                                    <datalist id="add_type">
                                        <option value="Home">Home</option>
                                        <option value="Work">Work</option>
                                    </datalist>
                                </td>
                                <td> 
                                    <input type = "hidden" name = "addressId[]" value = "<?php echo $addressId[$i]?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="address[]" value='<?php echo $address[$i]?>' class="form-control" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name='city[]' value='<?php echo $city[$i]?>' class="form-control" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name='state[]' value='<?php echo $state[$i]?>' class="form-control" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name='zip[]' value='<?php echo $zip[$i]?>' class="form-control" />
                                </td>
                            </tr>
                            </tr>
                        </table>
                        <button id="del_existing" type ="button" class="btn btn-danger btn-sm" value = "<?php echo $addressId[$i]?>" >DEL</button>
                    </div>
                </fieldset>
            <?php }?>

            <fieldset class="scheduler-border">
                <legend class="scheduler-border">Address New</legend>
            <div id="addressclone"></div>
            </fieldset>

            <div id="address" style="display: none">
                <table id="tab" class="wrapper">

                    <tr id="row" class="abcd">
                    <tr>
                        <td>
                            <input list="add_type" value='<?php echo  $addresstype[$i]?>' name="add_type[]">
                            <datalist id="add_type">
                                <option value="Home">Home</option>
                                <option value="Work">Work</option>
                            </datalist>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="address[]" placeholder='Enter Address' class="form-control" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name='city[]' placeholder='Enter City' class="form-control" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name='state[]' placeholder='Enter State' class="form-control" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name='zip[]' placeholder='Enter Zipcode' class="form-control" />
                        </td>
                    </tr>
                    </tr>
                </table>
                <button id="del" type ="button" class="btn btn-danger btn-sm">DEL</button>
            </div>
            <br />
            <button id="addPhone" type="button" class="btn btn-primary btn-sm">ADD Phone Info</button>
            
            <?php for($i = 0; $i < count($phonetype); $i++){?>
                
                <fieldset class="scheduler-border">
                    <legend class="scheduler-border">Phone Old</legend>
                    <div id="phone_existing">
                        <table id="tab" class="wrapper">

                            <tr id="row" class="abcd">
                            <tr>
                                <td>
                                    <input list="phone_type" value='<?php echo  $phonetype[$i]?>' name="phone_type[]">
                                    <datalist id="phone_type">
                                        <option value="Home">Home</option>
                                        <option value="Work">Work</option>
                                    </datalist>
                                </td>
                                <td> 
                                    <input type = "hidden" name = "phoneId[]" value = "<?php echo $phoneId[$i]?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name='areacode[]' value='<?php echo $areacode[$i]?>' class="form-control" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name='number[]' value='<?php echo $number[$i]?>' class="form-control"/>
                                </td>
                            </tr>
                            </tr>
                        </table>
                        <button id="del_existing" type ="button" class="btn btn-danger btn-sm" value = "<?php echo $phoneId[$i]?>">DEL</button>
                    </div>
                 </fieldset>
            <?php } ?>
            
            <fieldset class="scheduler-border">
                <legend class="scheduler-border">Phone New</legend>
            <div id="phoneclone"></div>
            </fieldset>

            <div id="phone" style="display: none">
                <table id="tab" class="wrapper">
                    <tr id="row" class="abcd">
                    <tr>
                        <td>
                            <input list="phone_type" value='<?php echo  $phonetype[$i]?>' name="phone_type[]">
                            <datalist id="phone_type">
                                <option value="Home">Home</option>
                                <option value="Work">Work</option>
                            </datalist>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name='areacode[]' placeholder='Enter Area Code' class="form-control"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name='number[]' placeholder='Enter Number' class="form-control" />
                        </td>
                    </tr>
                    </tr>
                </table>
                <button id="del" type ="button">DEL</button>
            </div>
            <br />
            <button id="addDate" type="button" class="btn btn-primary btn-sm">ADD Date Info</button>
            
            <?php for($i = 0; $i < count($datetype); $i++){?>
                <fieldset class="scheduler-border">
                <legend class="scheduler-border">Date Old</legend>
                    <div id="date_existing">
                        <table id="tab" class="wrapper">
                            <tr id="row" class="abcd">
                            <tr>
                                <td>
                                    <input list="date_type" value='<?php echo  $datetype[$i]?>' name="date_type[]">
                                    <datalist id="date_type">
                                        <option value="Birth">Birth</option>
                                        <option value="Anniversery">Anniversery</option>
                                    </datalist>
                                </td>
                                <td> 
                                    <input type = "hidden" name = "dateId[]" value = "<?php echo $dateId[$i]?>"/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="date" name='day[]' value='<?php echo $date[$i]?>' class="form-control"/>
                                </td>
                            </tr>
                            </tr>
                        </table>
                        <button id="del_existing" type ="button" class="btn btn-danger btn-sm" value = "<?php echo $dateId[$i]?>">DEL</button>
                    </div>
                </fieldset>
            <?php } ?>
            
            <fieldset class="scheduler-border">
                <legend class="scheduler-border">Date New</legend>
            <div id="dateclone"></div>
            </fieldset>

            <div id="date" style="display: none">
                <table id="tab" class="wrapper">
                    <tr id="row" class="abcd">
                    <tr>
                        <td>
                            <input list="date_type" value='<?php echo  $datetype[$i]?>' name="date_type[]">
                            <datalist id="date_type">
                                <option value="Birth">Birth</option>
                                <option value="Anniversery">Anniversery</option>
                            </datalist>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="date" name='day[]' class="form-control"/>
                        </td>
                    </tr>
                    </tr>
                </table>
                <button id="del" type ="button" class="btn btn-danger btn-sm">DEL</button>
            </div>
            <br />
            <div id="submit">
                <table id="tab" class="wrapper">

                    <tr id="row" class="abcd">
                    <tr>
                        <td colspan="2" align="center"><input type="submit" class="btn btn-success btn-lg" name='newcontact' value="Send" /></td>
                    </tr>
                    </tr>
                </table>
            </div>
        </div>
</body>

</html>