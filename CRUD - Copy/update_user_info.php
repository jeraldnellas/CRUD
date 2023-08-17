<?php 
include_once "db/db_con.php";
session_start();
$id =   $_SESSION['user_id'];
if(!isset($id)){
    header('location: login.php');
}


// fetching
        $id_user = $_GET['id'];
         $select = "SELECT * FROM `user_register` WHERE id = '$id_user'";
         $result = mysqli_query($con, $select);
         $row = mysqli_fetch_assoc($result);

         if(isset($_POST['submit'])){
             $name = mysqli_real_escape_string ($con, $_POST['name']);
             $email = mysqli_real_escape_string ($con, $_POST['email']);
             $mobile_nos = mysqli_real_escape_string ($con, $_POST['mobile_nos']);
             $gender = mysqli_real_escape_string ($con, $_POST['gender']);
             $bdate = mysqli_real_escape_string ($con, $_POST['bdate']);
             $height = mysqli_real_escape_string ($con, $_POST['height']);
             $weight = mysqli_real_escape_string ($con, $_POST['weight']);
             $user_type = mysqli_real_escape_string ($con, $_POST['user_type']);

             $update_query = "UPDATE `user_register` SET `name`='$name',`email`='$email',`bdate`='$bdate',`gender` = '$gender', `mobile_nos`='$mobile_nos',`height`='$height',`weight`='$weight',`user_type` = '$user_type' WHERE id = '$id'";
            //  mysqli_query($con, $select);
            //  header('location: index.php');
            // $insert = "INSERT INTO `user_register`(`name`, `email`, `username`, `password`, `cpassword`, `user_type`, `bdate`, `mobile_nos`, `height`, `weight`) VALUES ('$name', '$email', '$mobile_nos', '$gender', '$height', '$weight' )";
            mysqli_query($con, $update_query);
             header('location: index.php');
            
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
    <style>
        #cam {
            position: relative;
            top: -20px;
            left: 20px;
        }
    </style>
    <title>Update User Info</title>
  </head>
  <body>

  <div class="container">
    <div class="row">
        <div class="col s12 m6 offset-l3">
            <div class="card">
                <div class="card-content center">
                <a href="index.php" class="btn-flat red-text left tooltipped" data-position="bottom" data-tooltip="Back"><i class="material-icons">arrow_back</i></a><br>
                <h5>Edit Info</h5>
                <?php 
                          $select = "SELECT * FROM `user_register`";

                        $result = mysqli_query($con, $select);
                        if(mysqli_num_rows($result) > 0){
                           $fetch = mysqli_fetch_assoc($result);
                        }
                        // }if($fetch['image'] == ''){
                        //     echo '<i class="material-icons medium">person</i> <br>';
                        // }else{
                           
                        // }
                        ?>
                          <?php 
                           echo '<img src="upload-img/'.$row['id']."/".$row['image'].'" class="circle responsive-img" width="80"> <br>';
                        ?>
                        <a href="update_profile.php?id=<?php echo $row['id']?>" id="cam"><i class="material-icons">add_a_photo</i></a>
                            <form action="" method="post">
                            <div class="input-field">
                                <input type="text" name="name" placeholder="Type your name" required value="<?php echo $row['name'];?>">
                            </div>
                            <div class="input-field">
                                <input type="text" name="email" placeholder="Type your Email" required value="<?php echo $row['email'];?>">
                            </div>
                            <div class="input-field">
                                <input type="Date" name="bdate" placeholder="Enter your Birthdate" required value="<?php echo $row['bdate'];?>">
                            </div>
                            <div class="input-field" >
                                <select name="gender" id="">
                                        
                                        <option value="Male" <?php echo ($row['gender'] == "Male")? 'selected' : ''; ?>>Male</option>
                                        <option value="Female" <?php echo ($row['gender'] == "Female")? 'selected' : ''; ?>>Female</option>
                                    </select>
                                    <label for="gender">Select Gender</label>
                            </div>

                            <div class="input-field">
                                <input type="number" name="mobile_nos" placeholder="Enter your Mobile Number" required value="<?php echo $row['mobile_nos'];?>"> 
                            </div>
                            <div class="input-field">
                                <input type="number" name="height" placeholder="Height" required value="<?php echo $row['height'];?>">
                                <label for="height">(cm)</label>
                            </div>
                            <div class="input-field">
                                <input type="number" name="weight" placeholder="Weight" required value="<?php echo $row['weight'];?>">
                                <label for="weight">(kg)</label>
                            </div>

                            <div class="input-field">
                                <select name="user_type" id="">
                                    <option value=""></option>
                                    <option value="user" <?php echo ($row['user_type'] == "user")? 'selected' : ''; ?>>User</option>
                                    <option value="admin" <?php echo ($row['user_type'] == "admin")? 'selected' : ''; ?>>Admin</option>
                                </select>
                                <label for="user_type">Choose User Type</label>
                            </div>
                            <button type="submit" name="submit" class="btn blue white-text" style="width:100%">Submit</button>
                        </form>
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
<script src="js/index.js"></script>
  </body>
  </html>            