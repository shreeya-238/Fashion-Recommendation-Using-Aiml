<?php
$con = mysqli_connect('localhost', 'root', '', 'fashion', 3306);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    echo "Database connected successfully!";
}
?>
