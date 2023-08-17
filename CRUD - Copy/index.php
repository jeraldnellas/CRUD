<?php 
include_once "db/db_con.php";
session_start();
$id =   $_SESSION['user_id'];
// $user_type = $_SESSION['Access'];

if(!isset($id)){
    header('location: login.php');
}




// fetching
$select = "SELECT * FROM `user_register` WHERE id = '$id'";
$result = mysqli_query($con, $select);
$row = mysqli_fetch_assoc($result);


// time greeting
date_default_timezone_set('Asia/Manila');
$current_time = new DateTime('now');
$current_time_24hour = $current_time->format('H:i');

if($current_time_24hour >= '05:00' && $current_time_24hour < '12:00'){
    $greetings = 'Hi Good Morning!';
}elseif($current_time_24hour == '12:00'){
    $greetings = 'Hi Good Noon!';
}elseif($current_time_24hour >= '12:00' && $current_time_24hour < '17:30' ){
    $greetings = 'Hi Good Afternoon';
}else{
    $greetings = 'Good Evening!';
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
        #search-bar{
            position: relative;
            margin-bottom: -60px;
            top: -30px;
            /* background: #f3f9ff; */
        }
        #search-btn{
            position: relative;
            left:280px;
        }
    </style>
    <title>Home Page</title>
</head>
<body>
<?php include_once "include/nav.php"; ?>
<div class="">
    <div class="row">
        <div class="col s12 m3">
           <div class="card">
             <div class="card-content center ">
             <a href="update_user_info.php?id=<?php echo $row['id']?>" class="btn-flat blue-text right tooltipped" data-position="bottom" data-tooltip="Edit"><i class="material-icons">edit</i></a><br>
                <h5 class="blue-text" style="font-style: italic;"> <?php echo "$greetings"; ?></h5>
                <!-- <?php 
                          $select = "SELECT * FROM `user_register` WHERE id = '$id'";

                        $result = mysqli_query($con, $select);
                        if(mysqli_num_rows($result) > 0){
                           $fetch = mysqli_fetch_assoc($result);
                        }if($fetch['image'] == ''){
                            echo '<i class="material-icons medium">person</i> <br>';
                        }else{
                            echo '<img src="upload-img/'.$_SESSION['user_id']."/".$fetch['image'].'" class="circle responsive-img" width="80"> <br>';
                        }
                        ?> -->
                        <?php echo '<img src="upload-img/'.$row['id']."/".$fetch['image'].'" class="circle responsive-img" width="80"> <br>';
                        ?>
                <p class="flow-text"><?php echo $row['name'] ?></p>
                    <a href="mailto:<?php echo $row['email']?>"><?php echo $row['email']?></a>
                <li class="divider"></li><br>
                <table class="highlight row">
                    <thead class="col s4">
                        <tr>
                            <th>Mobile:</th>
                        </tr>
                        <tr>
                            <th>Gender:</th>
                        </tr>
                        <tr>
                            <th>B-date:</th>
                        </tr>
                        <tr>
                            <th>Height:</th>
                        </tr>
                        <tr>
                            <th>Weight:</th>
                        </tr>
                        <?php if($_SESSION['Access']=="admin"){?>
                        <tr>
                            <th>Users:</th>
                        </tr>
                        <?php }?>
                        
                        
                    </thead>
                    <tbody class="col ">
                            <tr>
                                <td><?php echo $row['mobile_nos'] ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $row['gender'] ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $row['bdate'] ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $row['height'].'cm' ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $row['weight'].'kg' ?></td>
                            </tr>
                            <?php if($_SESSION['Access']== "admin") {?>
                            <tr>
                                <td><a href="users_info.php?id=<?php echo $row['id']?>">User Info</a></td>
                            </tr>
                            <?php }?>
                        </tbody>
                </table>
                <a href="logout.php" class="btn red tooltipped" data-position="bottom" data-tooltip="Logout" style="width: 100%;"><i class="material-icons">logout</i></a>

            </div>
        </div>
    </div>

    <!-- data entry -->
    <div class="col s12 m9 right">
        <div class="card">
            <div class="card-content">
                <!-- <form action="report_pdf.php" class="right" method="post">
                    <button type="submit" class="btn-flat"><i class="material-icons">print</i></button>
                </form> -->
            <a href="add.php" class="btn-flat green-text tooltipped" data-position="bottom" data-tooltip="Add Entry"><i class="material-icons">person_add</i></a>
            <a href="report_pdf.php" class="btn-flat tooltipped" data-tooltip="Print" data-position="bottot"><i class="material-icons">print</i></a>
            <!-- search bar -->
            <div class="row">
                    <div class="input-field col m4 right">
                     <form action="result.php" method="get">
                    <input type="search" id="search-bar" name="search" placeholder="Search">
                    <button class="btn-flat" id="search-btn" type="submit"><i class="material-icons">search</i></button>
                 </form>
               </div>
                </div>

            <table class="responsive-table">
            <h5 class="center">Data Entry</h5>
        <thead>
          <tr>
            <th>SN</th>
              <!-- <th>ID</th> -->
              <th>Name</th>
              <th>Position</th>
              <th>Email Address</th>
              <th>Mobile Nos.</th>
              <th>Gender</th>
              <th>Remarks</th>
              <th>Edit</th>
              <?php if($_SESSION['Access'] == "admin"){?>
              <th>Delete</th>
              <?php }?>
          </tr>
        </thead>

        <tbody>
    
       <?php
        $count = 1;
      
        $select = "SELECT * FROM `data entry` ";
        $result = mysqli_query($con, $select);
        while ($row = mysqli_fetch_assoc($result)) {
    ?>
    <tr>
         <td><?php echo $count?></td>
          <?php $count++;?>
        <!-- <td><?php echo $row['id']; ?></td> -->
       
        <td><?php echo ucwords($row['name']); ?></td>
        <td><?php echo $row['position']?></td>
        <td><?php echo $row['email']; ?></td>
        <td><?php echo $row['mobile_nos']; ?></td>
        <td><?php echo $row['gender']; ?></td>
        <td><?php echo $row['remarks']; ?></td>
        <td><a href="update_data_entry.php?id=<?php echo $row['id']; ?>" class="btn-flat blue-text tooltipped" data-position="bottom" data-tooltip="Edit"><i class="material-icons">edit</i></a></td>

            <td>
                    <form action="delete.php" method="post">
                    <button type="submit" name="delete" onclick="return confirm('Are you sure! want to delete <?php echo $row['name']?>?')" class="btn-flat delete tooltipped" data-position="bottom" data-tooltip="Delete"><i class="material-icons red-text">delete</i></button>
                    <input type="hidden" name="id" value="<?php echo $row['id']?>">
                        </form>
                  
             </td>
             <!-- <td><a href="" class="btn-flat delete">delete</a></td> -->

        </tr>

        
                <?php
              }
            ?>
                </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<!-- modal delete -->

<?php include_once "include/footer.php";?>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="js/materialize.min.js"></script>

<script src="js/index.js"></script>
</body>
</html>