<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['addcart'])) {
        if (isset($_SESSION['cart'])) {
            // Check if the item is already in the cart
            $myitem = array_column($_SESSION['cart'], 'Item_Name');
            if (in_array($_POST['Item_Name'], $myitem)) {
                // If the item is already in the cart, display an alert and redirect to the index page
                echo "<script>alert('Item Already Added');
                window.location.href='Chinese.php';
                </script>";
            } else {
                // If the item is not in the cart, add it to the cart and display an alert
                $count = count($_SESSION['cart']);
                $_SESSION['cart'][$count] = array(
                    'Item_Name' => $_POST['Item_Name'],
                    'Price' => $_POST['Price'],
                    'Quantity' => 1
                );
                echo "<script>alert('Item Added');
                window.location.href='breakfast.php';
                </script>";
            }
        } else {
            // If the cart is not set, create it and add the item to the cart
            $_SESSION['cart'][0] = array(
                'Item_Name' => $_POST['Item_Name'],
                'Price' => $_POST['Price'],
                'Quantity' => 1
            );
            echo "<script>alert('Item Added');
                window.location.href='breakfast.php';
                </script>";
        }
    }
    if (isset($_POST['remove'])) {
        // Remove the item from the cart and display an alert
        foreach ($_SESSION['cart'] as $key => $value) {
            if ($value['Item_Name'] == $_POST['Item_Name']) {
                unset($_SESSION['cart'][$key]);
                $_SESSION['cart'] = array_values($_SESSION['cart']);
                echo "<script>
                    alert('Item Removed');
                    window.location.href = 'add.php';
                </script>
                ";
                
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "users";
                
                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                
                // sql to delete a record
                $sql = "DELETE FROM food WHERE Item_Name='$value[Item_Name]'";
                
                
                if ($conn->query($sql) === TRUE) {
                    echo "Record deleted successfully";} 
                // else {
                //     echo "Error deleting record: " . $conn->error;
                // }
                
                $conn->close();
            }
        }
    }
}


