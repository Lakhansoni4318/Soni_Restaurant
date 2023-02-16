<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true) {
    $loggedin =true;
}
else{
    $loggedin =false;
}
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
</head>

<body onload="pageLoad()">
    <div id="loading">
        <p>Welcome to Soni Restaurant</p>
    </div>
    <?php include('Navbar.php') ?>
    <!-- carousel -->
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="./Image/South_Indian/south-indian-1.jpg" class="d-block w-100 opacity-50"
                    alt="..." height="400vh">
                <div class="carousel-caption text-center">
                    <h5 class="animated bounceInDown text-dark fs-2" style="animation-delay:1s;">Soni Restaurant - The
                        Quality Food!</h5>
                    <p class="animated bounceInUp text-dark fs-3" style="animation-delay:3s">We deliver Quality. Try
                        us and then buy us!</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="./Image/Indian-Food/Indian-Food.jpg" class="d-block w-100 opacity-50 img" alt="..."
                    height="400vh">
                <div class="carousel-caption text-center">
                    <h5 class="animated bounceInLeft text-dark fs-2" style="animation-delay:1s;">Quality Food at Your
                        Door!</h5>
                    <p class="animated bounceInRight text-dark fs-3" style="animation-delay:3s">We deliver Quality And
                        We're doing this for years!</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="./Image/Chinese/chinese0.jpg" class="d-block w-100 opacity-50 img" alt="..." height="400vh">
                <div class="carousel-caption text-center">
                    <h5 class="animated bounceInLeft text-dark fs-2" style="animation-delay:1s;">Quality Food at Your
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
        <h5 class="fs-1">Welcome to Soni Restaurant</h5>
        <img src="you-are-welcome-appreciate.gif" alt="" style="width: 50vw;">
    </div>
    <div class="row justify-content-around m-0">
        <div class="col-md-3 mt-3">
            <div class="card card-inverse card-primary text-center">
                <img class="card-img-top" src="./Image/Indian-Food/Indian-Food.jpg" alt="Card image cap" height="250px">
                <div class="card-block">
                    <h4 class="card-title text-dark">Indian Food</h4>
                    <p class="card-text text-dark">Most of them when they think of Indian food, all they can think of is
                        the wide variety available</p>
                    <a href="Indian-Food.php" class="btn btn-primary">Order Now </a>
                </div>
            </div>
        </div>
        <div class="col-md-3 mt-3">
            <div class="card card-inverse card-primary text-center">
                <img class="card-img-top view overlay zoom" src="./Image/South_Indian/south-indian-1.jpg"
                    alt="Card image cap" height="250px">
                <div class="card-block">
                    <h4 class="card-title text-dark">South Indian</h4>
                    <p class="card-text text-dark">South Indian food has earned much fame across the globe, particularly
                        for scrumptious dishes</p>
                    <a href="South-Indian-Food.php" class="btn btn-primary">Order Now </a>
                </div>
            </div>
        </div>
        <div class="col-md-3 mt-3">
            <div class="card card-inverse card-success text-center">
                <img class="card-img-top" src="./Image/Chinese/chinese0.jpg" alt="Card image cap" height="250px">
                <div class="card-block">
                    <h4 class="card-title text-dark">Chineses Food</h4>
                    <p class="card-text text-dark">There's Nothing Better than Chinese Dishes, Don't Just Do it, Chinese
                        Food It, Time For a Chinese Food</p>
                    <a href="Chinese.php" class="btn btn-primary">Order Now </a>';
                </div>
            </div>
        </div>
    </div>
    <div class="text-center mt-5 mb-5">
        <a href="Categories.php" class="btn btn-danger">More Food >></a>
    </div>
    <div class="row text-center m-0 justify-content-around">
        <div class="col-md-3">
            <i class="bi bi-cash" style="font-size: 10vh;"></i>
            <p>Cash on Delivery</p>
        </div>

        <div class="col-md-3">
            <i class="bi bi-truck" style="font-size: 10vh;"></i>
            <p>Free Delivery</p>
        </div>

        <div class="col-md-3">
            <i class="bi bi-emoji-laughing-fill" style="font-size: 10vh;"></i>
            <p>Excellent Quality</p>
        </div>
    </div>

    <?php include('Footer.php') ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>

    <script>
    const pageLoad = () => {
        document.getElementById('loading').style.display = "none"
    }
    </script>

</body>

</html>