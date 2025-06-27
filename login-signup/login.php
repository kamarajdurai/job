<?php
$conn = new mysqli("localhost", "root", "", "login_system");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();

$result = $stmt->get_result();
if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        echo "<script>alert('Login successful'); window.location.href='../index.html';</script>";
    } else {
        echo "<script>alert('Incorrect password!'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('User not found!'); window.history.back();</script>";
}
$conn->close();
?>
