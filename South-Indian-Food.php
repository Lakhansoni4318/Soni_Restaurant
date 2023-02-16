<?php
session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['addcart'])) {
        if (isset($_SESSION['cart'])) {
            // Check if the item is already in the cart
            $myitem = array_column($_SESSION['cart'], 'Item_Name');
            if (in_array($_POST['Item_Name'], $myitem)) {
                // If the item is already in the cart, display an alert and redirect to the index page
                echo "<script>alert('Item Already Added');
                window.location.href='South-Indian-Food.php';
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
                window.location.href='South-Indian-Food.php';
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
                window.location.href='South-Indian-Food.php';
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
            }
        }
    }
}

include('cart_database.php')
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Soni Restaurant</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <!-- Boostrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    <style>
    body::-webkit-scrollbar {
        display: none;
    }
    </style>
</head>

<body onload="pageLoad()">
    <div id="loading">
        <p>Welcome to Soni Restaurant</p>
    </div>

    <?php
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true) {
    $loggedin =true;
}
else{
    $loggedin =false;
}
include('Navbar.php');
?>

    <!-- carousel -->
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="./Image/South_Indian/eazytrendz_2033_trend20180920125236.jpg"
                    class="d-block w-100 opacity-50 img" alt="..." height="400vh">
                <div class="carousel-caption text-center">
                    <h5 class="animated bounceInDown text-dark fs-2" style="animation-delay:1s">Soni Restaurant - The
                        Quality Food!</h5>
                    <p class="animated bounceInUp text-dark fs-3" style="animation-delay:3s">We deliver Quality. Try
                        us and then buy us!</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="./Image/South_Indian/south-indian-1.jpg" class="d-block w-100 opacity-50 img" alt="..."
                    height="400vh">
                <div class="carousel-caption text-center">
                    <h5 class="animated bounceInLeft text-dark fs-2" style="animation-delay:1s">Quality Food at Your
                        Door!</h5>
                    <p class="animated bounceInRight text-dark fs-3" style="animation-delay:3s">We deliver Quality And
                        We're doing this for years!</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="text-center mt-5 mb-5">
        <h5 class="fs-1">South Indian Food</h5>
    </div>

    <div class="row justify-content-around m-0">
        <div class="col-md-3 my-3 mx-5">
            <form action="South-Indian-Food.php" method="post">
                <div class="card card-inverse card-primary text-center">
                    <img class="card-img-top" src="./Image/South_Indian/south-indian-2.jpg" alt="Card image cap"
                        height="250px">
                    <div class="card-block">
                        <h4 class="card-title text-dark">Ghee Masala Dosa</h4>
                        <p class="card-text text-dark">90</p>
                        <?php
                    if($loggedin){
                    echo'<button type = "submit" class = "btn btn-info" name="addcart">Add to Cart</button>
                    <input type="hidden" name="Item_Name" value="Ghee Masala Dosa"> 
                    <input type="hidden" name="Price" value="90">';
                    }
                    else{
                        echo'<a href = "Login.php" class = "btn btn-info">Add to Cart</a>';
                    }
                echo'</div>
            </div>
                        </form>
        </div>

        <div class="col-md-3 my-3 mx-5">
        <form action="South-Indian-Food.php" method = "post">
            <div class="card card-inverse card-primary text-center">
                <img class="card-img-top" src="./Image/South_Indian/south-indian-3.jpg" alt="Card image cap" height="250px">
                <div class="card-block">
                    <h4 class="card-title text-dark">Idli Sambar with Chutney</h4>
                    <p class="card-text text-dark">70 Rs</p>';
                    if($loggedin){
                    echo'<button type = "submit" class = "btn btn-info" name="addcart">Add to Cart</button>
                    <input type="hidden" name="Item_Name" value="Idli Sambar with Chutney"> 
                    <input type="hidden" name="Price" value="70">';
                    }
                    else{
                        echo'<a href = "Login.php" class = "btn btn-info">Add to Cart</a>';
                    }
                echo'</div>
            </div>
                        </form>
        </div>

        <div class="col-md-3 my-3 mx-5">
        <form action="South-Indian-Food.php" method = "post">
            <div class="card card-inverse card-success text-center">
                <img class="card-img-top" src="./Image/South_Indian/south-indian-4.jpeg" alt="Card image cap" height="250px">
                <div class="card-block">
                    <h4 class="card-title text-dark">Curry Rice</h4>
                    <p class="card-text text-dark">70 Rs</p>';
                    if($loggedin){
                    echo'<button type = "submit" class = "btn btn-info" name="addcart">Add to Cart</button>
                    <input type="hidden" name="Item_Name" value="Curry Rice"> 
                    <input type="hidden" name="Price" value="70">';
                    }
                    else{
                        echo'<a href = "Login.php" class = "btn btn-info">Add to Cart</a>';
                    }
                echo'</div>
            </div>
                        </form>
        </div>

        <div class="col-md-3 my-3 mx-5">
        <form action="South-Indian-Food.php" method = "post">
            <div class="card card-inverse card-success text-center">
                <img class="card-img-top" src="./Image/South_Indian/south-indian-5.jpg" alt="Card image cap" height="250px">
                <div class="card-block">
                    <h4 class="card-title text-dark">Kerala Mango Pulissery</h4>
                    <p class="card-text text-dark">70 Rs</p>';
                    if($loggedin){
                    echo'<button type = "submit" class = "btn btn-info" name="addcart">Add to Cart</button>
                    <input type="hidden" name="Item_Name" value="Kerala Mango Pulissery"> 
                    <input type="hidden" name="Price" value="70">';
                }
                else{
                    echo'<a href = "Login.php" class = "btn btn-info">Add to Cart</a>';
                }
                echo'</div>
            </div>
                        </form>
        </div>

        <div class="col-md-3 my-3 mx-5">
        <form action="South-Indian-Food.php" method = "post">
            <div class="card card-inverse card-success text-center">
                <img class="card-img-top" src="./Image/South_Indian/south-indian-6.jpg" alt="Card image cap" height="250px">
                <div class="card-block">
                    <h4 class="card-title text-dark">Chitranna</h4>
                    <p class="card-text text-dark">70 Rs</p>';
                    if($loggedin){
                    echo'<button type = "submit" class = "btn btn-info" name="addcart">Add to Cart</button>
                    <input type="hidden" name="Item_Name" value="Chitranna"> 
                    <input type="hidden" name="Price" value="70">';
                }
                else{
                    echo'<a href = "Login.php" class = "btn btn-info">Add to Cart</a>';
                }
                echo'</div>
            </div>
                        </form>
        </div>

        <div class="col-md-3 my-3 mx-5">
        <form action="South-Indian-Food.php" method = "post">
            <div class="card card-inverse card-success text-center">
                <img class="card-img-top" src="./Image/South_Indian/south-indian-7.jpg" alt="Card image cap" height="250px">
                <div class="card-block">
                    <h4 class="card-title text-dark">Appam</h4>
                    <p class="card-text text-dark">80 Rs</p>';
                    if($loggedin){
                    echo'<button type = "submit" class = "btn btn-info" name="addcart">Add to Cart</button>
                    <input type="hidden" name="Item_Name" value="Appam"> 
                    <input type="hidden" name="Price" value="80">';
                }
                else{
                    echo'<a href = "Login.php" class = "btn btn-info">Add to Cart</a>';
                }
                echo'</div>
            </div>
                        </form>
        </div>
    </div>';

    include('Footer.php') 
    ?>

                        <script
                            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
                            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
                            crossorigin="anonymous"></script>

                        <script>
                        const pageLoad = () => {
                            document.getElementById('loading').style.display = "none"
                        }
                        </script>

</body>

</html>