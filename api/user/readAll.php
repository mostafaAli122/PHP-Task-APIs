<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: Application/json');

    include_once '../../config/Database.php';
    include_once '../../models/User.php';

    //Instantiate DB & Connect
    $database =new Database();
    $db = $database->connect();

    //Instantiate User object 
    $user = new User($db);

    //User read query
    $result = $user->readAll();

    //get row count
    $num = $result->rowCount();

    //check if any Users
    if($num > 0){
        //Users Array
        $user_arr = array();
        $user_arr['data']=array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $user_item = array(
                'id' => $id,
                'username' => $name,
                'password' => $password,
                'email'=> $email,
                'phone' => $phone
            );
            //push to data
            array_push($user_arr['data'],$user_item);
        }
        //turn to json & output
        echo json_encode($user_arr);
    }else{
        echo json_encode(array(
            'message' => 'No Users Found'
        ));
    }
