<?php
    class User{
         //DB params
         private $DB;
        //User Properties
        public $id;
        public $username;
        public $password;
        public $email;
        public $phone;
    


        //Constructor with DB
        public function __construct($db){
            $this->DB=$db;
        }
        
        //get All Users
        public function readAll(){
            //create query
            $statement=$this->DB->query('SELECT * FROM users');
            return $statement;
        }
        //read single user data
        public function read_single(){
             // Create query
            $query = 'SELECT id,name,password,email,phone FROM users WHERE id = ? LIMIT 0,1';
            //Prepare statement
            $stmt = $this->DB->prepare($query);
            // Bind ID
            $stmt->bindParam(1, $this->id);
            // Execute query
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            // set properties
            $this->id = $row['id'];
            $this->username = $row['name'];
            $this->password = $row['password'];
            $this->email = $row['email'];
            $this->phone = $row['phone'];
        }
        //Create New User
        public function create(){
            //create Query
            $query='INSERT INTO users set name = :username,password = :password , email = :email , phone = :phone';
            //Prepare Statement
            $stmt=$this->DB->prepare($query);
            //clean Data
            $this->username=htmlspecialchars(strip_tags($this->username));
            $this->password=htmlspecialchars(strip_tags($this->password));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->phone=htmlspecialchars(strip_tags($this->phone));
            //Bind data
            $stmt->bindParam(':username',$this->username);
            $stmt->bindParam(':password',password_hash($this->password, PASSWORD_BCRYPT));
            $stmt->bindParam(':email',$this->email);
            $stmt->bindParam(':phone',$this->phone);
            // Execute query
            if($stmt->execute()) {
                return true;
            }
            // Print error if something goes wrong
            printf("Error: $s.\n", $stmt->error);
            return false;
        }
      

        //update Existing user
        public function updateUser(){
             //create Query
            $query='UPDATE users set name = :username,password = :password , email = :email , phone = :phone WHERE id=:id';
            //Prepare Statement
            $stmt=$this->DB->prepare($query);
            //clean Data
            $this->id=htmlspecialchars(strip_tags($this->id));
            $this->username=htmlspecialchars(strip_tags($this->username));
            $this->password=htmlspecialchars(strip_tags($this->password));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->phone=htmlspecialchars(strip_tags($this->phone));
            //Bind data
            $stmt->bindParam(':id',$this->id);
            $stmt->bindParam(':username',$this->username);
            $stmt->bindParam(':password',password_hash($this->password, PASSWORD_BCRYPT));
            $stmt->bindParam(':email',$this->email);
            $stmt->bindParam(':phone',$this->phone);
            // Execute query
            if($stmt->execute()) {
                return true;
            }
            // Print error if something goes wrong
            printf("Error: $s.\n", $stmt->error);
            return false;
        }
        
        public function delete(){
            //create query
            $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
            // Prepare Statement
            $stmt = $this->conn->prepare($query);
            // clean data
            $this->id = htmlspecialchars(strip_tags($this->id));
            // Bind Data
            $stmt-> bindParam(':id', $this->id);
            // Execute query
            if($stmt->execute()) {
              return true;
            }
            // Print error if something goes wrong
            printf("Error: $s.\n", $stmt->error);
            return false;
        }
    }