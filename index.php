<?php
$conn = new mysqli("localhost", "root", "", "apitsada");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$msg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $class = $_POST['class'];
    $number = $_POST['number'];

    // ป้องกัน SQL Injection แบบง่ายๆ ด้วย real_escape_string
    $fname = $conn->real_escape_string($fname);
    $lname = $conn->real_escape_string($lname);
    $class = (int)$class;
    $number = (int)$number;

    $sql = "INSERT INTO tb_member (First_name, Last_name, Class, Number) VALUES ('$fname', '$lname', $class, $number)";
    if ($conn->query($sql) === TRUE) {
        $msg = '<div class="alert alert-success">complete</div>';
    } else {
        $msg = '<div class="alert alert-danger">Error: ' . $conn->error . '</div>';
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
 <?= $msg ?>

    <form method="POST" action="">
        <div class="mb-3">
            <label for="first_name" class="form-label">First name</label>
            <input type="text" name="first_name" id="first_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="last_name" class="form-label">Last name</label>
            <input type="text" name="last_name" id="last_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="class" class="form-label">Class</label>
            <input type="text" name="class" id="class" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="number" class="form-label">Number</label>
            <input type="number" name="number" id="number" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">sumit</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
