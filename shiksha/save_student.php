<?php
$conn = new mysqli("localhost", "root", "", "student_portal");

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$roll = $_POST['roll_no'];
$email = $_POST['email'];
$course = $_POST['course'];

$sql = "INSERT INTO students (name, roll_no, email, course) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $name, $roll, $email, $course);

if ($stmt->execute()) {
  echo "<script>alert('Student record saved successfully!'); window.location.href='view_students.php';</script>";
} else {
  echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
