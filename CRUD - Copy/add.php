<?php
include_once "db/db_con.php";
session_start();
$id =   $_SESSION['user_id'];
if(!isset($id)){
    header('location: login.php');
}


if(isset($_POST['submit'])){
    $name = ucwords($_POST['name']);
    $email = $_POST['email'];
    $position = $_POST['position'];
    $mobile_nos = $_POST['mobile_nos'];
    $gender = $_POST['gender'];
    $remarks = $_POST['remarks'];
    $age = $_POST['age'];
    $local = $_POST['local'];
    $abroad = $_POST['abroad'];
    $passport = $_POST['passport'];
    $salary = $_POST['salary'];

    $select = "SELECT * FROM `data entry` WHERE name = '$name' AND email = '$email'";
    $result = mysqli_query($con, $select);
    $row = mysqli_fetch_assoc($result);

    if(mysqli_num_rows($result) > 0){
        $error[] = "Person already exist!";
    }else{
        $insert = "INSERT INTO `data entry`(`name`, `position`, `email`, `mobile_nos`, `gender`, `remarks`, `age`, `local`, `abroad`, `passport`, `salary`) VALUES ('$name','$position', '$email', '$mobile_nos', '$gender', '$remarks', '$age', '$local', '$abroad', '$passport', '$salary')";
        mysqli_query($con, $insert);
        header('location: index.php');
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
<style>
    #data_entry_add input{
    /* text-transform: capitalize; */
}
</style>
    <title>Add Entry</title>
</head>
<body>
   <?php include_once "include/nav.php";?>
    <div class="container">
        <div class="row">
            <div class="col s12 m6 offset-l3">
                <div class="card">
                    <div class="card-content center">
                    <a href="index.php" class="btn-flat red-text left tooltipped" data-position="bottom" data-tooltip="back"><i class="material-icons">arrow_back</i></a><br>
                        <form action="" method="post" id="data_entry_add">
                            <h5>Add Entry</h5>
                            <?php if(isset($error)){
                                foreach($error as $errors){
                                    echo '<div class="red-text">'.$errors.'</div>';
                                }
                                }?>
                            <div class="input-field">
                                <input type="text" name="name" placeholder="Type name" required>
                            </div>

                            <div class="input-field">
                                <select name="position" id="">
                                    <option value=""></option>
                                    <option value="Grader Optr">Grader Optr</option>
                                    <option value="Welder">Welder</option>
                                    <option value="Electrician">Electrician</option>
                                    <option value="Civil Engr">Civil Engr</option>
                                    <option value="AutoCADD">AutoCADD</option>
                                </select>
                                <label for="">Position Applied</label>
                            </div>
                            
                            <div class="input-field">
                                <input type="email" name="email" placeholder="Enter email" required>
                            </div>

                            <div class="input-field">
                                <input type="number" name="mobile_nos" placeholder="Enter mobile number" required>
                            </div>
                            

                            <div class="input-field" required>
                            <select name="gender" id="">
                                <option value=""></option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                            <label for="gender">Choose Gender</label>
                            </div>

                            <div class="input-field">
                                <input type="number" name="age" placeholder="Age">
                            </div>
                            
                            <div class="input-field">
                                <input type="number" name="local" placeholder="Years exp in local">
                            </div>
                            <div class="input-field">
                                <input type="number" name="abroad" placeholder="Years exp in abroad">
                            </div>

                            <div class="input-field">
                               <select name="passport" id="">
                                <option value=""></option>
                                <option value="NO">NO</option>
                                <option value="YES">YES</option>
                               </select>
                               <label for="">Do you have a passport?</label>
                            </div>

                            <div class="input-field">
                               <input type="number" name="salary" id="" placeholder="Asking salary">
                            </div>

                            <div class="input-field">
                                <input type="text" name="remarks" placeholder="Remarks">
                            </div>
                          
                           <button type="submit" name="submit" class="btn blue white-text tooltipped" data-position="bottom" data-tooltip="Add Person" style="width: 100%;"><i class="material-icons">person_add</i></button>
                          
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