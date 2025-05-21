<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "visa_application";
$con = new mysqli($server, $username, $password, $database);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_update'])) {
    $id = $_POST['id']; 
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $countryto = $_POST['countryto'];
    $countryfrom = $_POST['countryfrom'];

    $sql = "UPDATE applications SET firstname='$firstname', lastname='$lastname', email='$email', countryto='$countryto', countryfrom='$countryfrom' WHERE id=$id";
    if ($con->query($sql)) {
        echo "<script>alert('Application updated successfully!'); window.location.href='applications.php';</script>";
        exit;
    } else {
        echo "Error updating record: " . $con->error;
    }
} else {
    $id = $_GET['id'];
    $sql = "SELECT * FROM applications WHERE id = $id";
    $result = $con->query($sql);

    if ($result->num_rows == 0) {
        die("Invalid application ID.");
    }

    $row = $result->fetch_assoc();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Update Visa Application</title>
  <link rel="stylesheet" href="index.css">
</head>
<body>
  <div class="container">
    <h2 class="title">Update Visa Application</h2>
    <form action="updateApplications.php" method="POST" onsubmit="return validateCountries()">
      <input type="hidden" name="id" value="<?= $row['id'] ?>">
      <input type="text" name="firstname" placeholder="First Name" value="<?= htmlspecialchars($row['firstname']) ?>" pattern="[A-Za-z+]" required>
      <input type="text" name="lastname" placeholder="Last Name" value="<?= htmlspecialchars($row['lastname']) ?>" pattern="[A-Za-z+]" required>
      <input type="email" name="email" placeholder="Email" value="<?= htmlspecialchars($row['email']) ?>" required>

      <select name="countryto" required>
        <option value="">Select a country to</option>
        <?php
        $countries = ["Slovakia", "Spain", "Japan", "Germany", "Canada", "India"];
        foreach ($countries as $c) {
            echo "<option value=\"$c\" " . ($row['countryto'] == $c ? "selected" : "") . ">$c</option>";
        }
        ?>
      </select>

      <select name="countryfrom" required>
        <option value="">Select a country from</option>
        <?php
        foreach ($countries as $c) {
            echo "<option value=\"$c\" " . ($row['countryfrom'] == $c ? "selected" : "") . ">$c</option>";
        }
        ?>
      </select>

      <button type="submit" name="submit_update">Update Application</button>
    </form>
  </div>
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

<?php $con->close(); ?>
