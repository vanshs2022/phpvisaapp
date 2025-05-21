<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "visa_application";

$con = new mysqli($server, $username, $password, $database);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$sql = "SELECT * FROM contact;";
$result = $con->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Messages</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f9f9f9] min-h-screen flex items-center justify-center p-4" style="background-color: rgb(222, 177, 46);">
  <div class="w-full max-w-3xl">
    <h2 class="text-3xl font-bold text-center text-[#092635] mb-6">Contact Messages</h2>
    <?php if ($result->num_rows > 0): ?>
      <div class="space-y-4">
        <?php while ($row = $result->fetch_assoc()): ?>
          <div class="bg-white p-4 rounded-lg shadow-md border-l-4 border-[#092635]">
            <p><span class="font-semibold">Name:</span> <?= htmlspecialchars($row['name']) ?></p>
            <p><span class="font-semibold">Email:</span> <?= htmlspecialchars($row['email']) ?></p>
            <p><span class="font-semibold">Message:</span> <?= nl2br(htmlspecialchars($row['message'])) ?></p>
          </div>
        <?php endwhile; ?>
      </div>
    <?php else: ?>
      <p class="text-center text-gray-600">No messages found.</p>
    <?php endif; ?>
  </div>
</body>
</html>
<?php $con->close(); ?>
