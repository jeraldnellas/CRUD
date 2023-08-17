<?php 
include_once "db/db_con.php";
session_start();
$id =   $_SESSION['user_id'];
// $user_type = $_SESSION['Access'];

if(!isset($id)){
    header('location: login.php');
}

$search = $_GET['search'];
$select = "SELECT * FROM `data entry` WHERE name LIKE '%$search%' || email LIKE '%$search%' || id LIKE '%$search%'";
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
    <title>Search</title>
</head>
<body>
<?php include_once "include/nav.php"; ?>


    <!-- data entry -->


 
    <div class="col s12 M12">
        <div class="card">
            <div class="card-content">
            <a href="add.php" class="btn-flat green-text tooltipped" data-position="bottom" data-tooltip="Add Entry"><i class="material-icons">person_add</i></a>
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
              <th>ID</th>
              <th>Name</th>
              <th>Email Address</th>
              <th>Mobile Nos.</th>
              <th>Gender</th>
              <th>Edit</th>
              <?php if($_SESSION['Access'] == "admin"){?>
              <th>Delete</th>
              <?php }?>
          </tr>
        </thead>

        <tbody>
    
       <?php
        $select = "SELECT * FROM `data entry`";
        $result = mysqli_query($con, $select);
        while ($row = mysqli_fetch_assoc($result)) {
    ?>
    <tr>
     
        <td><?php echo $row['id']; ?></td>
       
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['email']; ?></td>
        <td><?php echo $row['mobile_nos']; ?></td>
        <td><?php echo $row['gender']; ?></td>
        <td><a href="update_data_entry.php?id=<?php echo $row['id']; ?>" class="btn-flat blue-text tooltipped" data-position="bottom" data-tooltip="Edit"><i class="material-icons">edit</i></a></td>
        <form action="delete.php" method="post">
            
            <td>
            <?php if($_SESSION['Access'] == "admin") {?>
                <button type="submit" class="btn-flat red-text tooltipped" data-position="bottom" data-tooltip="Delete" name="delete"><i class="material-icons">delete</i></button>
                <?php }?>
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            </td>
          
       
          
        </form>
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
<?php include_once "include/footer.php";?>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="js/materialize.min.js"></script>

<script src="js/index.js"></script>
</body>
</html>