$insert = false;
if(isset($_POST['name'])){
    // Set connection variables
    $server = "localhost";
    $username = "root";
    $password = "";

    // Create a database connection
    $con = mysqli_connect($server, $username, $password);

    // Check for connection success
    if(!$con){
        die("connection to this database failed due to" . mysqli_connect_error());
    }
    // echo "Success connecting to the db";
    $randomid = (rand(1,1000000));
    // Collect post variables
    $name = $_POST['name'];
    $number = $_POST['number'];
    $pincode = $_POST['pincode'];
    $address = $_POST['address'];
    $landmark = $_POST['landmark'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $sql = "INSERT INTO `users`.`data` (`name`, `number`, `pincode`, `address`, `landmark`, `state`,`country`, `dt`, `gnumber`) VALUES ('$name', '$number', '$pincode', '$address', '$landmark', '$state','$country', current_timestamp(), $randomid);";

    // echo $sql;

    // Execute the query
    if($con->query($sql) == true){
        // echo "Successfully inserted";

        // Flag for successful insertion
        $insert = true;
    }
    else{
        echo "ERROR: $sql <br> $con->error";
    }

    // Close the database connection
    $con->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soni Restaurant</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <style>
    body::-webkit-scrollbar {
        display: none;
    }
    </style>
</head>

<body>
    <?php
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true) {
    $loggedin =true;
}
else{
    $loggedin =false;
}
include('Navbar.php');
?>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center border round bg-light my-5">
                <h1>My Cart</h1>
            </div>
            <div class="col-lg-9">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Serial No.</th>
                            <th scope="col">Item Name</th>
                            <th scope="col">Item Price</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php
                $total = 0;
                $i = 0;
                if (isset($_SESSION['cart'])) {
                    foreach($_SESSION['cart'] as $key => $value)
                    {   
                        $i++;
                        $total += $value['Quantity'] * $value['Price'];
                        echo"
                        <tr>
                        <td>$i</td>
                        <td>$value[Item_Name]</td>
                        <td>$value[Price]</td>
                        <form action = 'add.php' method = 'POST'>
                        <td><button name = 'remove' class='btn btn-sm btn-danger'>Remove</button>'</td>
                        <td><input type = 'hidden' name = 'Item_Name' value = '$value[Item_Name]'></td>
                        </tr>
                        </form>";   
                    }
                }
                ?>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-3">
                <div class="border bg-light round p-4">
                    <h3>Total</h3>
                    <h5 class="text-right">
                        <?php echo $total ?>
                    </h5>
                    <br />
                    <form>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2"
                                checked>
                            <label class="form-check-label" for="flexRadioDefault2">
                                Cash On Delivery
                            </label>
                        </div>
                        <br />
                        <?php
                        if($total == 0)
                        {
                            echo '<a href="invoice.php" class="btn btn-primary btn-block" style="display: none">Make Purchase</a>';
                        }
                        else{
                            if (isset($_POST['submit'])) {
                            echo '<a href="invoice.php" class="btn btn-primary btn-block">Make Purchase</a>';
                            }
                        }
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
    if($total > 0)
    {
        if (isset($_POST['submit'])) {
            echo '<style>#hide { display: none; }</style>
            <script>alert("Your data will submited")</script>';
            }
    echo'<div class="container mt-5" id = "hide">
    <p class="fs-1">Billing Details</p>
    <div class="text-center">
        <button class="btn btn-primary button" onclick="a()"><i class="bi bi-geo-alt-fill"></i> Detect</button>
    </div>

    <form name="myData" action="add.php" method="post" onsubmit="return validateForm()">
    <div class="mb-3" id="name">
        <label for="txt1" class="form-label">Full name</label>
        <input type="text" class="form-control" name="name" id="txt1" style="width: 60vw">
        <span class="error"></span>
    </div>
    <div class="mb-3" id="number">
        <label for="txt2" class="form-label">Mobile Number</label>
        <input type="text" class="form-control" name="number" id="txt2" style="width: 60vw">
        <span class="error"></span>
    </div>
    <div class="mb-3" id="pincode">
        <label for="txt3" class="form-label">Pincode</label>
        <input type="text" class="form-control" name="pincode" id="txt3" style="width: 60vw">
        <span class="error"></span>
    </div>
    <div class="mb-3" id="address">
        <label for="txt4" class="form-label">Flat, House no., Building, Company, Apartment</label>
        <input type="text" class="form-control" name="address" id="txt4" style="width: 60vw">
        <span class="error"></span>
    </div>
    <div class="mb-3" id="landmark">
        <label for="txt5" class="form-label">Landmark</label>
        <input type="text" class="form-control" name="landmark" id="txt5" style="width: 60vw">
        <span class="error"></span>
    </div>
    <div class="mb-3" id="state">
        <label for="txt6" class="form-label">State</label>
        <input type="text" class="form-control" name="state" id="txt6" style="width: 60vw">
        <span class="error"></span>
    </div>
    <div class="mb-3" id="country">
        <label for="txt7" class="form-label">Country</label>
        <input type="text" class="form-control" name="country" id="txt7" style="width: 60vw">
        <span class="error"></span>
    </div>
    <div class="text-center my-3">
    <input type="submit"  name="submit" class="btn btn-primary" value="Deliver to these address">
    </div>
</form>
</div>
<script>
    const button = document.querySelector(".button");
    const txt1 = document.querySelector("#txt1");
    const txt2 = document.querySelector("#txt2");
    const txt3 = document.querySelector("#txt3");
    const txt4 = document.querySelector("#txt4");
    const txt5 = document.querySelector("#txt5");
    const txt6 = document.querySelector("#txt6");
    const txt7 = document.querySelector("#txt7");
    function a(){
        if (navigator.geolocation) {
            button.innerText = "Allow to detect location";
            navigator.geolocation.getCurrentPosition(onSuccess, onError);
        } else {
            button.innerHTML = "Your browser not support";
        }
    };

    function onSuccess(position) {
        button.innerHTML = "Detecting your location..."
        let { latitude, longitude } = position.coords;
        fetch(`https://api.opencagedata.com/geocode/v1/json?q=${latitude}+${longitude}&key=d5818e743ff8492cb37cf014f5951e4f`)
            .then(response => response.json()).then(response => {
                let allDetails = response.results[0].components;
                console.table(allDetails);
                let { postcode, neighbourhood, county, state, country} = allDetails;
                txt3.value = postcode
                txt4.value = neighbourhood
                txt5.value = county
                txt6.value = state
                txt7.value = country
            }).catch(() => {
                button.innerText = "Something went wrong";
            });
    }

    function onError(error) {
        if (error.code == 1) {
            button.innerText = "You denied the request";
        } else if (error.code == 2) {
            button.innerText = "Location is unavailable";
        } else {
            button.innerText = "Something went wrong";
        }
        button.setAttribute("disabled", "true");
    }

</script>
        ';
    }
    ?>

    <script>
    function clearErrors() {
        errors = document.getElementsByClassName('error');
        for (let item of errors) {
            item.innerHTML = "";
        }
    }

    function seterror(id, error) {
        element = document.getElementById(id);
        element.getElementsByClassName('error')[0].innerHTML = error;
    }

    function validateForm() {
        let returnval = true;
        clearErrors();
        let name = document.forms['myData']["txt1"].value;
        if (isNaN(name) == false || name == "") {
            seterror("name", "*Please Enter a Text");
            returnval = false;
        }

        let number = document.forms['myData']["txt2"].value;
        if (isNaN(number) == true || number == "") {
            seterror("number", "*Please Enter a Number");
            returnval = false;
        } else if (number.length != 10) {
            seterror("number", "*Please Enter a 10 Digit Number");
            returnval = false;
        }

        let pincode = document.forms['myData']["txt3"].value;
        if (isNaN(pincode) == true || pincode == "") {
            seterror("pincode", "*Please Enter a Pincode Number");
            returnval = false;
        } else if (pincode.length != 6) {
            seterror("number", "*Please Enter a 6 Digit Number");
            returnval = false;
        }

        let address = document.forms['myData']["txt4"].value;
        if (address == "") {
            seterror("address", "*Please Enter a Address");
            returnval = false;
        }

        let landmark = document.forms['myData']["txt5"].value;
        if (landmark == "") {
            seterror("landmark", "*Please Enter a Landmark");
            returnval = false;
        }

        let state = document.forms['myData']["txt6"].value;
        if (state == "") {
            seterror("state", "*Please Enter a State");
            returnval = false;
        }

        let country = document.forms['myData']["txt7"].value;
        if (country == "") {
            seterror("country", "*Please Enter a Country");
            returnval = false;
        }
        return returnval;
    }
    </script>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>

</body>

</html>