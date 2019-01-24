<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/User.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate User object
  $user = new User($db);

  // Get ID
  $user->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Get User
  $user->read_single();

  // Create array
  $user_arr = array(
    'id' => $user->id,
    'username' => $user->username,
    'password'=>$user->password,
    'email'=>$user->email,
    'phone'=>$user->phone
  );

  // Make JSON
  print_r(json_encode($user_arr));
