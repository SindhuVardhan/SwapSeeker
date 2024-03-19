<?php

include "../../includes/config.php";


$post = [
    'username' => 's',
    'email' => 'vardhan@gmail.com',
    'phone'=>'9390200432',
    'password'   => "123",
];

$ch = curl_init(API."user_register.php");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

// execute!
$response = curl_exec($ch);

// close the connection, release resources used
curl_close($ch);

// do anything you want with your response
var_dump($response);
?>
