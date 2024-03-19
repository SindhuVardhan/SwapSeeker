<?php

include "../../includes/config.php";

$RequestMethod = $_SERVER["REQUEST_METHOD"];

if($RequestMethod == "GET"){

    try {
        $username	= addslashes((trim($_REQUEST['username'])));
        $email	    = addslashes((trim($_REQUEST['email'])));
        $mobile	    = addslashes((trim($_REQUEST['phone'])));
        $password	= addslashes((trim($_REQUEST['password'])));
     

        $CheckUserQuery = "SELECT * FROM signup WHERE email = '$email'";
        $CheckUserQueryResults = mysqli_query($conn,$CheckUserQuery);

        if (mysqli_num_rows($CheckUserQueryResults) > 0) 
        {
            $Data =[
                'status' => 300,
                'message' => 'Email is already registered, Please provide a different email.'
            ];
        
            header("HTTP/1.0 300 Email Already Registered");
            echo json_encode($Data);
        }else{
            $InsertArray = array();
            $InsertArray["username"]   = $username;
            $InsertArray["email"]  = $email;
            $InsertArray["phone"] = $mobile;
            $password_hash = password_hash($password,PASSWORD_DEFAULT); 
    
            $InsertArray["password"]   = $password_hash;
            $InsertArray["user_role"]  = "user";
    
            $columns = implode(", ",array_keys($InsertArray));
            $escaped_values = array_map(array($conn, 'real_escape_string'), array_values($InsertArray));
            $values  = implode("', '", $escaped_values);
            $AddNewUserQuery = "INSERT INTO signup ($columns) VALUES ('$values')";
            $ExecuteAddNewUserQuery = mysqli_query($conn,$AddNewUserQuery) or die ("Error in query: $AddNewUserQuery. ".mysqli_error($conn));
    
            $Data =[
                'status' => 200,
                'message' => 'Success'
            ];
        
            header("HTTP/1.0 200 Success");
            echo json_encode($Data);
        }

    } catch (Exception $ex) {
        $Data =[
            'status' => 500,
            'message' => 'Server Error: Something went wrong'
        ];
    
        header("HTTP/1.0 500 Server Error: Something went wrong");
        echo json_encode($Data);
    }
}else{
    $Data =[
        'status' => 405,
        'message' => $RequestMethod . ' Method Not Allowed'
    ];

    header("HTTP/1.0 405 Method Not Allowed");
    echo json_encode($Data);
}



?>