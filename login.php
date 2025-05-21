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
        
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $sql = "select password from users where username='$username'";
        $result = $con->query($sql);

        if($result->num_rows==1){
            $row = $result->fetch_assoc();
            if($row['password']==$password){
                echo "<script type='text/javascript'>alert('User logged in Successfully!');</script>";
            }
            else{
                echo "<script type='text/javascript'>alert('incorrect username or password1');</script>";
            }
        }
        else{
            echo "<script type='text/javascript'>alert('incorrect username or password2');</script>";
        } 

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center h-screen">
    <div class="flex flex-col items-center p-6 w-80 border rounded-lg shadow-md" style="background-color: rgb(222, 177, 46);">
        <h2 class="text-2xl font-semibold mb-4 text-[#092635]">Login Form</h2>
        <form action="login.php" method="post" class="flex flex-col w-full">
            <input type="email" name="username" id="username" placeholder="Email" class="w-full border px-3 py-2 rounded mb-3 focus:outline-none focus:ring-2 focus:ring-white" required>
            <input type="password" name="password" id="password" placeholder="Password" class="w-full border px-3 py-2 rounded mb-3 focus:outline-none focus:ring-2 focus:ring-white" required>
            <button type="submit" class="w-full py-2 bg-white text-[#092635] font-semibold rounded transition hover:bg-[#092635] hover:text-white">Submit</button>
        </form>
    </div>
</body>
</html>