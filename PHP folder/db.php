<?php

class user{
    public $name;
    public $uname;
    public $email;
    public $passwd;
    public $confirmPasswd;
    private $conn;

    public function __construct(){
        $this->conn = new mysqli("localhost", "root", "", "testdb");
    }

    public function loginUser($data){
        $this->uname = $data['uname'];
        $this->passwd = $data['passwd'];
        if(!($this->uname && $this->passwd)){
            return 'emptyFeild';
        }
        $con1 = $this->checkUname();
        if ($con1){
            $sqlQuery = "SELECT * FROM users WHERE uname = '$this->uname' and password = '$this->passwd'";
            $result = $this->conn->query($sqlQuery);
            if ($result->num_rows > 0){
                session_start();
                $_SESSION['login'] = true;
                $_SESSION['name'] = $result->fetch_assoc()['name'];
                return 'pass';
            }else{
                return 'noPasswd';
            }
        }else{
            return 'noUname';
        }
    }

    public function registerUser($data){
        $this->uname = $data['uname'];
        if (!(ctype_alnum($this->uname))){
            return "invalidUname";
        }
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->passwd = $data['passwd'];
        $this->confirmPasswd = $data['confirmPasswd'];
        if ($this->passwd != $this->confirmPasswd){
            return "passwdMissMatched";
        }
        if(!($this->uname && $this->name && $this->email && $this->passwd)){
            return 'emptyFeild';
        }
        $con1 = $this->checkUname();
        $con2 = $this->checkEmail();
        if ($con1){
            return 'usedUname';
        }else if($con2){
            return 'usedEmail';
        }else{
            $sqlQuery = "INSERT into users Values ('$this->name','$this->uname','$this->email','$this->passwd')";
            $this->conn->query($sqlQuery);
            return 'registered';
        }
    }

    private function checkUname(){
        $sqlQuery = "SELECT * FROM users WHERE Uname = '$this->uname'";
        $result = $this->conn->query($sqlQuery);
        if ($result->num_rows > 0){
            return true;
        }else{
            return false;
        }
    }
    private function checkEmail(){
        $sqlQuery = "SELECT * FROM users WHERE email = '$this->email'";
        $result = $this->conn->query($sqlQuery);
        if ($result->num_rows > 0){
            return true;
        }else{
            return false;
        }
    }

}