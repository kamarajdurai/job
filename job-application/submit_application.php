<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "job_portal";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Upload resume
$resumePath = "";
if (isset($_FILES['resume']) && $_FILES['resume']['error'] == 0) {
  $uploadDir = "uploads/";
  if (!is_dir($uploadDir)) mkdir($uploadDir);
  $resumePath = $uploadDir . basename($_FILES["resume"]["name"]);
  move_uploaded_file($_FILES["resume"]["tmp_name"], $resumePath);
}

// Collect form data
$fullname = $conn->real_escape_string($_POST['fullname']);
$email = $conn->real_escape_string($_POST['email']);
$phone = $conn->real_escape_string($_POST['phone']);
$linkedin = $conn->real_escape_string($_POST['linkedin']);
$website = $conn->real_escape_string($_POST['website']);
$position = $conn->real_escape_string($_POST['position']);
$message = $conn->real_escape_string($_POST['message']);

// Insert into DB
$sql = "INSERT INTO applications (fullname, email, phone, linkedin, website, position, message, resume)
        VALUES ('$fullname', '$email', '$phone', '$linkedin', '$website', '$position', '$message', '$resumePath')";

if ($conn->query($sql) === TRUE) {
  echo "<h2>✅ Application submitted successfully!</h2>";
  echo "<p><a href='apply.html'>Go back to form</a></p>";
} else {
  echo "❌ Error: " . $conn->error;
}

$conn->close();
?>
