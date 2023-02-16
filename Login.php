<?php
 
include_once('connection.php');
  
function test_input($data) {
     
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
  

if ($_SERVER["REQUEST_METHOD"] == "POST") {
     
    $username = test_input($_POST["username"]);
    $password = test_input($_POST["password"]);
    $stmt = $conn->prepare("SELECT * FROM users");
    $stmt->execute();
    $users = $stmt->fetchAll();
  
    $found = false;
    foreach($users as $user) {        
        if(($user['username'] == $username) &&
            ($user['password'] == $password)) {
                $found = true;
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                header("location: index.php");
        }
    }

    if (!$found) {
        echo "<script>alert('WRONG INFORMATION')</script>";
}
}
 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- Boostrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
</head>

<body style="background-color: #316498;">
    <div class="container pt-5 mt-5">
        <div class="row">
            <div class="col-12 col-sm-8 col-md-6 m-auto">
                <div class="card">
                    <div class="card-body bg-dark p-5">
                        <form action="Login.php" method="post">
                            <p class="text-light text-center fw-bold fs-3">Please Login</p>
                            <div class="my-3">
                                <label for="exampleInputEmail1" class="form-label text-light">Email</label>
                                <input type="text"
                                    class="form-control text-light rounded-0 border-0 border-bottom bg-transparent"
                                    id="exampleInputEmail1" aria-describedby="emailHelp" name="username">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label text-light">Password</label>
                                <input type="password"
                                    class="form-control text-light rounded-0 border-0 border-bottom bg-transparent"
                                    id="exampleInputPassword1" name="password">
                            </div>
                            <div class="row text-center">
                                <button type="submit" class="mt-3 btn btn-warning btn-lg">Login</button>
                            </div>
                            <p class="form-text mt-3 text-light fs-6 mt-4">Don't have an account? <a href="SignUp.php"
                                    class="text-warning text-decoration-none">Sign Up</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
</body>

</html>