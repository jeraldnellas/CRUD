<?php
include_once "db/db_con.php";
session_start();
if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $select = "SELECT * FROM `user_register` WHERE email = '$email' AND password = '$pass'";
    $result = mysqli_query($con, $select);

    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['Name'] = $row['name'];
        $_SESSION['Access'] = $row['user_type'];
        header('location: index.php');
    }else{
        $message[] = "Email or Password is incorrect!";
    }
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
    <title>Login</title>
</head>
<body>
    
    <?php include_once "include/nav.php"; ?>

    <div class="container">
        <div class="row">
            <div class="col s12 m6 offset-l3">
                <div class="card">
                    <div class="card-content center">
                        <h5>Login</h5>
                        <?php if(isset($message)){
                                foreach($message as $messages){
                                    echo '<div class="red-text">'.$messages.'</div>';
                                }
                            }
                            ?>
                       <form action="" method="post">
                       <div class="input-field">
                            <input type="email" name="email" placeholder="Type your Email">
                        </div>

                        <div class="input-field">
                            <input type="password" name="password" placeholder="Type your Password">
                        </div>
                        <button type="submit" name="submit" class="btn blue white-text" style="width: 100%;">Submit</button>
                        <p>No account yet? <a href="register.php">Register here</a></p>
                       </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="js/materialize.min.js"></script>
</body>
</html>