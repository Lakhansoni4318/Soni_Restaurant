<?php
echo'<nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
         <div class="container-fluid">
             <a class="navbar-brand" href="index.php/">Soni Restaurant</a>
             <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                 data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                 aria-label="Toggle navigation">
                 <span class="navbar-toggler-icon"></span>
             </button>
             <div class="collapse navbar-collapse" id="navbarSupportedContent">
                 <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                     <li class="nav-item">
                         <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link" href="categories.php">Categories</a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link" href="#footer">Contact</a>
                     </li>
                </ul>
                 <form class="d-flex">
                     <ul class="navbar-nav me-auto mb-2 mb-lg-0">';
                     if(!($loggedin)){
                         echo'<li class="nav-item">
                             <a class="nav-link" href="SignUp.php"><i class="bi bi-person me-1"></i>Sign Up</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link" href="Login.php"><i class="bi bi-box-arrow-right me-1"></i>Login</a>
                         </li>';

                     }
                         if($loggedin){
                         echo'<li class="nav-item">';
                         $count = 0;
                           if(isset($_SESSION['cart']))
                           {
                             $count=count($_SESSION['cart']);
                           }
                           echo '<a href="add.php" class="btn btn-light"><i class="bi bi-bag"></i> Cart '; echo $count; 
                           echo '</a>
                     </li>
                         <li class="nav-item">
                             <a class="nav-link" href="Logout.php"><i class="bi bi-box-arrow-right me-1"></i>LogOut</a>
                         </li>';
                         }
                     echo'</ul>
                 </form>
             </div>
         </div>
     </nav>';
     ?>