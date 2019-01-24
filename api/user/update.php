<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/User.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate User object
  $user = new User($db);

  // Get raw User data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to UPDATE
  $user->id = $data->id;

  $user->username = $data->username;
  $user->password = $data->password;
  $user->phone = $data->phone;
  $user->email = $data->email;

  // Update User
  if($user->updateUser()) {
    echo json_encode(
      array('message' => 'User Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'User not updated')
    );
  }
