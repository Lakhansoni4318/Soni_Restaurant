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
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true) {
    $loggedin =true;
}
else{
    $loggedin =false;
}
?>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center border round bg-light my-5">
                <div class="row justify-content-end">
                    <span class='col-6 fs-1 fw-bold'>My Invoice</span>
                    <span class='col-4 d-flex align-items-center'><i class="bi bi-printer-fill fs-1 print"
                            style="cursor: pointer" onclick='print()'></i></span>
                </div>
            </div>
            <?php
                $server = "localhost";
                $username = "root";
                $password = "";
                $dbname = "users";
                
                // Create connection
                $conn = new mysqli($server, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                  die("Connection failed: " . $conn->connect_error);
                }
                
                $sql = "SELECT * FROM data ORDER BY sno DESC LIMIT 1";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                  // output data of each row
                  while($row = $result->fetch_assoc()) {
            echo"<div class='row'>
                <div class='col-6'><p class = 'fs-5 text-danger'>Invoice Number: " . $row['gnumber']."</p></div>
                
                <div class='col-6'><p class = 'fs-5 text-danger'>Customer Name: ". $row['name']."</p></div>
                


                <div class='w-100'></div>
                <div class='col-6'><p class = 'fs-5 text-danger'>Date and Time: ". $row['dt']."</p></div>

                <div class='col-6'><p class = 'fs-5 text-danger'>Address: ". $row['address'].", ". $row['landmark'].", ".$row['state'].", ".$row['country']."</p></div>

                
                <div class='col-6'><p class = 'fs-5 text-danger'>Pincode: ". $row['pincode']."</p></div>
            </div>";
                  }
                }
?>

            <div class='col-lg-9 mt-5'>
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
                        <form action = 'sweets.php' method = 'POST'>
                        <input type = 'hidden' name = 'Item_Name' value = '$value[Item_Name]'
                        </tr>
                        ";
                    }
                }
                ?>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-3 mt-5 text-center text-info">
                <div class="border bg-dark round p-4">
                    <h3>Total</h3>
                    <h5>
                        <?php echo $total." Rs"; ?>
                    </h5>
                    <br />

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    <script>
    const print = () => {
        let print = document.querySelector('.print').style.display = "none"
        window.print();
    }
    </script>
</body>

</html>