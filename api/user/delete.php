<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
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

  // Delete User
  if($user->delete()) {
    echo json_encode(
      array('message' => 'User deleted Successfully')
    );
  } else {
    echo json_encode(
      array('message' => 'User not deleted')
    );
  }
