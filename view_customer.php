<!--  Bootstrap Link -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    
<!-- End Bootstrap Link -->

<!--  Including config.php file -->

<?php
    include 'config.php';
?>

<!-- End Include File -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Customer</title>

    <!--  Adding style1.css Link -->

        <link rel="stylesheet" href="style1.css">

    <!-- End -->
   
</head>

<body style="background-image: url('back.jpg');">

<!-- Navbar  -->

    <?php include 'navbar.php'; ?>

<!-- End Navbar -->

<!-- Main Body  -->

    <?php
        if(isset($_GET["no"])){
            $no = $_GET["no"];
            $sql = "select * from customer where No='$no'";
            $result = mysqli_query($link,$sql);
            $row = mysqli_fetch_assoc($result);
    ?>
    <div class="alert alert-primary" role="alert" style="width:40%;margin-left: 550px;margin-top:120px;font-weight:100;text-align:center;font-size: 20px;"><h3 style="color:Black;"><?php echo "NAME : ".$row["Name"];?></h3></div>
    <div class="alert alert-warning" role="alert" style="width:40%;margin-left: 550px;margin-top:20px;font-weight:800;text-align:center;font-size: 20px;"><h3 style="color:Black;"> <?php echo "EMAIL : ".$row["Email"];?> </h3></div>
    <div class="alert alert-success" role="alert" style="width:40%;margin-left: 550px;margin-top:20px;font-weight:800;text-align:center;font-size: 20px;"><h3 style="color:Black;"> <?php echo "CURRENT BALANCE : ".$row["Credit"];?> </h3></div>
    <div class="buttons">
        <div class="container">
            <a href="transfer_to_user.php?no=<?php echo $no;?>" class="btn effect01"><span>Transfer Money</span></a>
        </div>
    </div>

    <?php
        }
    ?>
</body>
</html> 