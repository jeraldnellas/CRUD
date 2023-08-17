<?php
include_once "db/db_con.php";
session_start();
$id =   $_SESSION['user_id'];
if(!isset($id)){
    header('location: login.php');
}
$id_entry = $_GET['id'];
$select = "SELECT * FROM `data entry` WHERE id = '$id_entry'";
$result = mysqli_query($con, $select);
$row = mysqli_fetch_assoc($result);

if(isset($_POST['submit'])){
    $name = ucwords(mysqli_real_escape_string ($con, $_POST['name']));
    $email = $_POST['email'];
    $position = $_POST['position'];
    $remarks = $_POST['remarks'];
    $mobile_nos = $_POST['mobile_nos'];
    $gender = $_POST['gender'];

    $update = "UPDATE `data entry` SET `name`='$name',`email`='$email', `position`= '$position', `remarks`='$remarks',`mobile_nos`='$mobile_nos',`gender`='$gender' WHERE id ='$id_entry'";
    mysqli_query($con, $update);
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
    #update_data_edit input{
        /* text-transform: capitalize; */
    }
</style>
    <title>Update Entry</title>
</head>
<body>
   <?php include_once "include/nav.php";?>
    <div class="container">
        <div class="row">
            <div class="col s12 m6 offset-l3">
                <div class="card">
                    <div class="card-content center">
                    <a href="index.php" class="btn-flat red-text left tooltipped" data-position="bottom" data-tooltip="Back"><i class="material-icons">arrow_back</i></a><br>
                        <form action="" method="post" id="update_data_edit">
                            <h5>Edit Information</h5>
                            <?php if(isset($error)){
                                foreach($error as $errors){
                                    echo '<div class="red-text">'.$errors.'</div>';
                                }
                                }?>
                            <div class="input-field">
                                <input type="text" name="name" placeholder="Type name" required value="<?php echo $row['name'] ?>">
                            </div>
                                
                            <div class="input-field">
                                <select name="position" id="">
                                    <option value=""></option>
                                    <option value="Grader Optr" <?php echo ($row['position'] == "Grader Optr")? 'selected' : ''; ?>>Grader Optr</option>
                                    <option value="Welder" <?php echo ($row['position'] == "Welder")? 'selected' : ''; ?>>Welder</option>
                                    <option value="Electrician" <?php echo ($row['position'] == "Electrician")? 'selected' : ''; ?>>Electrician</option>
                                    <option value="Civil Engr" <?php echo ($row['position'] == "Civil Engr")? 'selected' : ''; ?>>Civil Engr</option>
                                    <option value="AutoCADD" <?php echo ($row['position'] == "AutoCADD")? 'selected' : ''; ?>>AutoCADD</option>
                                </select>
                                <label for="">Position Applied</label>
                            </div>
                            <div class="input-field">
                                <input type="email" name="email" placeholder="Enter email" required value="<?php echo $row['email'] ?>">
                            </div>

                            <div class="input-field">
                                <input type="number" name="mobile_nos" placeholder="Enter mobile number" required value="<?php echo $row['mobile_nos'] ?>">
                            </div>
                            

                            <div class="input-field" required>
                            <select name="gender" id="">
                                <option value=""></option>
                                <option value="Male" <?php echo ($row['gender'] == "Male")? 'selected' : ''; ?>>Male</option>
                                <option value="Female" <?php echo ($row['gender'] == "Female")? 'selected' : ''; ?>>Female</option>
                            </select>
                            <label for="gender">Choose Gender</label>
                            </div>
                            <div class="input-field">
                                <input type="text" name="remarks" placeholder="Remarks" value="<?php echo $row['remarks']?>">
                            </div>
 
                           <button type="submit" name="submit" class="btn blue white-text tooltipped" data-position="bottom" data-tooltip="Save Edit" style="width: 100%"><i class="material-icons">person_add</i></button>
                          
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