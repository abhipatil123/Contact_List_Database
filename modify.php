<html>

<head>
    <title>Add Contact</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
    </script>
    <script>
        $(document).ready(function () {
            $("#add").click(function () {
                $("#address").clone().appendTo("#addressclone").show();

                $(document).on("click", "#del", function () {
                    $(this).parent("#address").remove();
                });

            });
           
            $(document).on("click", "#del", function () {
                $(this).parent("#address_existing").remove();
            });

            $(document).on("click", "#del", function () {
                $(this).parent("#phone_existing").remove();
            });

            $(document).on("click", "#del", function () {
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
    
        <div id="Name">
            <table border="0">
                <tr>
                    <td align="center"> <input type="text" name="first_name" size="30" value= '<?php echo $Fname?>' /></td>
                </tr>

                <tr>
                    <td align="center"> <input type="text" name="middle_name" size="30" value='<?php echo $Mname?>' /></td>
                </tr>

                <tr>
                    <td align="center"> <input type="text" name="last_name" size="30" value='<?php echo $Lname?>' /></td>
                </tr>
            </table>
        </div>
        <br />

        <button id="add" type="button">ADD Address Info</button>

        <div id="addressclone"></div>
        
        <?php for($i = 0; $i < count($address); $i++){?>
            <div id="address_existing">
                <table id="tab" class="wrapper">

                    <tr id="row" class="abcd">
                    <tr>
                        <td>
                            <label for=add_type>Address Type</label>
                            <select id="add_type" name="add_type[]" value = "<?php echo $addresstype[$i]?>">
                                <option value="Home">Home</option>
                                <option value="Work">Work</option>
                            </select>
                        </td>
                        <td> 
                            <input type = "hidden" name = "addressId[]" value = "<?php echo $addressId[$i]?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="address[]" value='<?php echo $address[$i]?>' />
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
                <button id="del" type ="button">DEL</button>
            </div>
        <?php }?>

        <div id="address" style="display: none">
            <table id="tab" class="wrapper">

                <tr id="row" class="abcd">
                <tr>
                    <td>
                        <label for=add_type>Address Type</label>
                        <select id="add_type" name="add_type[]">
                            <option value="Home">Home</option>
                            <option value="Work">Work</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="address[]" placeholder='Enter Address' />
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
            <button id="del" type ="button">DEL</button>
        </div>
        <br />
        <button id="addPhone" type="button">ADD Phone Info</button>
        
        <?php for($i = 0; $i < count($phonetype); $i++){?>
            <div id="phone_existing">
                <table id="tab" class="wrapper">

                    <tr id="row" class="abcd">
                    <tr>
                        <td>
                            <label for=add_type>Phone Type</label>
                            <select id="add_type" name="phone_type[]">
                                <option value="Home">Home</option>
                                <option value="Work">Work</option>
                            </select>
                        </td>
                        <td> 
                            <input type = "hidden" name = "phoneId[]" value = "<?php echo $phoneId[$i]?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name='areacode[]' value='<?php echo $areacode[$i]?>' />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name='number[]' value='<?php echo $number[$i]?>' />
                        </td>
                    </tr>
                    </tr>
                </table>
                <button id="del" type ="button">DEL</button>
            </div>
        <?php } ?>
        
        <div id="phoneclone"></div>
        <div id="phone" style="display: none">
            <table id="tab" class="wrapper">
                <tr id="row" class="abcd">
                <tr>
                    <td>
                        <label for=add_type>Phone Type</label>
                        <select id="add_type" name="phone_type[]">
                            <option value="Home">Home</option>
                            <option value="Work">Work</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="text" name='areacode[]' placeholder='Enter Area Code' />
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
        <button id="addDate" type="button">ADD Date Info</button>
        
        <?php for($i = 0; $i < count($datetype); $i++){?>
            <div id="date_existing">
                <table id="tab" class="wrapper">
                    <tr id="row" class="abcd">
                    <tr>
                        <td>
                            <label for=add_type>Date Type</label>
                            <select id="add_type" name="date_type[]">
                                <option value="BirthDate">Birth</option>
                                <option value="AnniverseryDate">Anniversery</option>
                            </select>
                        </td>
                        <td> 
                            <input type = "hidden" name = "dateId[]" value = "<?php echo $dateId[$i]?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="date" name='day[]' value='<?php echo $date[$i]?>' />
                        </td>
                    </tr>
                    </tr>
                </table>
                <button id="del" type ="button">DEL</button>
            </div>
        <?php } ?>

        <div id="dateclone"></div>
        <div id="date" style="display: none">
            <table id="tab" class="wrapper">
                <tr id="row" class="abcd">
                <tr>
                    <td>
                        <label for=add_type>Phone Type</label>
                        <select id="add_type" name="date_type[]">
                            <option value="BirthDate">Birth</option>
                            <option value="AnniverseryDate">Anniversery</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="date" name='day[]' />
                    </td>
                </tr>
                </tr>
            </table>
            <button id="del" type ="button">DEL</button>
        </div>
        <br />
        <div id="submit">
            <table id="tab" class="wrapper">

                <tr id="row" class="abcd">
                <tr>
                    <td colspan="2" align="center"><input type="submit" name='newcontact' value="Send" /></td>
                </tr>
                </tr>
            </table>
        </div>
</body>

</html>