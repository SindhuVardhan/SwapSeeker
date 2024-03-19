<?php

include "../../includes/config.php";

$RequestMethod = $_SERVER["REQUEST_METHOD"];

if($RequestMethod == "GET"){

    try {

        $email		= addslashes((trim($_REQUEST['email'])));
        $password	= addslashes((trim($_REQUEST['password'])));
        $platform	= addslashes((trim($_REQUEST['platform'])));

        $CheckUserQuery = "SELECT * FROM signup WHERE email = '$email' AND password = '$password' AND user_role = 'user'";
        $CheckUserQueryResults = mysqli_query($conn,$CheckUserQuery);

        if (mysqli_num_rows($CheckUserQueryResults) > 0) 
        {
            while($record = mysqli_fetch_assoc($CheckUserQueryResults)) 
            {
                if($platform == "web"){
                   
                    $_SESSION["usertype"]  = $record["user_role"];
                    $_SESSION["logged_in"] = true;
                    $_SESSION["uid"] = $record["id"];
                    $_SESSION["username"] = $record["username"];
                    $_SESSION["useremail"] = $record["email"];

                    $Data =[
                        'status' => 200,
                        'message' => 'Success'
                    ];
                
                    header("HTTP/1.0 200 Success");
                    echo json_encode($Data);
                }else{
                    $PayloadArray = array();

                    $PayloadArray["logged_in"] = true;
                    $PayloadArray["uid"]       = $record["id"];
                    $PayloadArray["username"]  = $record["username"];
                    $PayloadArray["useremail"] = $record["email"];
                    $PayloadArray["usertype"]  = $record["user_role"];

                    $Data =[
                        'status' => 200,
                        'message' => 'Success',
                        'data' => $PayloadArray,
                    ];
                
                    header("HTTP/1.0 200 Success");
                    echo json_encode($Data);
                }
                

            }
            

        } else {
            $Data =[
                'status' => 404,
                'message' => 'Username or password is incorrect'
            ];
        
            header("HTTP/1.0 404 Username or password is incorrect");
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