<?php
include_once "db/db_con.php";

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    
    $pass = $_POST['password'];
    $cpass = $_POST['cpassword'];
    $user_type = $_POST['user_type'];

$select = "SELECT * FROM `user_register` WHERE email = '$email' AND name = '$name'";
$result = mysqli_query($con, $select);

if(mysqli_num_rows($result) > 0){
    $message[] = "Account already exist!";
}elseif($pass != $cpass ){
    $message[] = "Password not match!";
}else{
    $insert = "INSERT INTO `user_register`(`name`, `email`, `username`, `password`, `cpassword`, `user_type`) VALUES ('$name','$email', '$username', '$pass', '$cpass', '$user_type')";
    mysqli_query($con, $insert);
    header('location:login.php');
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
    <title>Register</title>
</head>
<body>

 <?php include_once "include/nav.php"?>

    <div class="container">
        <div class="row">
            <div class="col s12 m6 offset-l3">
                <div class="card">
                    <div class="card-content center">
                        <h5>Register</h5>
                        <?php if(isset($message)){
                         foreach($message as $messages){
                            echo '<div class="red-text">'.$messages.'</div>';
                         }   
                        }
                            ?>
                        <form action="" method="post">
                            <div class="input-field">
                                <input type="text" name="name" placeholder="Type your name">
                            </div>

                            <div class="input-field">
                                <input type="text" name="username" placeholder="Type your username">
                            </div>

                            <div class="input-field">
                                <input type="email" name="email" placeholder="Type your Email">
                            </div>

                            <div class="input-field">
                                <input type="password" name="password" placeholder="Type your password">
                            </div>

                            <div class="input-field">
                                <input type="password" name="cpassword" placeholder="Confirm your password">
                            </div>

                            <div class="input-field">
                                <select name="user_type" id="">
                                    <option value=""></option>
                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>
                                </select>
                                <label for="user_type">Choose User Type</label>
                            </div>

                            <button type="submit" name="submit" class="btn blue white-text" style="width: 100%;">Submit</button>
                        </form>
                        <p>Already have an account? <a href="login.php">Login here</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>







<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="js/materialize.min.js"></script>
<script>
      $(document).ready(function(){
    $('select').formSelect();
  });
</script>
</body>
</html>