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
    $email = $_POST['email'];
    $message = $_POST['message'];
    
    $sql = "INSERT INTO contact VALUES ('$name', '$email', '$message');";
    $con->query($sql);

    echo "<script type='text/javascript'>alert('Message sent successfully!');</script>";
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center h-screen bg-[#f4f4f9]">
  <div class="flex flex-col items-center p-6 w-80 border rounded-lg shadow-md" style="background-color: rgb(222, 177, 46);">
    <h2 class="text-2xl font-semibold mb-4 text-[#092635]">Contact Us</h2>
    <form action="contact.php" method="POST" class="flex flex-col w-full">
      <input type="text" placeholder="Name" name="name" id="name" required
             class="w-full border px-3 py-2 rounded mb-3 focus:outline-none focus:ring-2 focus:ring-white" />
      
      <input type="email" placeholder="Email id" name="email" id="email" required
             class="w-full border px-3 py-2 rounded mb-3 focus:outline-none focus:ring-2 focus:ring-white" />
      
      <textarea placeholder="Message" name="message" id="message" rows="4" required
                class="w-full border px-3 py-2 rounded mb-4 focus:outline-none focus:ring-2 focus:ring-white"></textarea>
      
      <button type="submit"
              class="w-full py-2 bg-white text-[#092635] font-semibold rounded transition hover:bg-[#092635] hover:text-white">
        Submit
      </button>
    </form>
  </div>
</body>
</html>
