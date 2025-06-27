<?php
$conn = new mysqli("localhost", "root", "", "job_portal");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM applications ORDER BY applied_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard - Job Applications</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f4f4;
      padding: 40px;
    }

    h2 {
      text-align: center;
      margin-bottom: 30px;
    }

    table {
      width: 100%;
      background: white;
      border-collapse: collapse;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    th, td {
      padding: 12px;
      border: 1px solid #ddd;
      text-align: left;
    }

    th {
      background: #007acc;
      color: white;
    }

    tr:nth-child(even) {
      background: #f9f9f9;
    }

    a.download-link {
      color: #007acc;
      text-decoration: none;
      font-weight: bold;
    }

    a.download-link:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

<h2>📋 Admin Dashboard - Applications</h2>

<table>
  <thead>
    <tr>
      <th>ID</th>
      <th>Full Name</th>
      <th>Email</th>
      <th>Phone</th>
      <th>Position</th>
      <th>Resume</th>
      <th>Applied At</th>
    </tr>
  </thead>
  <tbody>
    <?php if ($result->num_rows > 0): ?>
      <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?= $row['id'] ?></td>
          <td><?= htmlspecialchars($row['fullname']) ?></td>
          <td><?= htmlspecialchars($row['email']) ?></td>
          <td><?= htmlspecialchars($row['phone']) ?></td>
          <td><?= htmlspecialchars($row['position']) ?></td>
          <td>
            <?php if (!empty($row['resume'])): ?>
              <a class="download-link" href="<?= $row['resume'] ?>" target="_blank">Download</a>
            <?php else: ?>
              N/A
            <?php endif; ?>
          </td>
          <td><?= $row['applied_at'] ?></td>
        </tr>
      <?php endwhile; ?>
    <?php else: ?>
      <tr><td colspan="7">No applications found.</td></tr>
    <?php endif; ?>
  </tbody>
</table>

</body>
</html>
