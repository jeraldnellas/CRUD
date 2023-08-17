<?php 
include_once "db/db_con.php";
session_start();
$id =   $_SESSION['user_id'];
if(!isset($id)){
    header('location: login.php');
}

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
    header('location:users_info.php');
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
    <title>All Users</title>
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col s12 m12">
                <div class="card">
                    <div class="card-content">
                       <div class="row">
                        <div class="col s12 m6 offset-l3 center">
                        <a href="index.php" class="left"><i class="material-icons red-text tooltipped" data-position="bottom" data-tooltip="Back">arrow_back</i></a>
                        <a href="#modal1" class="modal-trigger right tooltipped" data-position="bottom" data-tooltip="Add User"><i class="material-icons green-text">person_add</i></a>
                        </div>
                       </div>
                        <h5 class="center blue white-text">All users</h5>
                        <table>
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>User type</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $select = "SELECT * FROM `user_register`";
                                $result = mysqli_query($con, $select);
                                while($row = mysqli_fetch_assoc($result))
                                
                                { ?>
                                <tr>
                                    <td><?php echo $row['id'] ?></td>
                                    <td><?php echo $row['name'] ?></td>
                                    <td><?php echo $row['email'] ?></td>
                                    <td><?php echo $row['username'] ?></td>
                                    <td><?php echo $row['password'] ?></td>
                                    <td><?php echo $row['user_type'] ?></td>
                                    <td><a href="update_user_info.php?id=<?php echo $row['id'] ?>"><i class="material-icons blue-text">edit</i></a></td>
                                    <td><a href=""><i class="material-icons red-text">delete</i></a></td>
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="modal1">
        <div class="modal-content center">
            <form action="" method="post">
           <a href="#" class="modal-close right tooltipped" data-position="bottom" data-tooltip="close"><i class="material-icons red-text">close</i></a><br>
                <h5 class="center">Add User</h5>
                <?php if(isset($message)){
                         foreach($message as $messages){
                            echo '<div class="red-text">'.$messages.'</div>';
                         }   
                        }
                            ?>
                <div class="row">
                    <div class="col s12 m6">
                    <div class="input-field">
                    <input type="text" name="name" placeholder="Type your name" required>
                </div>
                    </div>
                    <div class="col s12 m6">
                    <div class="input-field">
                    <input type="text" name="email" placeholder="Type your email" required>
                </div>
                    </div>
                    <div class="col s12 m6">
                    <div class="input-field">
                    <input type="text" name="username" placeholder="Type your Username" required>
                </div>
                    </div>
                    <div class="col s12 m6">
                    <div class="input-field">
                    <input type="password" name="password" placeholder="Type your Password" required>
                      </div>
                    </div>
                    <div class="col s12 m6">
                    <div class="input-field">
                    <input type="password" name="cpassword" placeholder="Confirm Password" required>
                      </div>
                    </div>
                    <div class="col s12 m6">
                    <div class="input-field" >
                                <select name="user_type" id="" required>
                                    <option value=""></option>
                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>
                                </select>
                                <label for="user_type">Choose User Type</label>
                            </div>
                            </div>
                </div>
           
        </div>
        <div class="modal-footer">
    <div class="right">
     
         <button type="submit" class="btn-flat blue white-text" name="submit">Submit</button>
</div>
    </div>
    </form>
    </div>
    

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="js/materialize.min.js"></script>
<script src="js/index.js"></script>
<script>
     $(document).ready(function(){
    $('.modal').modal();
  });

  $(document).ready(function(){
    $('select').formSelect();
  });
        
</script>
</body>
</html>