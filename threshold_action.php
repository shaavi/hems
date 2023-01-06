<?php
// Create and check connection
include_once 'connect_db.php';

// assign variables
$fName = $_POST['fname'];
$lName = $_POST['lname'];
$gender = $_POST['gender'];
$telephone = $_POST['telephone'];
$email = $_POST['email'];
$address = $_POST['address'];
$city = $_POST['city'];
$province = $_POST['province'];
$agreement = $_POST['accept'];
$adminid = 1;

// Insert values into database
$sql = "INSERT INTO contest (FirstName, LastName, Gender, Telephone, Email, Address, City, Province, Agreement, AdminID)
VALUES ('$fName','$lName','$gender','$telephone','$email','$address','$city','$province','$agreement','$adminid');";

$result = mysqli_query($conn, $sql);

echo "<script>
      window.location.href = 'index.php';
      alert('Thank you, your Submission has been received.');
</script>";
