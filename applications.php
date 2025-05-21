<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "visa_application";

$con = new mysqli($server, $username, $password, $database);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['remove'])) {
        $delete_id = intval($_POST['remove']);
        $con->query("UPDATE applications SET flag=0 WHERE id = $delete_id");
    }

    if (isset($_POST['update'])) {
        $update_id = intval($_POST['update']);
        header("Location: updateApplications.php?id=" . $update_id);
        exit;
    }
}


$sql = "SELECT * FROM applications;";
$result = $con->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>User Applications</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f4f4f9] flex items-center justify-center min-h-screen p-4" style="background-color: rgb(222, 177, 46);">
  <div class="w-full max-w-4xl">
    <h2 class="text-3xl font-bold text-center text-[#092635] mb-6">Visa Applications</h2>
    <?php $count=0; if ($result->num_rows > 0): ?>
      <div class="grid gap-4">
        <?php while ($row = $result->fetch_assoc()): ?>
          <?php if ($row['flag']): $count++; ?>
          <div class="bg-white rounded-lg shadow-md p-4 border-l-4 border-[#092635] relative">
            <p><span class="font-semibold">First Name:</span> <?= htmlspecialchars($row['firstname']) ?></p>
            <p><span class="font-semibold">Last Name:</span> <?= htmlspecialchars($row['lastname']) ?></p>
            <p><span class="font-semibold">Email:</span> <?= htmlspecialchars($row['email']) ?></p>
            <p><span class="font-semibold">Country To:</span> <?= htmlspecialchars($row['countryto']) ?></p>
            <p><span class="font-semibold">Country From:</span> <?= htmlspecialchars($row['countryfrom']) ?></p>
            
            <form method="POST" class="mt-4">
              <input type="hidden" name="remove" value="<?= $row['id'] ?>">
              <button type="submit" class="bg-[#092635] text-white px-4 py-2 rounded hover:bg-[#DEB12E] transition">
                Remove
              </button>
            </form>
            <form action="applications.php" method="post" class="mt-4">
              <input type="hidden" name="update" value="<?= $row['id'] ?>">
              <button type="submit" class="bg-[#092635] text-white px-4 py-2 rounded hover:bg-[#DEB12E] transition">
                Update
              </button>
            </form>
          </div>
          <?php endif; ?>
        <?php endwhile; ?>
      </div>
    <?php elseif ($count==0): ?>
      <p class="text-center text-gray-700 font-semibold">No applications found.</p>
    <?php endif; ?>
  </div>
</body>
</html>
<?php $con->close(); ?>