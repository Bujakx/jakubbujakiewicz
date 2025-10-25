<?php
// Fix WordPress URLs
$host = 'mysql8';
$db = '39190440_31025ae9';
$user = '39190440_31025ae9';
$pass = 'l2nFn1v9';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$new_url = 'https://jakubbujakiewicz.pl/autoinstalator/wordpressplugins1';

$sql1 = "UPDATE wp_options SET option_value = '$new_url' WHERE option_name = 'siteurl'";
$sql2 = "UPDATE wp_options SET option_value = '$new_url' WHERE option_name = 'home'";

if ($conn->query($sql1) === TRUE && $conn->query($sql2) === TRUE) {
    echo "URLs fixed successfully!<br>";
    echo "New URL: $new_url<br>";
    echo "Please delete this file immediately for security!";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
