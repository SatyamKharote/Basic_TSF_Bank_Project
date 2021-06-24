<?php

    // Including config.php file 
    include 'config.php';
    
    $empty_error = "";

    // Following operation is for trasfering the amount from sender to receiver
 
        if(isset($_POST['transfer-btn'])){
            $sender = (int)$_POST['sender_field'];
            $receiver = (int)$_POST["receiver_field"];
            $amount = (int)$_POST["amount-field"];


            // this query for get sender current accont balance
            $sender_curr_amnt_sql = "select * from customer where No=".$sender."";
    
            // and this query for get receiver current acconutn balance
            $receiver_curr_amnt_sql= "select * from customer where No=".$receiver."";
        
            // followinng line execute sender amount query
            $sender_curr_amnt = mysqli_fetch_assoc(mysqli_query($link,$sender_curr_amnt_sql));

            // followinng line execute receiverder amount quer
            $receiver_curr_amnt = mysqli_fetch_assoc(mysqli_query($link,$receiver_curr_amnt_sql));

            // following line will update sender account balance
            $sender_query = "update customer SET Credit=".(int)($sender_curr_amnt["Credit"]-$amount)." where No =".$sender."";
            mysqli_query($link,$sender_query);
        
            // following line will update receiverg account balance
            $receiver_query = "update customer SET Credit=".(int)($receiver_curr_amnt["Credit"]+$amount)." where No =".$receiver."";
            mysqli_query($link,$receiver_query);

            // following line will insert record into transaction table
            $send_amt = "insert into transaction (sender,receiver,amount) values ('".$sender_curr_amnt['Name']."','".$receiver_curr_amnt['Name']."','".$amount."')";
            mysqli_query($link,$send_amt);

            //following line is an alert box
            echo '<script type="text/javascript">';
            echo ' alert("Money Sent Successfully")';  //not showing an alert box.
            echo '</script>';
        }
 
  
?>
  <!--  Bootstrap Link -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

  <!-- End Bootstrap Link -->

<head>
  <!--  Adding style.css Link -->

    <link rel="stylesheet" href="style.css">

  <!-- End -->
</head>

<body style="background-image: url('money.jpg');">

    <!-- Navbar  -->

        <?php include 'navbar.php'; ?>

    <!-- End Navbar -->
    
<div class="card text-white bg-dark mb-3" style="max-width: 30rem;">
    <div class="card-header">Transfer Money</div>
        <div class="card-body">
            <form method='post' action='transfer.php'>
                <label for="inputState">Sender Name:</label>
                <select id="inputState" class="form-control" name="sender_field" required>
                    <option value="" selected>Choose...</option>
                        <?php
                            $sql = 'select * from customer';
                            $result = mysqli_query($link,$sql);
                            if(mysqli_num_rows($result)>0)
                            {
                                while($row = mysqli_fetch_assoc($result)){
                        ?>
                    <option value='<?php echo $row["No"]; ?>'><?php echo $row["Name"]; ?></option>
                        <?php
                                }
                            }
                        ?>
                </select>
                <label for="inputState">Receiver Name:</label>
                <select id="inputState" class="form-control" name= "receiver_field" required>
                    <option value="" selected>Choose...</option>
                        <?php
                            $sql1 = 'select * from customer';
                            $result1 = mysqli_query($link,$sql);
                            if(mysqli_num_rows($result1)>0)
                            {
                                while($row = mysqli_fetch_assoc($result1)){
                        ?>
                    <option value='<?php echo $row['No']; ?>'><?php echo $row["Name"]; ?></option>
                        <?php
                                }
                            }
                        ?>
                </select>
        <div class="receiver-err"></div></br>
        <label for="inputamount">Amount:</label>
        <input type="number" class="form-control" id="inputamount" placeholder="Enter Amount" name="amount-field" required></br>
        <input type="submit" id="transfer" class="btn btn-info" name="transfer-btn" value="Transfer">
            </form>
        </div>
    </div>
</div>

</body>