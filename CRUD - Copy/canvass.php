<?php
include_once "db/db_con.php";
session_start();

if(isset($_POST['submit'])){

    $items = $_POST['items'];
    $qty = $_POST['qty'];
    $price = $_POST['price'];

    $select = "SELECT * FROM `pricing item`";
    $result = mysqli_query($con, $select);
    $row = mysqli_fetch_assoc($result);


   $insert = "INSERT INTO `pricing item`(`items`, `qty`, `price`) VALUES ('$items', '$qty', '$price')";
   mysqli_query($con, $insert); 
   header('location: pdf_gen.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/materialize.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>canvass ITEM</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col s12 m6 offset-l3">
                <div class="card">
                    <div class="card-content">
                        <form action="" method="post">
                            <h5 class="center">Canvass Item</h5>
                            input
                            <div class="input-field">
                                <select name="items" id="">
                                    <option value="">
                                        <option value="Samsung laptop">Samsung Laptop</option>
                                        <option value="Dell laptop">Dell Laptop</option>
                                        <option value="Asus laptop">Asus Laptop</option>
                                        <option value="Hwawie laptop">Hwawie Laptop</option>
                                    </option>
                                    
                                </select>
                                <label for="">Choose Item</label>
                            </div>
                            <div class="input-field">
                                <input type="number" name="qty" placeholder="Quantity">
                            </div>
                            <div class="input-field">
                                <input type="number" name="price" placeholder="Item Price">
                            </div>
                            <button type="submit" class="btn-flat blue white-text" style="width: 100%" name="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="js/materialize.min.js"></script>
<script src="js/index.js"></script>
</body>
</html>