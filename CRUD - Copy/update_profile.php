<?php
include_once "db/db_con.php";
session_start();
$user_id = $_SESSION['user_id'];
$image_update_query = NULL;
if(isset($_POST['update_profile'])){
    $update_image = $_FILES['update_image']['name'];
    $update_image_size = $_FILES['update_image']['size'];
    $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
    $update_image_folder = 'upload-img/'.$_SESSION["user_id"]."/".$update_image;

if(!empty($update_image)){
    if($update_image_size > 1000000){
        $error[] = "File is too large!";
    } else {
        // Create the user directory if it doesn't exist
        $user_directory = 'upload-img/'.$_SESSION["user_id"];
        if (!is_dir($user_directory)) {
            mkdir($user_directory, 0777, true); // 0777 provides full permissions, you might want to adjust this
        }

        // Execute the query
        $image_update_query = mysqli_query($con, "UPDATE `user_register` SET image = '$update_image' WHERE id = '$user_id'") or die('Query failed!');

        // Check if the query was successful
        if ($image_update_query) {
            // Move the uploaded file
            if (move_uploaded_file($update_image_tmp_name, $update_image_folder)) {
                $error[] = "Image updated!";
            } else {
                $error[] = "Failed to move uploaded file!";
            }
        } else {
            $error[] = "There was an error updating the image!";
        }
    }
}

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/materialize.css">
    <link rel="stylesheet" href="css/materialize.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .circle{
        width: 80px;

        }
    #update_profile{
        position: relative;
        top: -30px;
        left: 15px;
       
    }
    
    </style>
    <title>Update Profile</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col s12 m6 offset-l3">
                <div class="card">
                    <div class="card-content center">
                    <a href="update_user_info.php" class="btn-flat red-text left tooltipped" data-position="bottom" data-tooltip="Back"><i class="material-icons">arrow_back</i></a>
                    <a href="index.php" class="btn-flat blue-text right tooltipped" data-position="bottom" data-tooltip="Close"><i class="material-icons">close</i></a>
                    <br>
                        <h5>My Profile</h5>
                        <?php 
                          $select = "SELECT * FROM `user_register` WHERE id = '$user_id'";

                        $result = mysqli_query($con, $select);
                        if(mysqli_num_rows($result) > 0){
                           $fetch = mysqli_fetch_assoc($result);
                        }
                        ?>
                        <form action="" method="post" enctype="multipart/form-data">
                            <?php
                                if($fetch['image'] == ''){
                                    echo '<i class="material-icons medium">person</i> <br>';
                                }else{
                                    echo '<img src="upload-img/'.$_SESSION['user_id']."/".$fetch['image'].' " class="circle responsive-img">';
                                    
                                }
                            ?>
                    <br>
                       
                    <button type="submit" name="update_profile" id="update_profile" class="btn-flat green-text"><i class="material-icons large">how_to_reg</i></button><br>
                        <input type="file" name="update_image" accept="image/jpg, image/jpeg, image/png">
                       
                                <?php
                                if(isset($error)){
                                    foreach($error as $errors){
                                        echo '<div class=" col s12 red white-text" id="err" style="padding:4px;">'.$errors.'</div>';
                                    }
                                }
                                    
                                ?>


                       
                
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    // Function to hide the greeting after 1-2 minutes
    function hideErr() {
        var greetingDiv = document.getElementById('err');
        greetingDiv.style.display = 'none';
    }

    // Set the timeout to hide the greeting after 1-2 minutes (60000 milliseconds = 1 minute)
    setTimeout(hideErr, 3000); // Hide after 2 minutes
</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="js/materialize.js"></script>
<script src="js/materialize.min.js"></script>
<script src="js/index.js"></script>
</body>
</html>