<?php
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $server = "localhost";
        $username = "root";
        $password = "";
        $database = "visa_application";

        $con = new mysqli($server, $username, $password, $database);

        if($con->connect_error){
            die("connection failed".$con->connect_error);
        }
        
        $name = $_POST['name'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $currpassword = $_POST['currpassword'];
        
        if($password==$currpassword){       
    
            $sql = "INSERT INTO users VALUES ('$name', '$username', '$password');";
            $con->query($sql);
    
            echo "<script type='text/javascript'>alert('User registered Successfully!');</script>";
        }
        else{
            echo "<script type='text/javascript'>alert('passwords dont match');</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Form</title> 
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center h-screen">
    <div class="flex flex-col items-center p-6 w-80 border rounded-lg shadow-md" style="background-color: rgb(222, 177, 46);">
        <h2 class="text-2xl font-semibold mb-4 text-[#092635]">Signup Form</h2>
        <form action="signupForm.php" method="post" class="flex flex-col w-full">
            <input type="text" name="name" id="name" placeholder="Name" class="w-full border px-3 py-2 rounded mb-3 focus:outline-none focus:ring-2 focus:ring-white" required>
            <input type="email" name="username" id="username" placeholder="Email" class="w-full border px-3 py-2 rounded mb-3 focus:outline-none focus:ring-2 focus:ring-white" required>
            <input type="password" name="password" id="password" placeholder="Password" class="w-full border px-3 py-2 rounded mb-3 focus:outline-none focus:ring-2 focus:ring-white" required>
            <input type="password" name="currpassword" id="currpassword" placeholder="Confirm Password" class="w-full border px-3 py-2 rounded mb-4 focus:outline-none focus:ring-2 focus:ring-white" required>
            <button type="submit" class="w-full py-2 bg-white text-[#092635] font-semibold rounded transition hover:bg-[#092635] hover:text-white">Submit</button>
        </form>
    </div>
</body>
</html>