<?php
$insert=false;
if(isset($_POST['name'])){

    //Set connection variables
    $server="localhost";
    $username="root";
    $password="";
    $database="camp_registration";

    //Creating a databse connection
    $con = mysqli_connect($server, $username, $password);

    //Checking for successful connection
    if(!$con){
        die("Connection to this database failed due to".mysqli_connect_error());
    }
    //echo "Success connecting to the db"

    //Checking if database can be selected
    if(!mysqli_select_db($con, $database)){
        die("Could not select the database");
    }

    //Collect post variables
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $desc = $_POST['desc'];

    $sql = "INSERT INTO `camp` (`Name`, `Age`, `Gender`, `Email`, `Phone`, `Other`, `date`) VALUES ('$name', '$age', '$gender', '$email', '$phone', '$desc', current_timestamp());";

   // echo $sql;

   //Execute the query
    if(mysqli_query($con, $sql)){
        //$last_insert_id = mysqli_insert_id($con);

        //Flag for successful insertion
        $insert=true;
        //echo "Successfully inserted";
    }
    else{
        echo "ERROR: $sql <br>" . mysqli_error($con);
    }

    //Close teh database connection
    mysqli_close($con);
    //INSERT INTO `camp` (`S no.`, `Name`, `Age`, `Gender`, `Email`, `Phone`, `Other`, `date`) VALUES ('1', 'testname', '23', 'female', 'this@this.com', '8888888888', 'good', current_timestamp());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Summer Camp</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nanum+Pen+Script&family=Shadows+Into+Light&display=swap" rel="stylesheet">
</head>
<body>
    <img class="bg" src="bg1.jpg" alt="img">
    <div class="container">
        <h1>Summer Camp</h1>
        <p>Enter your details to confirm your participation for the camp</p>
        <?php
            if($insert==true){
                echo "<p class='submitMsg'>Get ready for the best summer ever - see you at the camp!</p>";
            }
        ?>
        <form action="index.php" method="post">
            <input type="text" name="name" id="name" placeholder="Enter your name">
            <input type="text" name="age" id="age" placeholder="Enter your age">
            <input type="text" name="gender" id="gender" placeholder="Enter your gender">
            <input type="email" name="email" id="email" placeholder="Enter your email">
            <input type="phone" name="phone" id="phone" placeholder="Enter your phone number">
            <textarea name="desc" id="desc" cols="30" rows="10" placeholder="Enter any other information"></textarea>
            <button class="btn">Submit</button>
        </form>
    </div>
    <script src="script.js"></script>
</body>
</html>