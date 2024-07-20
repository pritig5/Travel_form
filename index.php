<?php
$insert = false;
if(isset($_POST["name"])){
    $server = "localhost";
    $username = "root";
    $password = "";
    $dbname = "db_1";

    $con = new mysqli($server, $username, $password, $dbname);
    
    if($con->connect_error){
        die("Connection to this database failed due to ". $con->connect_error);
    }

    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $desc = $_POST['desc'];

    $sql = $con->prepare("INSERT INTO trip (name, age, gender, email, phone, other, dt) VALUES (?, ?, ?, ?, ?, ?, current_timestamp())");
    $sql->bind_param("sissss", $name, $age, $gender, $email, $phone, $desc);

    if($sql->execute()){
        $insert = true;
    } else {
        echo "ERROR: $sql <br> $con->error";
    }
    $con->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Travel Form</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Sriracha&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <img class="bg" src="bg.jpg" alt="VIT">
    <div class="container">
        <h1>Welcome to VIT Pune Trip Form</h1>
        <p>Enter your details and submit this form to confirm your participation in the trip</p>
        <?php
        if($insert == true){
            echo "<p class='submitmsg'>Thanks for submitting your form.</p>";
        }
        ?>
        <form action="index.php" method="post">
            <input type="text" name="name" id="name" placeholder="Enter your Name" required>
            <input type="text" name="age" id="age" placeholder="Enter your Age" required>
            <input type="text" name="gender" id="gender" placeholder="Enter your Gender" required>
            <input type="email" name="email" id="email" placeholder="Enter your Email" required>
            <input type="tel" name="phone" id="phone" placeholder="Enter your Phone" required>
            <textarea name="desc" id="desc" cols="30" rows="10" placeholder="Enter any other information here"></textarea>
            <button class="btn">Submit</button>
        </form>
    </div>
    <script src="index.js"></script>
</body>
</html>
