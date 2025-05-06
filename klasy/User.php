<?php
    class User {
        const STATUS_USER = 1; 
        const STATUS_ADMIN = 2; 
        protected $userName;
        protected $passwd;
        protected $fullName;
        protected $email;
        protected $date;
        protected $status;
        function __construct($userName, $fullName, $email, $passwd){
            $this->status=User::STATUS_USER;
            $this->userName = $userName;
            $this->fullName = $fullName;
            $this->email = $email;
            $this->date = new DateTime();
            $this->passwd = password_hash($passwd, PASSWORD_DEFAULT);
        } 
        public function show(){
            echo $this->userName . " ";
            echo $this->fullName . " ";
            echo $this->email . " ";
            echo "status: " . $this->status . " ";
            echo $this->date->format('Y-m-d H:i:s') . "<br>";      
        }
        public function setUserName($userName){
            $this->userName = $userName;
        }
        public function getUserName(){
            return $this->userName;
        }
        public function getPasswd() {
            return $this->passwd;
        }

        public function setPasswd($passwd) {
            $this->passwd = password_hash($passwd, PASSWORD_DEFAULT);
        }

        public function getFullName() {
            return $this->fullName;
        }

        public function setFullName($fullName) {
            $this->fullName = $fullName;
        }

        public function getEmail() {
            return $this->email;
        }

        public function setEmail($email) {
            $this->email = $email;
        }

        public function getDate() {
            return $this->date;
        }

        public function setDate($date) {
            $this->date = $date;
        }

        public function getStatus() {
            return $this->status;
        }

        public function setStatus($status) {
            $this->status = $status;
        }
        static function getAllUsers($plik){ 
            $tab = json_decode(file_get_contents($plik)); 
            foreach ($tab as $val){
                echo "<p>".$val->userName." ".$val->fullName." ".$val->date." </p>";
            }
        }
        function toArray(){
            $arr=[ 
                "userName" => $this->userName, 
                "fullName" => $this->fullName, 
                "passwd" => $this->passwd,
                "email" => $this->email,
                "date" => $this->date,
                "status" => $this->status
                ]; 
            return $arr;
        }
        function save($plik){
            $tab = json_decode(file_get_contents($plik),true);
            array_push($tab,$this->toArray());
            file_put_contents($plik, json_encode($tab)); 
        }
        function saveDB($db){
            $sql = "INSERT INTO users VALUES (NULL, '";
            $sql .= htmlspecialchars($this->userName) . "', '";
            $sql .= htmlspecialchars($this->fullName) . "', '";
            $sql .= htmlspecialchars($this->email) . "', '";
            $sql .= htmlspecialchars($this->passwd) . "', '";
            $sql .= htmlspecialchars($this->status) . "', '";
            $sql .= $this->date->format('Y-m-d H:i:s') . "');";
            
            $db->insert($sql);
            echo "<br>Dodano do bazy danych";
        }
        static function getAllUsersFromDB($db){
            echo $db->select("SELECT userName,fullName,email,passwd,status,date FROM users", ["userName", "fullName", "email","passwd","status","date"]);
        }
    }
?>