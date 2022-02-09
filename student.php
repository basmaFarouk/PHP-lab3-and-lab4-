<?php
    class Student{
        private $id;
        private $fname;
        private $lname;
        private $email;
        private $address;
        private $gender;
        private $country;
        private $password;
        private $department;
        private $errors;

        function __construct(){ //magic function

        }

        function __destruct(){

        }

        function __set($key,$value){ //بتتنده اول ما احاول اعمل اكسيس لاي متغير نوعه --> private or protected
            if($key=="id"){
                // if(filter_var($value,FILIER_VALIDATE_INT)){
                //     $this->$key=$value;
                // }else{
                //     $this->errors["id"]="please put valid integer";
                // }
            }
            else if($key=="fname"){
                if(strlen($value)>3){
                    $this->$key=$value;
                }else{
                    $this->errors["fname"]="first name should be more than 3 chars";
                }
            }
            else if($key=="lname"){
                if(strlen($value)>3){
                    $this->$key=$value;
                }else{
                    $this->errors["lname"]="last name should be more than 3 chars";
                }
            }
            else if($key=="email"){
                if(filter_var($value,FILTER_VALIDATE_EMAIL)){
                    $this->$key=$value;
                }else{
                    $this->errors["email"]="not valid email";
                }
            }
            else if($key=="gender"){
                $this->$key=$value;
            }
            else if($key=="country"){
                $this->$key=$value;
            }
            else if($key=="email"){
                $this->$key=$value;
            }
            else if($key=="department"){
                $this->$key=$value;
            }
            else if($key=="password"){
                $this->$key=$value;
            }else if($key=="address"){
                $this->$key=$value;
            }
        }

        function __get($key){ //var return the key
            return $this->$key;
        }
    }




?>