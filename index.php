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

        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $countryto = $_POST['countryto'];
        $countryfrom = $_POST['countryfrom'];
        $terms = $_POST['terms'];
        
        if($terms==true){
            $sql = "INSERT INTO applications (firstname, lastname, email, countryto, countryfrom) VALUES ('$firstname', '$lastname', '$email', '$countryto', '$countryfrom');";
            $con->query($sql);
            echo "<script type='text/javascript'>alert('Data Inserted successfully!');</script>";
        }
        else{
            echo "<script type='text/javascript'>alert('Error in inserting data');</script>";
        }
        $con->close();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BLS Visa Application form</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <nav>
        <div class="logo">
            <img src="blslogo.png" alt="bls international">
        </div>
        <div id="navbar">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.html" target="_blank">About</a></li>
                <li><a href="contact.php" target="_blank">Contact</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h2 class="title">BLS Visa Application Form</h2>
        <form action="index.php" method="POST" id="appcreate" onsubmit="return validateCountries()">
            <input type="text" placeholder="First Name" name="firstname" id="firstname" pattern="[A-Za-z]{1,30}" maxlength=30 required>
            <input type="text" placeholder="Last Name" name="lastname" id="lastname" pattern="[A-Za-z]{1,30}" maxlength=30 required>
            <input type="email" placeholder="Email id" name="email" id="email" required>
            <select name="countryto" id="countryto" required>
                <option value="">Select a country to</option>
                <option value="Slovakia">Slovakia</option>
                <option value="Spain">Spain</option>
                <option value="Japan">Japan</option>
                <option value="Germany">Germany</option>
                <option value="Canada">Canada</option>
                <option value="India">India</option>
            </select>
            <select name="countryfrom" id="countryfrom" required>
                <option value="">Select a country from</option>
                <option value="Slovakia">Slovakia</option>
                <option value="Spain">Spain</option>
                <option value="Japan">Japan</option>
                <option value="Germany">Germany</option>
                <option value="Canada">Canada</option>
                <option value="India">India</option>
            </select>
            <div id="flex-normal">
                <input type="checkbox" name="terms" id="terms" required> <a href="terms.html" target="_blank">Terms and Conditions</a>
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>

    <footer>
        Copyright@2025 . BLS International
    </footer>
</body>
<script>
    function validateCountries(){
        let countryto = document.getElementById('countryto').value;
        let countryfrom = document.getElementById('countryfrom').value;

        if(countryto===countryfrom){
            alert("Both counrties can't be same");
            return false;
        }
        return true;
    }
</script>
</html>