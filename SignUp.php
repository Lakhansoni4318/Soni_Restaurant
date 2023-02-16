<?php
	
$showAlert = false;
$showError = false;
$exists=false;
	
if($_SERVER["REQUEST_METHOD"] == "POST") {
	
	// Include file which makes the	
	// Database Connection.

	include 'dbconnect.php';
	
	$username = $_POST["username"];
	$password = $_POST["password"];
	$cpassword = $_POST["cpassword"];
			
	
	$sql = "Select * from users where username='$username'";
	
	$result = mysqli_query($conn, $sql);
	
	$num = mysqli_num_rows($result);
	
	// This sql query is use to check if
	// the username is already present
	// or not in our Database
	if($num == 0) {
		if(($password == $cpassword) && $exists==false) {
	
			// $hash = password_hash($password,PASSWORD_DEFAULT);
				
			// Password Hashing is used here.
			$sql = "INSERT INTO `users` ( `username`,
				`password`, `Date_Time`) VALUES ('$username',
				'$password', current_timestamp())"; //$hash
	
			$result = mysqli_query($conn, $sql);
	
			if ($result) {
				$showAlert = true;
			}
		}
		else {
			$showError = "Passwords do not match";
		}	
	}// end if
	
if($num>0)
{
	$exists="Your account has been already created";
}
	
}//end if
	
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="Login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- Boostrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
</head>

<body style="background-color: #316498;">

    <?php
	
	if($showAlert) {
	
		echo ' 	<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> Your account is now created and you can login.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div> ';
	}
	if($showError) {
	
		echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
		<strong>Error! </strong>'. $showError.'
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div> ';
}
		
	if($exists) {
		echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
		<strong>Error! </strong>' .$exists.'
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	  </div>';
	}

?>

    <div class="container mt-5 pt-5">
        <div class="row">
            <div class="col-12 col-sm-8 col-md-6 m-auto">
                <div class="card">
                    <div class="card-body bg-dark p-5">
                        <form action="SignUp.php" method="post">
                            <p class="text-light text-center fw-bold fs-3">Sign Up</p>
                            <div class="my-3">
                                <label for="username" class="form-label text-light">Email</label>
                                <input type="text"
                                    class="form-control text-light rounded-0 border-0 border-bottom bg-transparent"
                                    id="username" name="username" aria-describedby="emailHelp" name="username">
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label text-light">Password</label>
                                <input type="password"
                                    class="form-control text-light rounded-0 border-0 border-bottom bg-transparent"
                                    id="password" name="password">
                            </div>
                            <div class="mb-3">
                                <label for="cpassword" class="form-label text-light">Confirm password</label>
                                <input type="password"
                                    class="form-control text-light rounded-0 border-0 border-bottom bg-transparent"
                                    id="cpassword" name="cpassword">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="mt-3 btn btn-warning btn-lg">
                                    SignUp
                                </button>
                            </div>
                            <div class="form-text mt-3 text-light fs-6 mt-4">Already have an account? <a
                                    href="Login.php" class="text-warning text-decoration-none">Login</a></div>
                    </div>
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