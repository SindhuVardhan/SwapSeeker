<?php
session_start();

if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
  $Protocol = "https://";
} else {
  $Protocol = "http://";
}

define("DEV_ENV", "ON"); // ON or OFF

define("PAYMENT_KEY", "rzp_test_zTv48rEyiAaPfG");

$CurrentServer = $_SERVER['SERVER_NAME'];

if ($CurrentServer == "localhost") {
    define("SITE_URL", $Protocol . $_SERVER['SERVER_NAME'] . "/swapsseker");
    define("ROOT", $_SERVER['DOCUMENT_ROOT'] . "/swapseeker");
    define("UPLOAD_PATH", $_SERVER['DOCUMENT_ROOT'] . "/swapseeker/uploads");
    define("UPLOAD_URL", SITE_URL . "/swapseeker/uploads");

    define("API", SITE_URL . "/swapseeker/api/v2/");

    define("DB_SERVER", "localhost");
    define("DB_USER", "root");
    define("DB_PASS", "");
    define("DB_NAME", "swapseeker");

} else {
    define("SITE_URL", $Protocol . $_SERVER['SERVER_NAME'] . "/");
    define("ROOT", $_SERVER['DOCUMENT_ROOT'] . "/");
    define("UPLOAD_PATH", $_SERVER['DOCUMENT_ROOT'] . "/uploads");
    define("UPLOAD_URL", SITE_URL . "/uploads");

    define("API", SITE_URL . "/swapseeker/api/v2/");

    define("DB_SERVER", "localhost");
    define("DB_USER", "root");
    define("DB_PASS", "");
    define("DB_NAME", "swapseeker");
}

// Create connection
$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

// Check connection
if (!$conn) {
    // If connection fails, log the error or display an error message
    die("Connection failed: " . mysqli_connect_error());
}

// Connection successful
// echo "Connected successfully";
?>
